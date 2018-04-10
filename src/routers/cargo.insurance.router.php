<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;

    // POST api to create new insurance
    $app->post('/cargo/insurance/data/new', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Insurance($this->db);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->insurance = $datapost['Insurance'];
        $cargo->premium = $datapost['Premium'];
        $cargo->minpremium = $datapost['MinPremium'];
        $body = $response->getBody();
        $body->write($cargo->add());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update insurance
    $app->post('/cargo/insurance/data/update', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Insurance($this->db);
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
    });

    // POST api to delete insurance
    $app->post('/cargo/insurance/data/delete', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Insurance($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->insuranceid = $datapost['InsuranceID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data insurance pagination registered user
    $app->get('/cargo/insurance/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Insurance($this->db);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($cargo->searchInsuranceAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data insurance pagination public
    $app->map(['GET','OPTIONS'],'/cargo/insurance/data/public/search/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Insurance($this->db);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(3600,["apikey","query"])){
            $datajson = SimpleCache::load(["apikey","query"]);
        } else {
            $datajson = SimpleCache::save($cargo->searchInsuranceAsPaginationPublic(),["apikey","query"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new \classes\middleware\ApiKey());