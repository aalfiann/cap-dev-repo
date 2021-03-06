<?php
//Define interface class for router
use \Psr\Http\Message\ServerRequestInterface as Request;        //PSR7 ServerRequestInterface   >> Each router file must contains this
use \Psr\Http\Message\ResponseInterface as Response;            //PSR7 ResponseInterface        >> Each router file must contains this

//Define your modules class
use \modules\deposit\Deposit as Deposit;                        //Your main modules class
use \modules\deposit\Dictionary as Dictionary;                  //Dictionary for multi language purpose

//Define additional class for any purpose
use \classes\middleware\ValidateParam as ValidateParam;         //ValidateParam                 >> To validate the body form request
use \classes\middleware\ValidateParamURL as ValidateParamURL;   //ValidateParamURL              >> To validate the query parameter url
use \classes\middleware\ApiKey as ApiKey;                       //ApiKey Middleware             >> To authorize request by using ApiKey generated by reSlim
use \classes\JSON as JSON;                                      //JSON class                    >> To handle json in better way

    
    // Get module information (for public user)
    $app->map(['GET','OPTIONS'],'/deposit/get/info/', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $body = $response->getBody();
        $response = $this->cache->withEtag($response, $this->etag2hour.'-'.trim($_SERVER['REQUEST_URI'],'/'));
        $body->write($deposit->viewInfo());
        return classes\Cors::modify($response,$body,200,$request);
    })->add(new ApiKey);
    
    // Installation 
    $app->get('/deposit/install/{username}/{token}', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($deposit->install());
        return classes\Cors::modify($response,$body,200);
    });

    // Uninstall (This will clear all data) 
    $app->get('/deposit/uninstall/{username}/{token}', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($deposit->uninstall());
        return classes\Cors::modify($response,$body,200);
    });

    
    //DEPOSIT====================


    // GET api to generate random ReferenceID
    $app->get('/deposit/generate/referenceid/{username}/{token}', function (Request $request, Response $response) {
        $lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $body = $response->getBody();
        $datajson = [
            'ReferenceID' => str_replace('.','-',uniqid('',true)),
            'status' => 'success',
            'code' => 'DP301',
            'message' => Dictionary::write('DP301',$lang)
        ];
        $body->write(JSON::encode($datajson,true));
        return classes\Cors::modify($response,$body,200);
    });


    // POST api to create new transaction
    $app->post('/deposit/transaction/new', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $deposit->username = $datapost['Username'];
        $deposit->token = $datapost['Token'];
        $deposit->depid = $datapost['DepositID'];
        $deposit->refid = $datapost['ReferenceID'];
        $deposit->task = $datapost['Task'];
        $deposit->mutation = $datapost['Mutation'];
        $deposit->description = $datapost['Description'];
        $body = $response->getBody();
        $body->write($deposit->transaction());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Task','2-2','required'))
        ->add(new ValidateParam('Mutation','1-20','double'))
        ->add(new ValidateParam(['Token','Description'],'1-250','required'))
        ->add(new ValidateParam(['Username','DepositID','ReferenceID'],'1-50','required'));


    // POST api to create new debit transaction
    $app->post('/deposit/transaction/debit', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $deposit->username = $datapost['Username'];
        $deposit->token = $datapost['Token'];
        $deposit->depid = $datapost['DepositID'];
        $deposit->refid = $datapost['ReferenceID'];
        $deposit->task = 'DB';
        $deposit->mutation = $datapost['Mutation'];
        $deposit->description = $datapost['Description'];
        $body = $response->getBody();
        $body->write($deposit->transaction());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Mutation','1-20','double'))
        ->add(new ValidateParam(['Token','Description'],'1-250','required'))
        ->add(new ValidateParam(['Username','DepositID','ReferenceID'],'1-50','required'));


    // POST api to create new credit transaction
    $app->post('/deposit/transaction/credit', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $deposit->username = $datapost['Username'];
        $deposit->token = $datapost['Token'];
        $deposit->depid = $datapost['DepositID'];
        $deposit->refid = $datapost['ReferenceID'];
        $deposit->task = 'CR';
        $deposit->mutation = $datapost['Mutation'];
        $deposit->description = $datapost['Description'];
        $body = $response->getBody();
        $body->write($deposit->transaction());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Mutation','1-20','double'))
        ->add(new ValidateParam(['Token','Description'],'1-250','required'))
        ->add(new ValidateParam(['Username','DepositID','ReferenceID'],'1-50','required'));


    // POST api to create new transaction topup
    $app->post('/deposit/transaction/topup', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $deposit->username = $datapost['Username'];
        $deposit->token = $datapost['Token'];
        $deposit->depid = $datapost['DepositID'];
        $deposit->refid = str_replace('.','-',uniqid('',true));
        $deposit->task = 'DB';
        $deposit->mutation = $datapost['Mutation'];
        $deposit->description = Dictionary::write('default_desc_topup');
        $body = $response->getBody();
        $body->write($deposit->transaction());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('Mutation','1-20','double'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam(['Username','DepositID'],'1-50','required'));

    
    // GET api to show user balance total
    $app->get('/deposit/transaction/data/balance/{username}/{token}', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->depid = $request->getAttribute('username');
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->page = $request->getAttribute('page');
        $deposit->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($deposit->checkBalance());
        return classes\Cors::modify($response,$body,200);
    });


    // GET api to show user balance total for admin
    $app->get('/deposit/transaction/admin/data/balance/{username}/{token}/{depid}', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->depid = $request->getAttribute('depid');
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->page = $request->getAttribute('page');
        $deposit->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($deposit->checkBalance());
        return classes\Cors::modify($response,$body,200);
    });


    // GET api to show all data transaction pagination registered user
    $app->get('/deposit/transaction/data/mutation/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->depid = $request->getAttribute('username');
        $deposit->firstdate = filter_var((empty($_GET['firstdate'])?'':$_GET['firstdate']),FILTER_SANITIZE_STRING);
        $deposit->lastdate = filter_var((empty($_GET['lastdate'])?'':$_GET['lastdate']),FILTER_SANITIZE_STRING);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->page = $request->getAttribute('page');
        $deposit->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($deposit->showMutation());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL(['firstdate','lastdate'],'','date'));


    // GET api to show all data transaction pagination for admin
    $app->get('/deposit/transaction/admin/data/mutation/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $deposit->firstdate = filter_var((empty($_GET['firstdate'])?'':$_GET['firstdate']),FILTER_SANITIZE_STRING);
        $deposit->lastdate = filter_var((empty($_GET['lastdate'])?'':$_GET['lastdate']),FILTER_SANITIZE_STRING);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->page = $request->getAttribute('page');
        $deposit->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($deposit->showMutationAdmin());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'))->add(new ValidateParamURL(['firstdate','lastdate'],'','date'));

    // GET api to show all data balance pagination for admin
    $app->get('/deposit/transaction/admin/data/balance/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->page = $request->getAttribute('page');
        $deposit->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($deposit->showBalanceAdmin());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL('query'));

    // GET api to show the most deposit for admin
    $app->get('/deposit/transaction/admin/data/mostdeposit/{year}/{topnumber}/{username}/{token}', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->year = $request->getAttribute('year');
        $deposit->topnumber = $request->getAttribute('topnumber');
        $body = $response->getBody();
        $body->write($deposit->showMostDeposit());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show the most transaction for admin
    $app->get('/deposit/transaction/admin/data/mosttransaction/{year}/{topnumber}/{username}/{token}', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->year = $request->getAttribute('year');
        $deposit->topnumber = $request->getAttribute('topnumber');
        $body = $response->getBody();
        $body->write($deposit->showMostTransaction());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show the most rich for admin
    $app->get('/deposit/transaction/admin/data/mostrich/{topnumber}/{username}/{token}', function (Request $request, Response $response) {
        $deposit = new Deposit($this->db);
        $deposit->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $deposit->username = $request->getAttribute('username');
        $deposit->token = $request->getAttribute('token');
        $deposit->topnumber = $request->getAttribute('topnumber');
        $body = $response->getBody();
        $body->write($deposit->showMostRich());
        return classes\Cors::modify($response,$body,200);
    });