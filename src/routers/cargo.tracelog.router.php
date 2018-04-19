<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;

    // POST api to create new trace log
    $app->post('/cargo/trace/data/new', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\TraceLog($this->db);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->codeid = $datapost['CodeID'];
        $cargo->description = $datapost['Description'];
        $cargo->statusid = $datapost['StatusID'];
        $body = $response->getBody();
        $body->write($cargo->add());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update trace log
    $app->post('/cargo/trace/data/update', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Mode($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->modeid = $datapost['ModeID'];
        $cargo->mode = $datapost['Mode'];
        $body = $response->getBody();
        $body->write($cargo->update());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete trace by item
    $app->post('/cargo/trace/data/delete/item', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Mode($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->modeid = $datapost['ModeID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete trace by code
    $app->post('/cargo/trace/data/delete/code', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Mode($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->modeid = $datapost['ModeID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data mode pagination registered user
    $app->get('/cargo/trace/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Mode($this->db);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($cargo->searchModeAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data trace by code
    $app->get('/cargo/trace/data/history/{username}/{token}/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Mode($this->db);
        $cargo->codeid = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->showOptionMode());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data mode public
    $app->map(['GET','OPTIONS'],'/cargo/mode/data/list/public/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Mode($this->db);
        $cargo->codeid = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag30min.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(300,["apikey","query"])){
            $datajson = SimpleCache::load(["apikey","query"]);
        } else {
            $datajson = SimpleCache::save($cargo->showOptionModePublic(),["apikey","query"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new \classes\middleware\ApiKey());