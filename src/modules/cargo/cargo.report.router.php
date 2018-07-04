<?php
//Define interface class for router
use \Psr\Http\Message\ServerRequestInterface as Request;        //PSR7 ServerRequestInterface   >> Each router file must contains this
use \Psr\Http\Message\ResponseInterface as Response;            //PSR7 ResponseInterface        >> Each router file must contains this

//Define your modules class
use \modules\cargo\Report as Report;                            //Your main modules class


    // GET api to get all data page for statistic purpose
    $app->get('/cargo/report/branch/data/summary/{year}/{username}/{token}', function (Request $request, Response $response) {
        $cargo = new Report($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->token = $request->getAttribute('token');
        $cargo->username = $request->getAttribute('username');
        $cargo->year = $request->getAttribute('year');
        $body = $response->getBody();
        $body->write($cargo->salesTransactionSummaryYear());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to get all data page for statistic chart purpose
    $app->get('/cargo/report/branch/data/chart/{year}/{username}/{token}', function (Request $request, Response $response) {
        $cargo = new Report($this->db);
        $cargo->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $cargo->token = $request->getAttribute('token');
        $cargo->username = $request->getAttribute('username');
        $cargo->year = $request->getAttribute('year');
        $body = $response->getBody();
        $body->write($cargo->salesTransactionChartYear());
        return classes\Cors::modify($response,$body,200);
    });