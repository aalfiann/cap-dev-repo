<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \classes\SimpleCache as SimpleCache;
/*
$stmt->bindParam(':customerid', $this->customerid, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_name', $this->consignor_name, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_alias', $this->consignor_alias, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_address', $this->consignor_address, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_phone', $newphone1, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_fax', $newfax1, PDO::PARAM_STR);
                        $stmt->bindParam(':consignor_email', $this->consignor_email, PDO::PARAM_STR);

                        $stmt->bindParam(':referenceid', $this->referenceid, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_name', $this->consignee_name, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_attention', $this->consignee_attention, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_address', $this->consignee_address, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_phone', $newphone2, PDO::PARAM_STR);
                        $stmt->bindParam(':consignee_fax', $newfax2, PDO::PARAM_STR);

                        $stmt->bindParam(':modeid', $newmodeid, PDO::PARAM_STR);
                        $stmt->bindParam(':origin', $this->origin, PDO::PARAM_STR);
                        $stmt->bindParam(':destination', $this->destination, PDO::PARAM_STR);
                        $stmt->bindParam(':estimation', $newest, PDO::PARAM_STR);

                        $stmt->bindParam(':instruction', $this->instruction, PDO::PARAM_STR);
                        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_data', $this->goods_data, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_koli', $goods_koli, PDO::PARAM_STR);
                        $stmt->bindParam(':weight', $newweight, PDO::PARAM_STR);
                        $stmt->bindParam(':weight_real', $newweightreal, PDO::PARAM_STR);

                        $stmt->bindParam(':insurance_rate', $newinsurancerate, PDO::PARAM_STR);
                        $stmt->bindParam(':goods_value', $newgoodsvalue, PDO::PARAM_STR);

                        $stmt->bindParam(':kgp', $newkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':kgs', $newkgs, PDO::PARAM_STR);
                        $stmt->bindParam(':hkgp', $newhkgp, PDO::PARAM_STR);
                        $stmt->bindParam(':hkgs', $newhkgs, PDO::PARAM_STR);

                        $stmt->bindParam(':paymentid', $newpaymentid, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_cost', $newshippingcost, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_insurance', $newshippinginsurance, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_packing', $newshippingpacking, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_forward', $newshippingforward, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_handling', $newshippinghandling, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_surcharge', $newshippingsurcharge, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_admin', $newshippingadmin, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_discount', $newshippingdiscount, PDO::PARAM_STR);
                        $stmt->bindParam(':shipping_cost_total', $newshippingcosttotal, PDO::PARAM_STR);
*/
    // POST api to create new transaction
    $app->post('/cargo/transaction/data/new', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        
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
        $cargo->modeid = $datapost['ModeID'];
        $cargo->mode = $datapost['Mode'];
        $body = $response->getBody();
        $body->write($cargo->update());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete transaction
    $app->post('/cargo/transaction/data/delete', function (Request $request, Response $response) {
        $cargo = new classes\system\cargo\Transaction($this->db);
        $datapost = $request->getParsedBody();    
        $cargo->modeid = $datapost['ModeID'];
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
        $cargo->modeid = $datapost['ModeID'];
        $cargo->username = $datapost['Username'];
        $cargo->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($cargo->delete());
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