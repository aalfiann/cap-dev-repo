<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\middleware\ValidateParam as ValidateParam;
use \classes\middleware\ValidateParamURL as ValidateParamURL;
use \classes\SimpleCache as SimpleCache;
use \modules\cargo\Insurance as Insurance;

    // POST api to create new insurance
    $app->post('/cargo/insurance/data/new', function (Request $request, Response $response) {
        $cargo = new Insurance($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->insurance = $datapost['Insurance'];
        $cargo->premium = $datapost['Premium'];
        $cargo->minpremium = $datapost['MinPremium'];
        $body = $response->getBody();
        $body->write($cargo->add());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam(['Premium','MinPremium'],'1-10','numeric'))
        ->add(new ValidateParam(['Token','Insurance'],'1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // POST api to update insurance
    $app->post('/cargo/insurance/data/update', function (Request $request, Response $response) {
        $cargo = new Insurance($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->insuranceid = $datapost['InsuranceID'];
        $cargo->insurance = $datapost['Insurance'];
        $cargo->premium = $datapost['Premium'];
        $cargo->minpremium = $datapost['MinPremium'];
        $body = $response->getBody();
        $body->write($cargo->update());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam(['Premium','MinPremium'],'1-10','numeric'))
        ->add(new ValidateParam('InsuranceID','1-11','numeric'))
        ->add(new ValidateParam(['Token','Insurance'],'1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // POST api to delete insurance
    $app->post('/cargo/insurance/data/delete', function (Request $request, Response $response) {
        $cargo = new Insurance($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();    
        $cargo->insuranceid = $datapost['InsuranceID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('InsuranceID','1-11','numeric'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // GET api to show all data insurance pagination registered user
    $app->get('/cargo/insurance/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new Insurance($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($cargo->searchInsuranceAsPagination());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));

    // GET api to show all data insurance pagination public
    $app->map(['GET','OPTIONS'],'/cargo/insurance/data/public/search/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new Insurance($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(3600,["apikey","query","lang"])){
            $datajson = SimpleCache::load(["apikey","query","lang"]);
        } else {
            $datajson = SimpleCache::save($cargo->searchInsuranceAsPaginationPublic(),["apikey","query","lang"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new ValidateParamURL('lang','0-2'))
        ->add(new ValidateParamURL('query'))
        ->add(new \classes\middleware\ApiKey());