<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$refpage = (empty($_GET['ref'])?'modul-transaction.php':$_GET['ref']);
$waybill = (empty($_GET['no'])?'0000000000000':$_GET['no']);
$datalogin = Core::checkSessions();
// Get data waybill
$urlwaybill = Core::getInstance()->api.'/cargo/transaction/data/waybill/'.$datalogin['username'].'/'.$datalogin['token'].'/'.$waybill;
$datawaybill = json_decode(Core::execGetRequest($urlwaybill));
$callsuccess = false;
$callmsg = "";
if (!empty($datawaybill)){
    if ($datawaybill->{'status'} == 'success'){
        $callsuccess = true;
        $callmsg = $datawaybill->{'message'};
    } else {
        $callsuccess = false;
        $callmsg = $datawaybill->{'message'};
    }
} else {
    $callsuccess = false;
    $callmsg = Core::lang('core_not_connected');
}
?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('waybill'),'-'.$waybill?></title>
</head>

<body class="fix-sidebar fix-header card-no-border">
    <?php include_once 'global-preloader.php';?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <?php include_once 'navbar-header.php';?>
        <?php include_once 'sidebar-left.php';?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><a href="<?php echo $refpage?>"><i class="mdi mdi-arrow-left"></i> <?php echo Core::lang('go_back')?></a></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('transaction')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('print_preview').' '.Core::lang('waybill')?></li>
                    </ol>
                </div>
                <div>
                    <button class="right-side-toggle waves-effect waves-light btn-themecolor btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <?php 
                if ($callsuccess){
                    echo '<!-- ============================================================== -->
                    <!-- Additional Print start -->
                    <!-- ============================================================== -->
                    <div class="row page-titles">
                        <div class="col-md-12 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">'.Core::lang('print_preview').' '.Core::lang('waybill').' <button id="print" class="btn btn-themecolor pull-right" type="button"> <span><i class="fa fa-print"></i> '.Core::lang('print').'</span> </button></h3>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Additional Print start -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <!-- Sheet 1 start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <h3><b class="text-primary">'.Core::getInstance()->title.'</b></h3>
                                        <span style="font-size: 13px !important;">'.$datawaybill->result[0]->Branch->Address.'
                                        <br>
                                        <i class="mdi mdi-phone-classic"></i> : '.$datawaybill->result[0]->Branch->Phone.(empty($datawaybill->result[0]->Branch->Fax)?'':' | <i class="mdi mdi-fax"></i> : '.$datawaybill->result[0]->Branch->Fax).' | <i class="mdi mdi-email-outline"></i> : '.(empty($datawaybill->result[0]->Branch->Email)?Core::getInstance()->email:$datawaybill->result[0]->Branch->Email).'</span>
                                    </div>
                                    <div class="pull-right text-right">
                                        <h3 class="text-right"><b>['.strtoupper($datawaybill->result[0]->Data->DestID).']</b></h3>
                                        <span>'.$datawaybill->result[0]->Route->Mode.'</span><br>
                                        <span style="font-size: 11px !important;"><b>'.Core::lang('sheet_for_shipper').'</b></span>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12"><hr></div>
                                    <div class="pull-left">
                                        <address>
                                            <h3>'.Core::lang('shipper').':</h3>
                                            <h4><b class="text-success">'.$datawaybill->result[0]->Consignor->Name.'</b> '.(empty($datawaybill->result[0]->Consignor->Alias)?'':'('.$datawaybill->result[0]->Consignor->Alias.')').'</h4>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 100px;">'.$datawaybill->result[0]->Consignor->Address.'<br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignor->Phone.(empty($datawaybill->result[0]->Consignor->Fax)?'':' - <b>'.Core::lang('fax').':</b> '.$datawaybill->result[0]->Consignor->Fax).'
                                            </p>
                                        </address>
                                        <address>
                                            <h3>'.Core::lang('consignee').':</h3>
                                            <h4><b class="font-bold text-danger">'.$datawaybill->result[0]->Consignee->Name.'</b> '.(empty($datawaybill->result[0]->Consignee->Attention)?'':'('.$datawaybill->result[0]->Consignee->Attention.')').'</h4>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 100px;">
                                                '.$datawaybill->result[0]->Consignee->Address.'
                                                <br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Phone.(empty($datawaybill->result[0]->Consignee->Fax)?'':' - <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Fax).'
                                            </p>
                                        </address>
                                        
                                        <h3>'.Core::lang('route_shipment').'</h3>
                                        <span class="text-muted m-l-5">'.$datawaybill->result[0]->Route->Origin.' >> '.$datawaybill->result[0]->Route->Destination.'</span><br>
                                        <span class="text-muted m-l-5">'.Core::lang('date_send').': '.date_format(date_create($datawaybill->result[0]->Data->Created_at),"d-m-Y H:i:s").'</span><br>
                                        <span class="text-muted m-l-5">'.Core::lang('estimation').': '.$datawaybill->result[0]->Route->Estimation.' hari</span>
                                        
                                        <hr>
                                        <table style="width:100%">
                                                <tr>
                                                    <td align="left" rowspan="4"><div id="qrcodeid"></div></td>
                                                    <td align="left"><h5>'.Core::lang('admin').'</h5></td>
                                                    <td align="right"><h5>'.Core::lang('shipper').'</h5></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"></td>
                                                    <td align="right"><br></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"></td>
                                                    <td align="right"><br></td>
                                                </tr>
                                                <tr>
                                                    <td align="left">'.strtoupper($datawaybill->result[0]->Data->Created_by).'</td>
                                                    <td align="right">........................<br><span style="font-size: 11px !important;">'.Core::lang('info_signature_1').'</span></td>
                                                    
                                                </tr>
                                            </table>
                                    </div>

                                    <div class="pull-right">
                                        <address>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('custid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignor->CustomerID.'</td>
                                                    <td align="center"><b> | </b></td>
                                                    <td align="left"><b class="text-muted">'.Core::lang('refid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignee->ReferenceID.'</td>
                                                </tr>
                                            </table>
                                        <svg id="barcode"></svg>
                                            <h3>'.Core::lang('goods_description').'</h3>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 60px;">
                                            '.$datawaybill->result[0]->Goods->Description.'
                                            </p>
                                            
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('actual').' Kg :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight_real.' Kg</td>
                                                    
                                                    <td align="left"><b class="text-muted">'.Core::lang('weight_or_volume').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight.' Kg</td>

                                                    <td align="left"><b class="text-muted">'.Core::lang('bag').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Koli.'</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('insurance_rate').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Insurance->Rate.' %</td>
                                                    
                                                    <td align="left"><b class="text-muted"></b></td>
                                                    <td align="left"></td>

                                                    <td align="left"><b class="text-muted">'.Core::lang('goods_value').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Insurance->Value.'</td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><h3>'.Core::lang('transaction').'</h3></td>
                                                    <td align="right"><h3><b>[</b><b '.(($datawaybill->result[0]->Payment->PaymentID == '1')?'class="text-success"':'').'>'.$datawaybill->result[0]->Payment->Name.'</b><b>]</b></h3></td>
                                                </tr>
                                            </table>
                                            <p>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td class="text-muted">'.Core::lang('shipping_cost').' :</td>
                                                        <td align="right" class="text-primary">'.Core::lang('currency_format').'</td>
                                                        <td align="right"><b class="text-primary">'.number_format($datawaybill->result[0]->Transaction->Shipping_cost).'</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">'.Core::lang('shipping_cost_insurance').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_insurance).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">'.Core::lang('shipping_cost_packing').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_packing).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">'.Core::lang('shipping_cost_forward').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_forward).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">'.Core::lang('shipping_cost_surcharge').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_surcharge).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">'.Core::lang('shipping_cost_admin').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_admin).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">'.Core::lang('shipping_cost_discount').' :</td>
                                                        <td align="right" class="text-danger">'.Core::lang('currency_format').'</td>
                                                        <td align="right"><b class="text-danger">'.number_format($datawaybill->result[0]->Transaction->Shipping_discount).'</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td align="right"></td>
                                                        <td align="right"><hr></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b class="text-muted">'.Core::lang('shipping_cost_total').' :</b></td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right"><b class="text-success">'.number_format($datawaybill->result[0]->Transaction->Shipping_cost_total).'</b></td>
                                                    </tr>
                                                </table>
                                            </p>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <!-- Sheet 1 end -->
                            <!-- Sheet 2 start -->
                            <div class="row">
                            <div class="col-md-12"><hr></div>
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <h3><b class="text-primary">'.Core::getInstance()->title.'</b></h3>
                                        <span style="font-size: 13px !important;">'.$datawaybill->result[0]->Branch->Address.'
                                        <br>
                                        <i class="mdi mdi-phone-classic"></i> : '.$datawaybill->result[0]->Branch->Phone.(empty($datawaybill->result[0]->Branch->Fax)?'':' | <i class="mdi mdi-fax"></i> : '.$datawaybill->result[0]->Branch->Fax).' | <i class="mdi mdi-email-outline"></i> : '.(empty($datawaybill->result[0]->Branch->Email)?Core::getInstance()->email:$datawaybill->result[0]->Branch->Email).'</span>
                                    </div>
                                    <div class="pull-right text-right">
                                        <h3 class="text-right"><b>['.strtoupper($datawaybill->result[0]->Data->DestID).']</b></h3>
                                        <span>'.$datawaybill->result[0]->Route->Mode.'</span><br>
                                        <span style="font-size: 11px !important;"><b>'.Core::lang('sheet_for_goods').'</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12"><hr></div>
                                    <div class="pull-left">
                                        <address>
                                            <h3>'.Core::lang('shipper').':</h3>
                                            <h4><b class="text-success">'.$datawaybill->result[0]->Consignor->Name.'</b> '.(empty($datawaybill->result[0]->Consignor->Alias)?'':'('.$datawaybill->result[0]->Consignor->Alias.')').'</h4>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 100px;">'.$datawaybill->result[0]->Consignor->Address.'<br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignor->Phone.(empty($datawaybill->result[0]->Consignor->Fax)?'':' - <b>'.Core::lang('fax').':</b> '.$datawaybill->result[0]->Consignor->Fax).'
                                            </p>
                                        </address>
                                        <address>
                                            <h3>'.Core::lang('consignee').':</h3>
                                            <h4><b class="font-bold text-danger">'.$datawaybill->result[0]->Consignee->Name.'</b> '.(empty($datawaybill->result[0]->Consignee->Attention)?'':'('.$datawaybill->result[0]->Consignee->Attention.')').'</h4>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 100px;">
                                                '.$datawaybill->result[0]->Consignee->Address.'
                                                <br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Phone.(empty($datawaybill->result[0]->Consignee->Fax)?'':' - <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Fax).'
                                            </p>
                                        </address>
                                        
                                        <h3>'.Core::lang('route_shipment').'</h3>
                                        <span class="text-muted m-l-5">'.$datawaybill->result[0]->Route->Origin.' >> '.$datawaybill->result[0]->Route->Destination.'</span><br>
                                        <span class="text-muted m-l-5">'.Core::lang('date_send').': '.date_format(date_create($datawaybill->result[0]->Data->Created_at),"d-m-Y H:i:s").'</span><br>
                                        <span class="text-muted m-l-5">'.Core::lang('estimation').': '.$datawaybill->result[0]->Route->Estimation.' hari</span>
                                        
                                        <hr>
                                        <table style="width:100%">
                                                <tr>
                                                    <td align="left"><h5>'.Core::lang('admin').'</h5></td>
                                                    <td align="right"><h5>'.Core::lang('shipper').'</h5></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"></td>
                                                    <td align="right"><br></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"></td>
                                                    <td align="right"><br></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><span class="m-l-5">'.strtoupper($datawaybill->result[0]->Data->Created_by).'</span></td>
                                                    <td align="right">........................<br><span style="font-size: 11px !important;">'.Core::lang('info_signature_1').'</span></td>
                                                </tr>
                                            </table>
                                    </div>

                                    <div class="pull-right">
                                        <address>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('custid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignor->CustomerID.'</td>
                                                    <td align="center"><b> | </b></td>
                                                    <td align="left"><b class="text-muted">'.Core::lang('refid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignee->ReferenceID.'</td>
                                                </tr>
                                            </table>
                                        <svg id="barcode"></svg>
                                            <h3>'.Core::lang('goods_instruction').'</h3>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 60px;">
                                            '.$datawaybill->result[0]->Goods->Instruction.'
                                            </p>
                                            <hr>
                                            <h3>'.Core::lang('goods_description').'</h3>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 60px;">
                                            '.$datawaybill->result[0]->Goods->Description.'
                                            </p>
                                            
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('actual').' Kg :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight_real.' Kg</td>
                                                    
                                                    <td align="left"><b class="text-muted">'.Core::lang('weight_or_volume').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight.' Kg</td>

                                                    <td align="left"><b class="text-muted">'.Core::lang('bag').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Koli.'</td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left">'.Core::lang('date_received').' :</td>
                                                    <td align="left"></td>
                                                    <td align="right" rowspan="5"><div id="qrcodeid2"></div></td>
                                                </tr>
                                                <tr>
                                                    <td align="left">'.Core::lang('consignee').'</td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><br></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><br></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                                <tr>
                                                    <td align="left">........................<br><span style="font-size: 11px !important;">'.Core::lang('info_signature_2').'</span></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>
                                            </table>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <!-- Sheet 2 end -->
                        </div>
                    </div>
                </div>

                    <!-- ============================================================== -->
                    <!-- End Page Content -->
                    <!-- ============================================================== -->
                
                    <!-- ============================================================== -->
                    <!-- Additional Print start -->
                    <!-- ============================================================== -->
                    <div class="card card-body">
                        <div class="col-md-12 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">'.Core::lang('print_preview').' '.Core::lang('waybill').' <button id="print2" class="btn btn-themecolor pull-right" type="button"> <span><i class="fa fa-print"></i> '.Core::lang('print').'</span> </button></h3>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Additional Print end -->
                    <!-- ============================================================== -->
                ';
                } else {
                    echo '<div class="col-lg-12">'.Core::getMessage('danger',$callmsg).'</div>';
                }
            ?>
                

                
                

                
                <?php include_once 'sidebar-right.php';?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?php include_once 'global-footer.php';?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <?php include_once 'global-js.php';?>
    <!-- JS Barcode -->
    <script src="../assets/plugins/jsbarcode/JsBarcode.all.min.js"></script>
    <!-- QR Barcode -->
    <script src="../assets/plugins/jsqrcode/qrcode.min.js"></script>
    <!-- Print Area -->
    <script src="js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>
        $(document).ready(function() {
            $("#print").click(function() {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            }),
            $("#print2").click(function() {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
        JsBarcode("#barcode", "<?php echo $waybill?>", {
            format: "code39",
            lineColor: "#000000",
            width: 2,
            height: 30,
            text: "Waybill: <?php echo $waybill?>",
            textMargin: 1,
            textAlign: "right",
            fontSize: 15,
            displayValue: true
        });
        var qrcode = new QRCode(document.getElementById("qrcodeid"), {
            text: "<?php echo $waybill?>",
            width: 100,
            height: 100,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        var qrcode2 = new QRCode(document.getElementById("qrcodeid2"), {
            text: "<?php echo $waybill?>",
            width: 210,
            height: 210,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>

</body>

</html>
