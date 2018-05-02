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
                            <input id="search" type="text" class="form-control" placeholder="<?php echo Core::lang('input_search')?>">
                            <span class="input-group-btn">
                                <button id="submitsearchdt" onclick="loadData(document.getElementById('search').value);" class="btn btn-themecolor" type="button"><?php echo Core::lang('search')?></button>
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
                    <div id="floatcard" class="card">
                        <div class="card-header">
                            <b>CGS12342414 >> On Process</b>
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
                                                    <td align="left">CGS1231231234</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('date_send')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left">2018-12-30 12:54:33</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('admin')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left">RESLIM</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('status')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left">Failed</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('received_by')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left">JOKOWI</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="30%"><b><?php echo Core::lang('relation_status')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left">SECURITY</td>
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
                                                    <td align="left" colspan="3">: 1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('name')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                    <td align="left"><b><?php echo Core::lang('alias')?></b></td>
                                                    <td align="left">: </td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('tel')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                    <td align="left"><b><?php echo Core::lang('fax')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('email')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                    <td align="left"></td>
                                                    <td align="left"></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('address')?></b></td>
                                                    <td align="left" colspan="3">:</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" colspan="4">Jl. H. Taiman Ujung No.08 Rt.06 Rw.04 Kel. Tengah Kec. Kramat Jati Jakarta Timur 14570 Indonesia</td>
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
                                                    <td align="left" colspan="3">: 1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('name')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                    <td align="left"><b><?php echo Core::lang('att')?></b></td>
                                                    <td align="left">: </td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('tel')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                    <td align="left"><b><?php echo Core::lang('fax')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('address')?></b></td>
                                                    <td align="left" colspan="3">:</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" colspan="4">Jl. H. Taiman Ujung No.08 Rt.06 Rw.04 Kel. Tengah Kec. Kramat Jati Jakarta Timur 14570 Indonesia</td>
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
                                                    <td align="left">: 1241248787123</td>
                                                    <td align="left"><b><?php echo Core::lang('name')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('tel')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                    <td align="left"><b><?php echo Core::lang('fax')?></b></td>
                                                    <td align="left">: 1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('email')?></b></td>
                                                    <td align="left" colspan="3">: 1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('address')?></b></td>
                                                    <td align="left" colspan="3">:</td>
                                                </tr>
                                                <tr>
                                                    <td align="left" colspan="4">Jl. H. Taiman Ujung No.08 Rt.06 Rw.04 Kel. Tengah Kec. Kramat Jati Jakarta Timur 14570 Indonesia</td>
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
                                                    <td align="right">cgs</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('mode')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">Road Freight</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('origin')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">Jakarta</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('destination')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">Jakarta Timur</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('estimation')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">1 <?php echo Core::lang('days')?></td>
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
                                                    <td align="left">25,000</td>
                                                    <td align="left"><b><?php echo Core::lang('kgs')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left">1,500</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('minkg')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left" colspan="4">25</td>
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
                                                    <td align="left">25,000</td>
                                                    <td align="left"><b><?php echo Core::lang('hkgs')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left">1,500</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('hminkg')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left" colspan="4">25</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_handling')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="left" colspan="4">22,000</td>
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
                                                    <td align="left">: 49.74</td>

                                                    <td align="left"><b><?php echo Core::lang('weight')?> Kg</b></td>
                                                    <td align="left">: 50</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('bag')?></b></td>
                                                    <td align="left">: 12</td>
                                                </tr>
                                            </table>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('goods_instruction')?></b> :</td>
                                                </tr>
                                                <tr>
                                                    <td align="left">1241248787123</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('goods_description')?></b> :</td>
                                                </tr>
                                                <tr>
                                                    <td align="left">1241248787123</td>
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
                                                    <td align="right">0.02</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('goods_value')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">1.000.000</td>
                                                </tr>
                                            </table>
                                            
                                            <br>
                                            <h5>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td align="left"><?php echo Core::lang('transaction')?></td>
                                                        <td align="right">[Cash]</td>
                                                    </tr>
                                                </table>
                                            </h5>
                                            <hr>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">25,000</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_insurance')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">1,000</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_forward')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">0</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_surcharge')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">0</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_admin')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">0</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_discount')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">0</td>
                                                </tr>
                                                <tr>
                                                    <td align="left"></td>
                                                    <td align="right" colspan="2"><hr style="font-size: 9px !important;margin: 3px 0 3px 0 !important;"></td>
                                                </tr>
                                                <tr>
                                                    <td align="left"><b><?php echo Core::lang('shipping_cost_total')?></b></td>
                                                    <td align="left">:</td>
                                                    <td align="right">26,000</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-12"><hr></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h4><?php echo Core::lang('shipment_history')?></h4>
                                    <hr>

                                    <div class="profiletimeline">
                                        <div class="sl-item">
                                            <div class="sl-left"> <b><i class="mdi mdi-check"></i></b> </div>
                                            <div class="sl-right">
                                                <div class="link">On Process <span class="sl-date">15-08-2018 15:33:28</span>
                                                    <p>Menunggu proses kirim barang</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="sl-item">
                                            <div class="sl-left"> <b><i class="mdi mdi-close"></i></b> </div>
                                            <div class="sl-right">
                                                <div class="link">Failed <span class="sl-date">15-08-2018 15:33:28</span>
                                                    <p>Alamat tidak ketemu</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

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
</body>

</html>
