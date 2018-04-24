<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;

    // POST api to create new transaction
    $app->post('/cargo/transaction/data/new', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        
        $cargo->destid = $datapost['DestID'];
        $cargo->customerid = $datapost['CustomerID'];
        $cargo->consignor_name = $datapost['Consignor_name'];
        $cargo->consignor_alias = $datapost['Consignor_alias'];
        $cargo->consignor_address = $datapost['Consignor_address'];
        $cargo->consignor_phone = $datapost['Consignor_phone'];
        $cargo->consignor_fax = $datapost['Consignor_fax'];
        $cargo->consignor_email = $datapost['Consignor_email'];

        $cargo->referenceid = $datapost['ReferenceID'];
        $cargo->consignee_name = $datapost['Consignee_name'];
        $cargo->consignee_attention = $datapost['Consignee_attention'];
        $cargo->consignee_address = $datapost['Consignee_address'];
        $cargo->consignee_phone = $datapost['Consignee_phone'];
        $cargo->consignee_fax = $datapost['Consignee_fax'];

        $cargo->modeid = $datapost['ModeID'];
        $cargo->origin = $datapost['Origin'];
        $cargo->destination = $datapost['Destination'];
        $cargo->estimation = $datapost['Estimation'];

        $cargo->instruction = $datapost['Instruction'];
        $cargo->description = $datapost['Description'];
        $cargo->goods_data = $datapost['Goods_data'];
        $cargo->goods_koli = $datapost['Goods_koli'];
        $cargo->weight = $datapost['Weight'];
        $cargo->weight_real = $datapost['Weight_real'];

        $cargo->insurance_rate = $datapost['Insurance_rate'];
        $cargo->goods_value = $datapost['Goods_value'];

        $cargo->kgp = $datapost['KGP'];
        $cargo->kgs = $datapost['KGS'];
        $cargo->hkgp = $datapost['HKGP'];
        $cargo->hkgs = $datapost['HKGS'];
        $cargo->minkgp = $datapost['MINKGP'];
        $cargo->minhkgp = $datapost['MINHKGP'];

        $cargo->paymentid = $datapost['PaymentID'];
        $cargo->shipping_cost = $datapost['Shipping_cost'];
        $cargo->shipping_insurance = $datapost['Shipping_insurance'];
        $cargo->shipping_packing = $datapost['Shipping_packing'];
        $cargo->shipping_forward = $datapost['Shipping_forward'];
        $cargo->shipping_handling = $datapost['Shipping_handling'];
        $cargo->shipping_surcharge = $datapost['Shipping_surcharge'];
        $cargo->shipping_admin = $datapost['Shipping_admin'];
        $cargo->shipping_discount = $datapost['Shipping_discount'];
        $cargo->shipping_cost_total = $datapost['Shipping_cost_total'];

        $body = $response->getBody();
        $body->write($cargo->add());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update transaction
    $app->post('/cargo/transaction/data/update', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $cargo->waybill = $datapost['Waybill'];
        
        $cargo->destid = $datapost['DestID'];
        $cargo->customerid = $datapost['CustomerID'];
        $cargo->consignor_name = $datapost['Consignor_name'];
        $cargo->consignor_alias = $datapost['Consignor_alias'];
        $cargo->consignor_address = $datapost['Consignor_address'];
        $cargo->consignor_phone = $datapost['Consignor_phone'];
        $cargo->consignor_fax = $datapost['Consignor_fax'];
        $cargo->consignor_email = $datapost['Consignor_email'];

        $cargo->referenceid = $datapost['ReferenceID'];
        $cargo->consignee_name = $datapost['Consignee_name'];
        $cargo->consignee_attention = $datapost['Consignee_attention'];
        $cargo->consignee_address = $datapost['Consignee_address'];
        $cargo->consignee_phone = $datapost['Consignee_phone'];
        $cargo->consignee_fax = $datapost['Consignee_fax'];

        $cargo->modeid = $datapost['ModeID'];
        $cargo->origin = $datapost['Origin'];
        $cargo->destination = $datapost['Destination'];
        $cargo->estimation = $datapost['Estimation'];

        $cargo->instruction = $datapost['Instruction'];
        $cargo->description = $datapost['Description'];
        $cargo->goods_data = $datapost['Goods_data'];
        $cargo->goods_koli = $datapost['Goods_koli'];
        $cargo->weight = $datapost['Weight'];
        $cargo->weight_real = $datapost['Weight_real'];

        $cargo->insurance_rate = $datapost['Insurance_rate'];
        $cargo->goods_value = $datapost['Goods_value'];

        $cargo->kgp = $datapost['KGP'];
        $cargo->kgs = $datapost['KGS'];
        $cargo->hkgp = $datapost['HKGP'];
        $cargo->hkgs = $datapost['HKGS'];
        $cargo->minkgp = $datapost['MINKGP'];
        $cargo->minhkgp = $datapost['MINHKGP'];

        $cargo->paymentid = $datapost['PaymentID'];
        $cargo->shipping_cost = $datapost['Shipping_cost'];
        $cargo->shipping_insurance = $datapost['Shipping_insurance'];
        $cargo->shipping_packing = $datapost['Shipping_packing'];
        $cargo->shipping_forward = $datapost['Shipping_forward'];
        $cargo->shipping_handling = $datapost['Shipping_handling'];
        $cargo->shipping_surcharge = $datapost['Shipping_surcharge'];
        $cargo->shipping_admin = $datapost['Shipping_admin'];
        $cargo->shipping_discount = $datapost['Shipping_discount'];
        $cargo->shipping_cost_total = $datapost['Shipping_cost_total'];

        $body = $response->getBody();
        $body->write($cargo->update());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete transaction
    $app->post('/cargo/transaction/data/delete', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->waybill = $datapost['Waybill'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to void transaction
    $app->post('/cargo/transaction/data/void', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];

        $cargo->waybill = $datapost['Waybill'];
        $cargo->description = $datapost['Description'];
        $body = $response->getBody();
        $body->write($cargo->void());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delivered transaction
    $app->post('/cargo/transaction/data/pod/delivered', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];

        $cargo->waybill = $datapost['Waybill'];
        $cargo->recipient = $datapost['Recipient'];
        $cargo->relation = $datapost['Relation'];
        $cargo->deliveryid = $datapost['DeliveryID'];
        $body = $response->getBody();
        $body->write($cargo->delivered());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to failed transaction
    $app->post('/cargo/transaction/data/pod/failed', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];

        $cargo->waybill = $datapost['Waybill'];
        $cargo->description = $datapost['Description'];
        $cargo->deliveryid = $datapost['DeliveryID'];
        $body = $response->getBody();
        $body->write($cargo->failed());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to returned transaction
    $app->post('/cargo/transaction/data/pod/returned', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];

        $cargo->waybill = $datapost['Waybill'];
        $cargo->deliveryid = $datapost['DeliveryID'];
        $body = $response->getBody();
        $body->write($cargo->returned('1'));
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to returned asked by consignor
    $app->post('/cargo/transaction/data/pod/returned/consignor', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];

        $cargo->waybill = $datapost['Waybill'];
        $cargo->deliveryid = $datapost['DeliveryID'];
        $body = $response->getBody();
        $body->write($cargo->returned('2'));
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to returned asked by consignee
    $app->post('/cargo/transaction/data/pod/returned/consignee', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];

        $cargo->waybill = $datapost['Waybill'];
        $cargo->deliveryid = $datapost['DeliveryID'];
        $body = $response->getBody();
        $body->write($cargo->returned('3'));
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show data waybill registered user
    $app->get('/cargo/transaction/data/waybill/{username}/{token}/{waybill}', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->waybill = $request->getAttribute('waybill');
        $body = $response->getBody();
        $body->write($cargo->showWaybillDetail());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show data trace waybill registered user
    $app->get('/cargo/transaction/data/trace/waybill/{username}/{token}/{waybill}', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $cargo->username = $request->getAttribute('username');
        $cargo->token = $request->getAttribute('token');
        $cargo->waybill = $request->getAttribute('waybill');
        $body = $response->getBody();
        $body->write($cargo->traceWaybillDetail());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data transaction pagination registered user
    $app->get('/cargo/transaction/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
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

    // GET api to test generate waybill
    $app->get('/cargo/transaction/generate/waybill/{username}/{token}', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $cargo->username = $request->getAttribute('username');;
        $cargo->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($cargo->getWaybillID());
        return classes\Cors::modify($response,$body,200);
    });