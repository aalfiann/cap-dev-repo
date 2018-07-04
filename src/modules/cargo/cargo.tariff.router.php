<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\middleware\ValidateParam as ValidateParam;
use \classes\middleware\ValidateParamURL as ValidateParamURL;
use \classes\middleware\ApiKey as ApiKey;
use \classes\SimpleCache as SimpleCache;
use \modules\cargo\Tariff as Tariff;

    // POST api to create new cargo tariff data
    $app->post('/cargo/tariff/data/new', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $datapost = $request->getParsedBody();
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->branchid = $datapost['BranchID'];
        $cargo->kabupaten = $datapost['Kabupaten'];
        $cargo->kgp = $datapost['KGP'];
        $cargo->kgs = $datapost['KGS'];
        $cargo->minkg = $datapost['Minkg'];
        $cargo->estimasi = $datapost['Estimasi'];
        $cargo->modeid = $datapost['ModeID'];
        $body = $response->getBody();
        $body->write($cargo->addTariff());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Minkg','1-5','numeric'))
        ->add(new ValidateParam(['KGP','KGS','Estimasi','ModeID'],'1-10','numeric'))
        ->add(new ValidateParam('Kabupaten','1-250','required'))
        ->add(new ValidateParam('BranchID','1-10','required'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // POST api to update cargo tariff data
    $app->post('/cargo/tariff/data/update', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $datapost = $request->getParsedBody();
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->branchid = $datapost['BranchID'];
        $cargo->kabupaten = $datapost['Kabupaten'];
        $cargo->kgp = $datapost['KGP'];
        $cargo->kgs = $datapost['KGS'];
        $cargo->minkg = $datapost['Minkg'];
        $cargo->estimasi = $datapost['Estimasi'];
        $cargo->modeid = $datapost['ModeID'];
        $body = $response->getBody();
        $body->write($cargo->updateTariff());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Minkg','1-5','numeric'))
        ->add(new ValidateParam(['KGP','KGS','Estimasi','ModeID'],'1-10','numeric'))
        ->add(new ValidateParam('Kabupaten','1-250','required'))
        ->add(new ValidateParam('BranchID','1-10','required'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // POST api to delete cargo tariff data
    $app->post('/cargo/tariff/data/delete', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $datapost = $request->getParsedBody();
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->branchid = $datapost['BranchID'];
        $cargo->kabupaten = $datapost['Kabupaten'];
        $cargo->modeid = $datapost['ModeID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->deleteTariff());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('ModeID','1-10','numeric'))
        ->add(new ValidateParam('Kabupaten','1-250','required'))
        ->add(new ValidateParam('BranchID','1-10','required'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // GET api to show all tariff data pagination registered user
    $app->get('/cargo/tariff/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($cargo->searchTariffAsPagination());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));

    // GET api to show all auto list origin tariff
    $app->get('/cargo/tariff/data/list/origin/auto/search/{username}/{token}/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->listOriginAuto());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));

    // GET api to show all list origin tariff
    $app->get('/cargo/tariff/data/list/origin/search/{token}/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->listOrigin());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));

    // GET api to show all list destinasi tariff
    $app->get('/cargo/tariff/data/list/destination/search/{token}/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->listDestination());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));

    // GET api to search tariff
    $app->get('/cargo/tariff/data/get/search/{token}/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->origin = filter_var((empty($_GET['origin'])?'':$_GET['origin']),FILTER_SANITIZE_STRING);
        $cargo->destination = filter_var((empty($_GET['destination'])?'':$_GET['destination']),FILTER_SANITIZE_STRING);
        $cargo->length = (empty($_GET['length'])?0:$_GET['length']);
        $cargo->width = (empty($_GET['width'])?0:$_GET['width']);
        $cargo->height = (empty($_GET['height'])?0:$_GET['height']);
        $cargo->weight = ((empty($_GET['weight']) || $_GET['weight'] == 0)?1:$_GET['weight']);
        $cargo->mode = filter_var((empty($_GET['mode'])?'road':$_GET['mode']),FILTER_SANITIZE_STRING);
        $cargo->cubic = filter_var((empty($_GET['cubic'])?'false':$_GET['cubic']),FILTER_SANITIZE_STRING);
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->searchTariff());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to search tariff public
    $app->get('/cargo/tariff/data/get/public/search/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->origin = filter_var((empty($_GET['origin'])?'':$_GET['origin']),FILTER_SANITIZE_STRING);
        $cargo->destination = filter_var((empty($_GET['destination'])?'':$_GET['destination']),FILTER_SANITIZE_STRING);
        $cargo->length = (empty($_GET['length'])?0:$_GET['length']);
        $cargo->width = (empty($_GET['width'])?0:$_GET['width']);
        $cargo->height = (empty($_GET['height'])?0:$_GET['height']);
        $cargo->weight = ((empty($_GET['weight']) || $_GET['weight'] == 0)?1:$_GET['weight']);
        $cargo->mode = filter_var((empty($_GET['mode'])?'road':$_GET['mode']),FILTER_SANITIZE_STRING);
        $cargo->cubic = filter_var((empty($_GET['cubic'])?'false':$_GET['cubic']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(600,["apikey","origin","destination","mode","cubic","weight","length","width","height","lang"])){
            $datajson = SimpleCache::load(["apikey","origin","destination","mode","cubic","weight","length","width","height","lang"]);
        } else {
            $datajson = SimpleCache::save($cargo->searchTariffPublic(),["apikey","origin","destination","mode","cubic","weight","length","width","height","lang"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new \classes\middleware\ApiKey());

    // GET api to show all list origin tariff public
    $app->get('/cargo/tariff/data/list/origin/public/search/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(600,["apikey","lang"])){
            $datajson = SimpleCache::load(["apikey","lang"]);
        } else {
            $datajson = SimpleCache::save($cargo->listOriginPublic(),["apikey","lang"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new ValidateParamURL('query'))->add(new ApiKey);

    // GET api to show all list destinasi tariff public
    $app->get('/cargo/tariff/data/list/destination/public/search/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (SimpleCache::isCached(600,["apikey","lang"])){
            $datajson = SimpleCache::load(["apikey","lang"]);
        } else {
            $datajson = SimpleCache::save($cargo->listDestinationPublic(),["apikey","lang"]);
        }
        $body->write($datajson);
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new ValidateParamURL('query'))->add(new ApiKey);

    // POST api to create new cargo tariff handling
    $app->post('/cargo/tariff/handling/data/new', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $datapost = $request->getParsedBody();
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->kabupaten = $datapost['Kabupaten'];
        $cargo->kgp = $datapost['KGP'];
        $cargo->kgs = $datapost['KGS'];
        $cargo->minkg = $datapost['Minkg'];
        $cargo->modeid = $datapost['ModeID'];
        $body = $response->getBody();
        $body->write($cargo->addHandling());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Minkg','1-5','numeric'))
        ->add(new ValidateParam(['KGP','KGS','ModeID'],'1-10','numeric'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam(['Username','Kabupaten'],'1-50','required'));

    // POST api to update cargo tariff handling
    $app->post('/cargo/tariff/handling/data/update', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $datapost = $request->getParsedBody();
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->kabupaten = $datapost['Kabupaten'];
        $cargo->kgp = $datapost['KGP'];
        $cargo->kgs = $datapost['KGS'];
        $cargo->minkg = $datapost['Minkg'];
        $cargo->modeid = $datapost['ModeID'];
        $body = $response->getBody();
        $body->write($cargo->updateHandling());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Minkg','1-5','numeric'))
        ->add(new ValidateParam(['KGP','KGS','ModeID'],'1-10','numeric'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam(['Username','Kabupaten'],'1-50','required'));

    // POST api to delete cargo tariff handling
    $app->post('/cargo/tariff/handling/data/delete', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $datapost = $request->getParsedBody();
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->kabupaten = $datapost['Kabupaten'];
        $cargo->modeid = $datapost['ModeID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->deleteHandling());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('ModeID','1-10','numeric'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam(['Username','Kabupaten'],'1-50','required'));

    // GET api to show all tariff data pagination registered user
    $app->get('/cargo/tariff/handling/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $cargo = new Tariff($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->page = $request->getAttribute('page');
        $cargo->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($cargo->searchHandlingAsPagination());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));