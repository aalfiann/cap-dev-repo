<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\middleware\ValidateParam as ValidateParam;
use \classes\middleware\ValidateParamURL as ValidateParamURL;
use \classes\middleware\ApiKey as ApiKey;
use \classes\SimpleCache as SimpleCache;
use \modules\cargo\Mode as Mode;

    // POST api to create new mode
    $app->post('/cargo/mode/data/new', function (Request $request, Response $response) {
        $cargo = new Mode($this->db);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->mode = $datapost['Mode'];
        $body = $response->getBody();
        $body->write($cargo->add());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Mode','1-20','required'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // POST api to update mode
    $app->post('/cargo/mode/data/update', function (Request $request, Response $response) {
        $cargo = new Mode($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->modeid = $datapost['ModeID'];
        $cargo->mode = $datapost['Mode'];
        $body = $response->getBody();
        $body->write($cargo->update());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('ModeID','1-11','numeric'))
        ->add(new ValidateParam('Mode','1-20','required'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // POST api to delete mode
    $app->post('/cargo/mode/data/delete', function (Request $request, Response $response) {
        $cargo = new Mode($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->modeid = $datapost['ModeID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('ModeID','1-11','numeric'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // GET api to show all data mode pagination registered user
    $app->get('/cargo/mode/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new Mode($this->db);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($cargo->searchModeAsPagination());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));

    // GET api to show all data mode pagination public
    $app->map(['GET','OPTIONS'],'/cargo/mode/data/public/search/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new Mode($this->db);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(3600,["apikey","query"])){
            $datajson = SimpleCache::load(["apikey","query"]);
        } else {
            $datajson = SimpleCache::save($cargo->searchModeAsPaginationPublic(),["apikey","query"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new ValidateParamURL('query'))->add(new ApiKey);

    // GET api to show all data mode
    $app->get('/cargo/mode/data/list/{username}/{token}', function (Request $request, Response $response) {
        $cargo = new Mode($this->db);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->showOptionMode());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data mode public
    $app->map(['GET','OPTIONS'],'/cargo/mode/data/list/public/', function (Request $request, Response $response) {
        $cargo = new Mode($this->db);
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(3600,["apikey"])){
            $datajson = SimpleCache::load(["apikey"]);
        } else {
            $datajson = SimpleCache::save($cargo->showOptionModePublic(),["apikey"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new ApiKey);