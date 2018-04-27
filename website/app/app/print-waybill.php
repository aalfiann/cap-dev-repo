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
                    echo '
                    <div class="d-md-none d-lg-none d-xl-none">'.Core::getMessage('primary',Core::lang('print_desktop_notice')).'</div>
                    <!-- ============================================================== -->
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
                    <!-- Start Print Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <!-- Sheet 1 start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <h3><b class="text-primary">'.Core::getInstance()->title.'</b></h3>
                                        <span style="font-size: 9px !important;">'.$datawaybill->result[0]->Branch->Address.'
                                        <br>
                                        <i class="mdi mdi-phone-classic"></i> : '.$datawaybill->result[0]->Branch->Phone.(empty($datawaybill->result[0]->Branch->Fax)?'':' | <i class="mdi mdi-fax"></i> : '.$datawaybill->result[0]->Branch->Fax).' | <i class="mdi mdi-email-outline"></i> : '.(empty($datawaybill->result[0]->Branch->Email)?Core::getInstance()->email:$datawaybill->result[0]->Branch->Email).'</span>
                                    </div>
                                    <div class="pull-right text-right">
                                        <h3><b>['.strtoupper($datawaybill->result[0]->Data->DestID).']</b></h3>
                                        <span style="font-size: 10px !important;">'.$datawaybill->result[0]->Route->Mode.'</span><br>
                                        <span style="font-size: 6px !important;"><b>'.Core::lang('sheet_for_shipper').'</b></span>                                          
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"><hr style="font-size: 9px !important;margin: 3px 0 10px 0 !important;border: none;border-top: solid 2px #aaa;"></div>
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <span style="font-size: 11px !important;">'.Core::lang('shipper').':</span><br>
                                            <h6 style="font-size: 10px !important;"><b class="text-success m-l-5">'.$datawaybill->result[0]->Consignor->Name.'</b> '.(empty($datawaybill->result[0]->Consignor->Alias)?'':'('.$datawaybill->result[0]->Consignor->Alias.')').'</h6>
                                            <p class="text-muted m-l-5" style="width: 300px;height: 60px;font-size: 9px !important;">'.$datawaybill->result[0]->Consignor->Address.'<br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignor->Phone.(empty($datawaybill->result[0]->Consignor->Fax)?'':' - <b>'.Core::lang('fax').':</b> '.$datawaybill->result[0]->Consignor->Fax).'
                                            </p>
                                        </address>
                                        <address>
                                            <span style="font-size: 11px !important;">'.Core::lang('consignee').':</span><br>
                                            <h6 style="font-size: 10px !important;"><b class="font-bold text-danger m-l-5">'.$datawaybill->result[0]->Consignee->Name.'</b> '.(empty($datawaybill->result[0]->Consignee->Attention)?'':'('.$datawaybill->result[0]->Consignee->Attention.')').'</h6>
                                            <p class="text-muted m-l-5" style="width: 300px;height: 60px;font-size: 9px !important;">
                                                '.$datawaybill->result[0]->Consignee->Address.'
                                                <br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Phone.(empty($datawaybill->result[0]->Consignee->Fax)?'':' - <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Fax).'
                                            </p>
                                        </address>
                                        
                                        <span style="font-size: 11px !important;">'.Core::lang('route_shipment').'</span><br>
                                        <span style="font-size: 9px !important;" class="text-muted m-l-5">'.$datawaybill->result[0]->Route->Origin.' >> '.$datawaybill->result[0]->Route->Destination.'</span><br>
                                        <span style="font-size: 9px !important;" class="text-muted m-l-5">'.Core::lang('date_send').': '.date_format(date_create($datawaybill->result[0]->Data->Created_at),"d-m-Y H:i:s").'</span><br>
                                        <span style="font-size: 9px !important;" class="text-muted m-l-5">'.Core::lang('estimation').': '.$datawaybill->result[0]->Route->Estimation.' hari</span>
                                        
                                        <hr style="font-size: 9px !important;margin: 3px 0 3px 0 !important;">
                                        <table style="width:300px">
                                            <tr>
                                                <td align="left" rowspan="4"><div id="qrcodeid"></div></td>
                                                <td align="left"><span style="font-size: 9px !important;">'.Core::lang('admin').'</span></td>
                                                <td align="right"><span style="font-size: 9px !important;">'.Core::lang('shipper').'</span></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><span style="font-size: 9px !important;"></span></tr>
                                                <td align="right"><span style="font-size: 9px !important;"><br></span></tr>
                                            </tr>
                                            <tr>
                                                <td align="left"><span style="font-size: 9px !important;">'.strtoupper($datawaybill->result[0]->Data->Created_by).'</span></td>
                                                <td align="right"><span style="font-size: 6px !important;">........................<br>'.Core::lang('info_signature_1').'</span></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="pull-right">
                                        <address>
                                            <table style="width:300px;font-size: 9px !important;">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('custid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignor->CustomerID.'</td>
                                                    <td align="center"><b> | </b></td>
                                                    <td align="left"><b class="text-muted">'.Core::lang('refid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignee->ReferenceID.'</td>
                                                </tr>
                                                <tr>
                                                    <td align="right" colspan="5"><svg id="barcode"></svg></td>
                                                </tr>
                                            </table>
                                               
                                            <span style="font-size: 11px !important;">'.Core::lang('goods_description').'</span>
                                            <p class="text-muted m-l-5" style="width: 300px;height: 40px;font-size: 9px !important;">
                                            '.$datawaybill->result[0]->Goods->Description.'
                                            </p>
                                            
                                            <table style="width:300px;font-size: 9px !important;">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('actkg').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight_real.' Kg</td>
                                                    
                                                    <td align="left"><b class="text-muted">'.Core::lang('weight_or_volume').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight.' Kg</td>

                                                    <td align="left"><b class="text-muted">'.Core::lang('bag').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Koli.'</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('insurance_rate').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Insurance->Rate.' %</td>
                                                    
                                                    <td align="left"><b class="text-muted">'.Core::lang('goods_value').' :</b></td>
                                                    <td align="right" colspan="3">'.$datawaybill->result[0]->Insurance->Value.'</td>
                                                </tr>
                                            </table>
                                            <hr style="font-size: 9px !important;margin: 3px 0 3px 0 !important;">
                                            <table style="width:300px;font-size: 11px !important;">
                                                <tr>
                                                    <td align="left">'.Core::lang('transaction').'</td>
                                                    <td align="right"><b>[</b><b '.(($datawaybill->result[0]->Payment->PaymentID == '1')?'class="text-success"':'').'>'.$datawaybill->result[0]->Payment->Name.'</b><b>]</b></td>
                                                </tr>
                                            </table>
                                            <table style="width:300px;font-size: 9px !important;">
                                                    <tr>
                                                        <td class="text-muted">  '.Core::lang('shipping_cost').' :</td>
                                                        <td align="right" class="text-primary">'.Core::lang('currency_format').'</td>
                                                        <td align="right"><b class="text-primary">'.number_format($datawaybill->result[0]->Transaction->Shipping_cost).'</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">  '.Core::lang('shipping_cost_insurance').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_insurance).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">  '.Core::lang('shipping_cost_packing').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_packing).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">  '.Core::lang('shipping_cost_forward').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_forward).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">  '.Core::lang('shipping_cost_surcharge').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_surcharge).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">  '.Core::lang('shipping_cost_admin').' :</td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right">'.number_format($datawaybill->result[0]->Transaction->Shipping_admin).'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">  '.Core::lang('shipping_cost_discount').' :</td>
                                                        <td align="right" class="text-danger">'.Core::lang('currency_format').'</td>
                                                        <td align="right"><b class="text-danger">'.number_format($datawaybill->result[0]->Transaction->Shipping_discount).'</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td align="right"></td>
                                                        <td align="right"><hr style="font-size: 9px !important;margin: 2px 0 2px 0 !important;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b class="text-muted">  '.Core::lang('shipping_cost_total').' :</b></td>
                                                        <td align="right">'.Core::lang('currency_format').'</td>
                                                        <td align="right"><b class="text-success">'.number_format($datawaybill->result[0]->Transaction->Shipping_cost_total).'</b></td>
                                                    </tr>
                                                </table>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <!-- Sheet 1 end -->
                            <div class="col-md-12"><hr style="border-top: dotted 1px;"></div>
                            <!-- Sheet 2 start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <h3><b class="text-primary">'.Core::getInstance()->title.'</b></h3>
                                        <span style="font-size: 9px !important;">'.$datawaybill->result[0]->Branch->Address.'
                                        <br>
                                        <i class="mdi mdi-phone-classic"></i> : '.$datawaybill->result[0]->Branch->Phone.(empty($datawaybill->result[0]->Branch->Fax)?'':' | <i class="mdi mdi-fax"></i> : '.$datawaybill->result[0]->Branch->Fax).' | <i class="mdi mdi-email-outline"></i> : '.(empty($datawaybill->result[0]->Branch->Email)?Core::getInstance()->email:$datawaybill->result[0]->Branch->Email).'</span>
                                    </div>
                                    <div class="pull-right text-right">
                                        <h3><b>['.strtoupper($datawaybill->result[0]->Data->DestID).']</b></h3>
                                        <span style="font-size: 10px !important;">'.$datawaybill->result[0]->Route->Mode.'</span><br>
                                        <span style="font-size: 6px !important;"><b>'.Core::lang('sheet_for_goods').'</b></span>                                          
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"><hr style="font-size: 9px !important;margin: 3px 0 10px 0 !important;border: none;border-top: solid 2px #aaa;"></div>
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <span style="font-size: 11px !important;">'.Core::lang('shipper').':</span><br>
                                            <h6 style="font-size: 10px !important;"><b class="text-success m-l-5">'.$datawaybill->result[0]->Consignor->Name.'</b> '.(empty($datawaybill->result[0]->Consignor->Alias)?'':'('.$datawaybill->result[0]->Consignor->Alias.')').'</h6>
                                            <p class="text-muted m-l-5" style="width: 300px;height: 60px;font-size: 9px !important;">'.$datawaybill->result[0]->Consignor->Address.'<br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignor->Phone.(empty($datawaybill->result[0]->Consignor->Fax)?'':' - <b>'.Core::lang('fax').':</b> '.$datawaybill->result[0]->Consignor->Fax).'
                                            </p>
                                        </address>
                                        <address>
                                            <span style="font-size: 11px !important;">'.Core::lang('consignee').':</span><br>
                                            <h6 style="font-size: 10px !important;"><b class="font-bold text-danger m-l-5">'.$datawaybill->result[0]->Consignee->Name.'</b> '.(empty($datawaybill->result[0]->Consignee->Attention)?'':'('.$datawaybill->result[0]->Consignee->Attention.')').'</h6>
                                            <p class="text-muted m-l-5" style="width: 300px;height: 60px;font-size: 9px !important;">
                                                '.$datawaybill->result[0]->Consignee->Address.'
                                                <br>
                                                <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Phone.(empty($datawaybill->result[0]->Consignee->Fax)?'':' - <b>'.Core::lang('tel').':</b> '.$datawaybill->result[0]->Consignee->Fax).'
                                            </p>
                                        </address>
                                        
                                        <span style="font-size: 11px !important;">'.Core::lang('route_shipment').'</span><br>
                                        <span style="font-size: 9px !important;" class="text-muted m-l-5">'.$datawaybill->result[0]->Route->Origin.' >> '.$datawaybill->result[0]->Route->Destination.'</span><br>
                                        <span style="font-size: 9px !important;" class="text-muted m-l-5">'.Core::lang('date_send').': '.date_format(date_create($datawaybill->result[0]->Data->Created_at),"d-m-Y H:i:s").'</span><br>
                                        <span style="font-size: 9px !important;" class="text-muted m-l-5">'.Core::lang('estimation').': '.$datawaybill->result[0]->Route->Estimation.' hari</span>
                                        
                                        <hr style="font-size: 9px !important;margin: 3px 0 3px 0 !important;">
                                        <table style="width:300px">
                                            <tr>
                                                <td align="left"><span style="font-size: 9px !important;">'.Core::lang('admin').'</span></td>
                                                <td align="right"><span style="font-size: 9px !important;">'.Core::lang('shipper').'</span></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><span style="font-size: 9px !important;"></span></tr>
                                                <td align="right"><span style="font-size: 9px !important;"><br></span></tr>
                                            </tr>
                                            <tr>
                                                <td align="left"><span style="font-size: 9px !important;">'.strtoupper($datawaybill->result[0]->Data->Created_by).'</span></td>
                                                <td align="right"><span style="font-size: 6px !important;">........................<br>'.Core::lang('info_signature_1').'</span></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="pull-right">
                                        <address>
                                            <table style="width:300px;font-size: 9px !important;">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('custid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignor->CustomerID.'</td>
                                                    <td align="center"><b> | </b></td>
                                                    <td align="left"><b class="text-muted">'.Core::lang('refid').' :</b></td>
                                                    <td align="right">'.$datawaybill->result[0]->Consignee->ReferenceID.'</td>
                                                </tr>
                                                <tr>
                                                    <td align="right" colspan="5"><svg id="barcode"></svg></td>
                                                </tr>
                                            </table>
                                            <span style="font-size: 11px !important;">'.Core::lang('goods_instruction').'</span>
                                            <p class="text-muted m-l-5" style="width: 300px;height: 40px;font-size: 9px !important;">
                                            '.$datawaybill->result[0]->Goods->Instruction.'
                                            </p>
                                            <hr style="font-size: 9px !important;margin: 3px 0 3px 0 !important;">
                                            <span style="font-size: 11px !important;">'.Core::lang('goods_description').'</span>
                                            <p class="text-muted m-l-5" style="width: 300px;height: 40px;font-size: 9px !important;">
                                            '.$datawaybill->result[0]->Goods->Description.'
                                            </p>
                                            
                                            <table style="width:300px;font-size: 9px !important;">
                                                <tr>
                                                    <td align="left"><b class="text-muted">'.Core::lang('actkg').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight_real.' Kg</td>
                                                    
                                                    <td align="left"><b class="text-muted">'.Core::lang('weight_or_volume').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Weight.' Kg</td>

                                                    <td align="left"><b class="text-muted">'.Core::lang('bag').' :</b></td>
                                                    <td align="left">'.$datawaybill->result[0]->Goods->Koli.'</td>
                                                </tr>
                                            </table>
                                            <hr style="font-size: 9px !important;margin: 3px 0 3px 0 !important;">
                                            <table style="width:300px;font-size: 9px !important;">
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
                                                    <td align="left">........................<br><span style="font-size: 6px !important;">'.Core::lang('info_signature_2').'</span></td>
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
                    <!-- End Print Page Content -->
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
            width: 1,
            height: 30,
            text: "Waybill: <?php echo $waybill?>",
            textMargin: 1,
            textAlign: "right",
            fontSize: 9,
            displayValue: true
        });
        var qrcode = new QRCode(document.getElementById("qrcodeid"), {
            text: "<?php echo $waybill?>",
            width: 50,
            height: 50,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        var qrcode2 = new QRCode(document.getElementById("qrcodeid2"), {
            text: "<?php echo $waybill?>",
            width: 100,
            height: 100,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>

</body>

</html>
