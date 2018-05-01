<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;

    // POST api to create new relation
    $app->post('/cargo/relation/data/new', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Relation($this->db);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->relation = $datapost['Relation'];
        $body = $response->getBody();
        $body->write($cargo->add());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update relation
    $app->post('/cargo/relation/data/update', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Relation($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->relationid = $datapost['RelationID'];
        $cargo->relation = $datapost['Relation'];
        $body = $response->getBody();
        $body->write($cargo->update());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete relation
    $app->post('/cargo/relation/data/delete', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Relation($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->relationid = $datapost['RelationID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data relation pagination registered user
    $app->get('/cargo/relation/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Relation($this->db);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($cargo->searchRelationAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data relation pagination public
    $app->map(['GET','OPTIONS'],'/cargo/relation/data/public/search/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Relation($this->db);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(3600,["apikey","query"])){
            $datajson = SimpleCache::load(["apikey","query"]);
        } else {
            $datajson = SimpleCache::save($cargo->searchRelationAsPaginationPublic(),["apikey","query"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new \classes\middleware\ApiKey());

    // GET api to show all data relation
    $app->get('/cargo/relation/data/list/{username}/{token}', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Relation($this->db);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->showOptionRelation());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data relation public
    $app->map(['GET','OPTIONS'],'/cargo/relation/data/list/public/', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Relation($this->db);
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(3600,["apikey"])){
            $datajson = SimpleCache::load(["apikey"]);
        } else {
            $datajson = SimpleCache::save($cargo->showOptionRelationPublic(),["apikey"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new \classes\middleware\ApiKey());