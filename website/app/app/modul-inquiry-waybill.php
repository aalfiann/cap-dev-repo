<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$codeid = (empty($_GET['no'])?'':$_GET['no']);
$refpage = (empty($_GET['ref'])?Core::lang('info').' '.Core::lang('waybill'):'<a href="'.$_GET['ref'].'"><i class="mdi mdi-arrow-left"></i> '.Core::lang('go_back').'</a>');?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('info').' '.Core::lang('waybill')?> - <?php echo Core::getInstance()->title?></title>
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
                    <h3 class="text-themecolor"><?php echo $refpage?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('inquiry')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('waybill')?></li>
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
                <!-- ============================================================== -->
                <!-- Search Box start -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        <div class="input-group">
                            <input id="search" type="text" class="form-control" placeholder="<?php echo Core::lang('input_search')?>" value="<?php echo $codeid?>">
                            <span class="input-group-btn">
                                <button id="submitsearchdt" onclick="getWaybill(document.getElementById('search').value);" class="btn btn-themecolor" type="button"><?php echo Core::lang('search')?></button>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Search Box end -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="col-md-12">
                    <div id="errorinfo"></div>
                    <div id="floatcard" class="card">
                        <div class="card-header">
                            <b><span id="hwaybill"></span> <span id="hstatus"></span> <span id="hrecipient"></span> <span id="hrelation"></span></b>
                            <div class="card-actions">
                                <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <a class="btn-close" onclick="closeCard('floatcard');"><i class="ti-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4><?php echo Core::lang('data').' '.Core::lang('waybill')?></h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('waybill')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="waybill"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('date_send')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="datesend"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('admin')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="admin"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('status')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="status"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('received_by')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="recipient"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('relation_status')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="relation"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('shipper')?></h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('custid')?></b></td>
                                                    <td align="left" colspan="3">: <span id="custid"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('name')?></b></td>
                                                    <td align="left">: <span id="shippername"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('alias')?></b></td>
                                                    <td align="left">: <span id="shipperalias"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('tel')?></b></td>
                                                    <td align="left">: <span id="shipperphone"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('fax')?></b></td>
                                                    <td align="left">: <span id="shipperfax"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('email')?></b></td>
                                                    <td align="left" colspan="3">: <span id="shipperemail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('address')?></b></td>
                                                    <td align="left" colspan="3">:</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" colspan="4"><span id="shipperaddress"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('consignee')?></h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('refid')?></b></td>
                                                    <td align="left" colspan="3">: <span id="refid"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('name')?></b></td>
                                                    <td align="left">: <span id="consigneename"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('att')?></b></td>
                                                    <td align="left">: <span id="consigneeatt"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('tel')?></b></td>
                                                    <td align="left">: <span id="consigneephone"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('fax')?></b></td>
                                                    <td align="left">: <span id="consigneefax"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('address')?></b></td>
                                                    <td align="left" colspan="3">:</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" colspan="4"><span id="consigneeaddress"></span></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-12"><hr></div>
                                        
                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('data_origin')?></h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('branchid')?></b></td>
                                                    <td align="left">: <span id="branchid"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('name')?></b></td>
                                                    <td align="left">: <span id="branchname"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('tel')?></b></td>
                                                    <td align="left">: <span id="branchphone"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('fax')?></b></td>
                                                    <td align="left">: <span id="branchfax"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('email')?></b></td>
                                                    <td align="left" colspan="3">: <span id="branchemail"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('address')?></b></td>
                                                    <td align="left" colspan="3">:</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" colspan="4"><span id="branchaddress"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('route_shipment')?></h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('destid')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="destid"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('mode')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="routemode"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('origin')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="routeorigin"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('destination')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="routedestination"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('estimation')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="routeestimation"></span> <?php echo Core::lang('days')?></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-12"><hr></div>

                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('tariff')?></h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('kgp')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="kgp"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('kgs')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="kgs"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('minkg')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left" colspan="4"><span id="minkg"></span></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('handling')?></h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('hkgp')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="hkgp"></span></td>
                                                    <td align="left"><b><?php echo Core::lang('hkgs')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left"><span id="hkgs"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('hminkg')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left" colspan="4"><span id="hminkg"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_handling')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left" colspan="4"><span id="costhandling"></span></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-12"><hr></div>

                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('goods_detail')?></h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('actkg')?></b></td>
                                                    <td align="left">: <span id="goodsactkg"></span></td>

                                                    <td align="left"><b><?php echo Core::lang('weight')?> Kg</b></td>
                                                    <td align="left">: <span id="goodskg"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('bag')?></b></td>
                                                    <td align="left">: <span id="goodsbag"></span></td>
                                                </tr>
                                            </table>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('goods_instruction')?></b> :</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><span id="goodsinstruction"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('goods_description')?></b> :</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><span id="goodsdescription"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <br>
                                            <h5><?php echo Core::lang('insurance')?> </h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('insurance_rate')?></b> %</td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="insurancerate"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('goods_value')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="goodsvalue"></span></td>
                                                </tr>
                                            </table>
                                            
                                            <br>
                                            <h5>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left"><?php echo Core::lang('transaction')?></td>
                                                        <td align="right"><span id="payment"></span></td>
                                                    </tr>
                                                </table>
                                            </h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="shippingcost"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_insurance')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="shippinginsurance"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_forward')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="shippingforward"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_surcharge')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="shippingsurcharge"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_admin')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="shippingadmin"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_discount')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="shippingdiscount"></span></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"></td>
                                                    <td align="right" colspan="2"><hr style="font-size: 9px !important;margin: 3px 0 3px 0 !important;"></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_total')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right"><span id="shippingcosttotal"></span></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-12"><hr></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h4><?php echo Core::lang('shipment_history')?></h4>
                                    <hr>
                                    <div id="trace" class="profiletimeline"></div>
                                </div>
                            </div>
                        </div>
                    </div>               
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
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
    <script>
        function getWaybill(waybill){
            $(function(){
                clearData();
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/transaction/data/trace/waybill/'.$datalogin['username'].'/'.$datalogin['token'].'/')?>")+encodeURIComponent(waybill)+"?_="+randomText(2),
                    dataType: "json",
                    type: "GET",
                    success: function(data) {
                        if (data.status == "success"){
                            closeCard("floatcard",false);
                            console.log(data.message);
                            $('#hwaybill').html(data.result[0].Data.Waybill.toUpperCase());
                            $('#hstatus').html(' >> '+ucwords(data.result[0].Log.Status));
                            if (!$.isEmptyObject(data.result[0].POD.Recipient)) $('#hrecipient').html(' >> '+data.result[0].POD.Recipient);
                            if (!$.isEmptyObject(data.result[0].POD.Relation)) $('#hrelation').html(' ('+data.result[0].POD.Relation+')');
                            
                            //data waybill
                            $('#waybill').html(data.result[0].Data.Waybill.toUpperCase());
                            $('#datesend').html(formatDate(data.result[0].Data.Created_at,true));
                            $('#admin').html(data.result[0].Data.Created_by.toUpperCase());
                            $('#status').html(ucwords(data.result[0].Log.Status));
                            if (!$.isEmptyObject(data.result[0].POD.Recipient)) $('#recipient').html(data.result[0].POD.Recipient.toUpperCase());
                            if (!$.isEmptyObject(data.result[0].POD.Relation)) $('#relation').html(data.result[0].POD.Relation.toUpperCase());

                            //shipper
                            $('#custid').html(data.result[0].Consignor.CustomerID.toUpperCase());
                            $('#shippername').html(ucwords(data.result[0].Consignor.Name));
                            $('#shipperalias').html(ucwords(data.result[0].Consignor.Alias));
                            $('#shipperphone').html(data.result[0].Consignor.Phone);
                            $('#shipperfax').html(data.result[0].Consignor.Fax);
                            $('#shipperemail').html(data.result[0].Consignor.Email.toLowerCase());
                            $('#shipperaddress').html(data.result[0].Consignor.Address);

                            //consignee
                            $('#refid').html(data.result[0].Consignee.ReferenceID.toUpperCase());
                            $('#consigneename').html(ucwords(data.result[0].Consignee.Name));
                            $('#consigneeatt').html(ucwords(data.result[0].Consignee.Attention));
                            $('#consigneephone').html(data.result[0].Consignee.Phone);
                            $('#consigneefax').html(data.result[0].Consignee.Fax);
                            $('#consigneeaddress').html(data.result[0].Consignee.Address);

                            //origin
                            $('#branchid').html(data.result[0].Branch.ID.toUpperCase());
                            $('#branchname').html(ucwords(data.result[0].Branch.Origin));
                            $('#branchphone').html(data.result[0].Branch.Phone);
                            $('#branchfax').html(data.result[0].Branch.Fax);
                            $('#branchemail').html(data.result[0].Branch.Email.toLowerCase());
                            $('#branchaddress').html(data.result[0].Branch.Address);

                            //route
                            $('#destid').html(data.result[0].Data.DestID.toUpperCase());
                            $('#routemode').html(ucwords(data.result[0].Route.Mode));
                            $('#routeorigin').html(ucwords(data.result[0].Route.Origin));
                            $('#routedestination').html(ucwords(data.result[0].Route.Destination));
                            $('#routeestimation').html(data.result[0].Route.Estimation);

                            //tariff
                            $('#kgp').html(addCommas(data.result[0].Tariff.KGP));
                            $('#kgs').html(addCommas(data.result[0].Tariff.KGS));
                            $('#minkg').html(data.result[0].Tariff.MinKG);
                            
                            //tariff handling
                            $('#hkgp').html(addCommas(data.result[0].Tariff_handling.KGP));
                            $('#hkgs').html(addCommas(data.result[0].Tariff_handling.KGS));
                            $('#hminkg').html(data.result[0].Tariff_handling.MinKG);
                            $('#costhandling').html(addCommas(data.result[0].Transaction.Shipping_handling));

                            //goods detail
                            $('#goodsactkg').html(data.result[0].Goods.Weight_real);
                            $('#goodskg').html(data.result[0].Goods.Weight);
                            $('#goodsbag').html(data.result[0].Goods.Koli);
                            $('#goodsinstruction').html(data.result[0].Goods.Instruction);
                            $('#goodsdescription').html(data.result[0].Goods.Description);

                            //insurance
                            $('#insurancerate').html(data.result[0].Insurance.Rate);
                            $('#goodsvalue').html(addCommas(data.result[0].Insurance.Value));

                            //transaction
                            $('#payment').html('['+ucwords(data.result[0].Payment.Name)+']');
                            $('#shippingcost').html(addCommas(data.result[0].Transaction.Shipping_cost));
                            $('#shippinginsurance').html(addCommas(data.result[0].Transaction.Shipping_insurance));
                            $('#shippingpacking').html(addCommas(data.result[0].Transaction.Shipping_packing));
                            $('#shippingforward').html(addCommas(data.result[0].Transaction.Shipping_forward));
                            $('#shippingsurcharge').html(addCommas(data.result[0].Transaction.Shipping_surcharge));
                            $('#shippingadmin').html(addCommas(data.result[0].Transaction.Shipping_admin));
                            $('#shippingdiscount').html(addCommas(data.result[0].Transaction.Shipping_discount));
                            $('#shippingcosttotal').html(addCommas(data.result[0].Transaction.Shipping_cost_total));

                            //trace
                            $.each(data.result[0].Trace, function(index, value){
                                var icon = "";
                                if (value.StatusID == '19'){icon = "close";} else {icon = "check";}
                                $('#trace').append('<div class="sl-item">\
                                            <div class="sl-left"><b><i class="mdi mdi-'+icon+'"></i></b> </div>\
                                            <div class="sl-right">\
                                                <div class="link">'+ucwords(value.Status)+' <span class="sl-date">'+formatDate(value.Created_at,true)+'</span>\
                                                    <p>'+value.Description+'</p>\
                                                </div>\
                                            </div>\
                                        </div>\
                                        <hr>');
                            });
                        } else {
                            console.log(data.message);
                            writeMessage('#errorinfo','danger',data.message);
                            closeCard('floatcard');
                        }
                    },
                    error: function(x, e) {}
                }); 
            });    
        }

        function closeCard(selectorid,todo=true){
            if (todo){
                var div = document.getElementById(selectorid);
                div.style.display = "none";
            } else {
                var div = document.getElementById(selectorid);
                div.style.display = "block";
            }
        }

        function clearData(){
            /* clear from */
            $("#floatcard").find("span").html("").end();
            $("#trace").html("");
            $('#errorinfo').html("");
        }

        /** 
         * Create event enter key on search (Pure JS)
         * Usage: button id in search element must be set to submitsearchdt
         */
        document.getElementById("search").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("submitsearchdt").click();
            }
        });

        /* onload event */
        $(function(){
            closeCard('floatcard');
        });
    </script>
</body>

</html>
