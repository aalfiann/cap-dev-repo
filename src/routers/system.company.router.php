<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;

    // POST api to create new company
    $app->post('/company/data/new', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $datapost = $request->getParsedBody();
        $company->username = $datapost['Username'];
        $company->token = $datapost['Token'];
        $company->branchid = $datapost['BranchID'];
        $company->name = $datapost['Name'];
        $company->address = $datapost['Address'];
        $company->phone = $datapost['Phone'];
        $company->fax = $datapost['Fax'];
        $company->email = $datapost['Email'];
        $company->owner = $datapost['Owner'];
        $company->pic = $datapost['PIC'];
        $company->tin = $datapost['TIN'];
        $body = $response->getBody();
        $body->write($company->add());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update company
    $app->post('/company/data/update', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $datapost = $request->getParsedBody();    
        $company->username = $datapost['Username'];
        $company->token = $datapost['Token'];
        $company->branchid = $datapost['BranchID'];
        $company->name = $datapost['Name'];
        $company->address = $datapost['Address'];
        $company->phone = $datapost['Phone'];
        $company->fax = $datapost['Fax'];
        $company->email = $datapost['Email'];
        $company->owner = $datapost['Owner'];
        $company->pic = $datapost['PIC'];
        $company->tin = $datapost['TIN'];
        $company->statusid = $datapost['StatusID'];
        $body = $response->getBody();
        $body->write($company->update());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete company
    $app->post('/company/data/delete', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $datapost = $request->getParsedBody();    
        $company->branchid = $datapost['BranchID'];
        $company->username = $datapost['Username'];
        $company->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($company->delete());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data company pagination registered user
    $app->get('/company/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $company->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $company->username = $request->getAttribute('username');
        $company->token = $request->getAttribute('token');
        $company->page = $request->getAttribute('page');
        $company->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($company->searchCompanyAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data company
    $app->get('/company/data/company/{token}', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $company->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($company->showOptionCompany());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data status company
    $app->get('/company/data/status/{token}', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $company->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($company->showOptionStatus());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data company pagination public
    $app->map(['GET','OPTIONS'],'/company/data/public/search/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $company->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $company->page = $request->getAttribute('page');
        $company->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        if (empty($company->search)){
            if (SimpleCache::isCached(3600,["apikey","query"])){
                $datajson = SimpleCache::load(["apikey","query"]);
            } else {
                $datajson = SimpleCache::save($company->searchCompanyAsPaginationPublic(),["apikey","query"]);
            }
            $body->write($datajson);
        } else {
            $body->write($company->searchCompanyAsPaginationPublic());
        }
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new \classes\middleware\ApiKey());

    // GET api to get all data page for statistic purpose
    $app->get('/company/stats/data/summary/{username}/{token}', function (Request $request, Response $response) {
        $company = new classes\system\Company($this->db);
        $company->token = $request->getAttribute('token');
        $company->username = $request->getAttribute('username');
        $body = $response->getBody();
        $body->write($company->statCompanySummary());
        return classes\Cors::modify($response,$body,200);
    });