<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;

    // POST api to create new company
    $app->post('/system/user/data/new', function (Request $request, Response $response) {
        $user = new classes\system\User($this->db);
        $datapost = $request->getParsedBody();
        $user->adminname = $datapost['Adminname'];
        $user->token = $datapost['Token'];
        $user->username = $datapost['Username'];
        $user->branchid = $datapost['BranchID'];
        $body = $response->getBody();
        $body->write($user->register());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update user
    $app->post('/system/user/data/update', function (Request $request, Response $response) {
        $user = new classes\system\User($this->db);
        $datapost = $request->getParsedBody();    
        $user->adminname = $datapost['Adminname'];
        $user->token = $datapost['Token'];
        $user->username = $datapost['Username'];
        $user->branchid = $datapost['BranchID'];
        $user->statusid = $datapost['StatusID'];
        $body = $response->getBody();
        $body->write($user->update());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete user
    $app->post('/system/user/data/delete', function (Request $request, Response $response) {
        $user = new classes\system\User($this->db);
        $datapost = $request->getParsedBody();    
        $user->adminname = $datapost['Adminname'];
        $user->token = $datapost['Token'];
        $user->username = $datapost['Username'];
        $body = $response->getBody();
        $body->write($user->delete());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data user pagination registered user
    $app->get('/system/user/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $user = new classes\system\User($this->db);
        $user->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $user->username = $request->getAttribute('username');
        $user->token = $request->getAttribute('token');
        $user->page = $request->getAttribute('page');
        $user->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($user->searchUserAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to get data branchid user
    $app->get('/system/user/data/branch/{username}', function (Request $request, Response $response) {
        $user = new classes\system\User($this->db);
        $body = $response->getBody();
        $body->write('{"Username":"'.$request->getAttribute('username').'","BranchID":"'.$user->getBranchID($request->getAttribute('username')).'"}');
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data status user
    $app->get('/system/user/data/status/{token}', function (Request $request, Response $response) {
        $user = new classes\system\User($this->db);
        $user->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($user->showOptionStatus());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to get all data user for statistic purpose
    $app->get('/system/user/stats/data/summary/{username}/{token}', function (Request $request, Response $response) {
        $user = new classes\system\User($this->db);
        $user->token = $request->getAttribute('token');
        $user->username = $request->getAttribute('username');
        $body = $response->getBody();
        $body->write($user->statUserSummary());
        return classes\Cors::modify($response,$body,200);
    });