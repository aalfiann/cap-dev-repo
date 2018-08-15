<?php
//Define interface class for router
use \Psr\Http\Message\ServerRequestInterface as Request;    //PSR7 ServerRequestInterface   >> Each router file must contains this
use \Psr\Http\Message\ResponseInterface as Response;        //PSR7 ResponseInterface        >> Each router file must contains this

//Define your modules class
use \modules\enterprise_customer\Company as Company;        //Your main modules class

//Define additional class for any purpose
use \classes\middleware\ValidateParam as ValidateParam;     //ValidateParam                 >> To validate the body form request
use \classes\middleware\ApiKey as ApiKey;                   //ApiKey Middleware             >> To authorize request by using ApiKey generated by reSlim

    
    // Add new data company
    $app->post('/enterprise_customer/company/data/add', function (Request $request, Response $response) {
        $c = new Company($this->db);
        $c->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $c->username = $datapost['Username'];
        $c->token = $datapost['Token'];
        $c->company_name = $datapost['Name'];
        $c->company_name_alias = $datapost['Alias'];
        $c->address = $datapost['Address'];
        $c->phone = $datapost['Phone'];
        $c->fax = $datapost['Fax'];
        $c->email = $datapost['Email'];
        $c->pic = $datapost['PIC'];
        $c->tin = $datapost['TIN'];
        $c->discount = $datapost['Discount'];
        $c->tax = $datapost['Tax'];
        $c->admin_cost = $datapost['Admin_cost'];
        $c->industryid = $datapost['IndustryID'];
        $c->salesid = $datapost['SalesID'];

        $body = $response->getBody();
        $body->write($c->add());
        return classes\Cors::modify($response,$body,200);
    })->add(New ValidateParam('SalesID','0-20','alphanumeric'))
        ->add(New ValidateParam(['Alias','PIC','TIN'],'0-50'))
        ->add(New ValidateParam('Address','0-250'))
        ->add(New ValidateParam('Email','0-50','email'))
        ->add(New ValidateParam('Fax','0-15','numeric'))
        ->add(New ValidateParam('Discount','1-7','decimal'))
        ->add(New ValidateParam('Tax','1-7','decimal'))
        ->add(New ValidateParam('Admin_cost','1-10','decimal'))
        ->add(New ValidateParam('IndustryID','1-2','numeric'))
        ->add(New ValidateParam('Phone','1-15','numeric'))
        ->add(new ValidateParam(['Name','Username'],'1-50','required'))
        ->add(new ValidateParam(['Token'],'1-250','required'));

    // Update data company
    $app->post('/enterprise_customer/company/data/update', function (Request $request, Response $response) {
        $c = new Company($this->db);
        $c->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $c->username = $datapost['Username'];
        $c->token = $datapost['Token'];
        $c->company_name = $datapost['Name'];
        $c->company_name_alias = $datapost['Alias'];
        $c->address = $datapost['Address'];
        $c->phone = $datapost['Phone'];
        $c->fax = $datapost['Fax'];
        $c->email = $datapost['Email'];
        $c->pic = $datapost['PIC'];
        $c->tin = $datapost['TIN'];
        $c->discount = $datapost['Discount'];
        $c->tax = $datapost['Tax'];
        $c->admin_cost = $datapost['Admin_cost'];
        $c->industryid = $datapost['IndustryID'];
        $c->salesid = $datapost['SalesID'];
        $c->statusid = $datapost['StatusID'];
        $c->companyid = $datapost['CompanyID'];

        $body = $response->getBody();
        $body->write($c->update());
        return classes\Cors::modify($response,$body,200);
    })add(New ValidateParam('SalesID','0-20','alphanumeric'))
        ->add(New ValidateParam(['Alias','PIC','TIN'],'0-50'))
        ->add(New ValidateParam('Address','0-250'))
        ->add(New ValidateParam('Email','0-50','email'))
        ->add(New ValidateParam('Fax','0-15','numeric'))
        ->add(New ValidateParam('Discount','1-7','decimal'))
        ->add(New ValidateParam('Tax','1-7','decimal'))
        ->add(New ValidateParam('Admin_cost','1-10','decimal'))
        ->add(New ValidateParam(['IndustryID','StatusID'],'1-2','numeric'))
        ->add(New ValidateParam('Phone','1-15','numeric'))
        ->add(New ValidateParam('CompanyID','1-20','alphanumeric'))
        ->add(new ValidateParam(['Name','Username'],'1-50','required'))
        ->add(new ValidateParam(['Token'],'1-250','required'));

    // Delete data company
    $app->post('/enterprise_customer/company/data/delete', function (Request $request, Response $response) {
        $c = new Company($this->db);
        $c->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $datapost = $request->getParsedBody();
        $c->companyid = $datapost['CompanyID'];
        $c->username = $datapost['Username'];
        $c->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($c->delete());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParam('CompanyID','1-20','alphanumeric'))
        ->add(new ValidateParam('Token','1-250','required'))
        ->add(new ValidateParam('Username','1-50','required'));

    // Show data company for registered user
    $app->get('/enterprise_customer/company/data/show/{username}/{token}/{companyid}', function (Request $request, Response $response) {
        $c = new Company($this->db);
        $c->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $c->username = $request->getAttribute('username');
        $c->token = $request->getAttribute('token');
        $c->companyid = $request->getAttribute('companyid');
        $body = $response->getBody();
        $body->write($c->showCompanyDetail());
        return classes\Cors::modify($response,$body,200);
    });

    // Search all data company pagination for registered user
    $app->get('/enterprise_customer/company/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $c = new Company($this->db);
        $c->lang = (empty($_GET['lang'])?$this->settings['language']:$_GET['lang']);
        $c->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $c->username = $request->getAttribute('username');
        $c->token = $request->getAttribute('token');
        $c->page = $request->getAttribute('page');
        $c->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($c->searchCompanyAsPagination());
        return classes\Cors::modify($response,$body,200);
    })->add(new ValidateParamURL(['query']));