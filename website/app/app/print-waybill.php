<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$refpage = (empty($_GET['ref'])?'modul-transaction.php':$_GET['ref']);
$waybill = (empty($_GET['no'])?'0000000000000':$_GET['no']);
$datalogin = Core::checkSessions();?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('print_preview').' '.Core::lang('waybill')?> - <?php echo Core::getInstance()->title?></title>
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
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('print_preview').' '.Core::lang('waybill')?> <button id="print" class="btn btn-themecolor pull-right" type="button"> <span><i class="fa fa-print"></i> Print</span> </button></h3>
                        
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <h3><b class="text-primary"><?php echo Core::getInstance()->title?></b></h3>
                                        <span style="font-size: 13px !important;">Jl. Dewi Sartika No.182 Jakarta Timur
                                        <br>
                                        <i class="mdi mdi-phone-classic"></i> : 083806075400 | <i class="mdi mdi-fax"></i> : 021123123 | <i class="mdi mdi-email-outline"></i> : cs@cap-express.co.id</span>
                                    </div>
                                    <div class="pull-right text-right">
                                        <h3 class="text-right"><b>[CGK]</b></h3>
                                        <span>Road Freight</span><br>
                                        <span style="font-size: 11px !important;"><b>Lembar 1 untuk pengirim.</b></span>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12"><hr></div>
                                    <div class="pull-left">
                                        <address>
                                            <h3>From:</h3>
                                            <h4><b class="text-success">Material Pro Admin</b> (M ABD AZIZ ALFIAN)</h4>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 100px;">Jl. H. Taiman Ujung Blok J110 No.08 RT. 08 RW. 09, Kampung Tengah, Kramat Jati, Jakarta Timur - 14560
                                             (Dekat Masjid al fitrah, Depot Megaqua) <br>
                                                 <b>Telp:</b> 021976998 - <b>Fax:</b> 02101203123</p>
                                        </address>
                                        <address>
                                            <h3>To:</h3>
                                            <h4><b class="font-bold text-danger">Gaala & Sons</b> (Bpk. Budi)</h4>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 100px;">E 104, Dharti-2,
                                                 Nr' Viswakarma Temple,
                                                 Talaja Road,
                                                 Bhavnagar - 364002<br>
                                                 <b>Telp:</b> 021976998 - <b>Fax:</b> 02101203123</p>
                                        </address>
                                        
                                        <h3>Route</h3>
                                            <span>Jakarta Selatan >> Kalimantan Selatan</span><br>
                                            <span>Tanggal Kirim: 15-09-2018</span><br>
                                            <span>Estimasi: 1 hari</span>
                                    </div>

                                    <div class="pull-right">
                                        <address>
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><b class="text-muted">Customer ID :</b></td>
                                                    <td align="left">123123124</td>
                                                    
                                                    <td align="left"><b class="text-muted">Reference ID :</b></td>
                                                    <td align="left">123123124</td>
                                                </tr>
                                            </table>
                                        <svg id="barcode"></svg>
                                            <h3>Goods Detail</h3>
                                            <p class="text-muted m-l-5" style="width: 500px;height: 60px;">
                                            PAKET SEPATU KACA<br>
                                            PAKET SEPATU KACA<br>
                                            PAKET SEPATU KACA<br>
                                            </p>
                                            <p class="text-muted m-l-5"><span><b>Actual Kg:</b> 1 Kg, <b>Berat:</b> 1 Kg, <b>Koli:</b> 1<br>
                                            <b>Rate Asuransi %:</b> 0.02, <b>Nilai Barang:</b> 1,000,000</span></p>
                                            
                                            
                                            <table style="width:100%">
                                                <tr>
                                                    <td align="left"><h3>Transaction</h3></td>
                                                    <td align="right"><h3><b>[</b><b class="text-success">CASH</b><b>]</b></h3></td>
                                                </tr>
                                            </table>
                                            <p>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td class="text-muted">Shipping Cost :</td>
                                                        <td align="right" class="text-primary"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right"><b class="text-primary">10,000</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Shipping Insurance :</td>
                                                        <td align="right"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right">1,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Shipping Packing :</td>
                                                        <td align="right"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right">1,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Shipping Forward :</td>
                                                        <td align="right"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right">1,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Shipping Surcharge :</td>
                                                        <td align="right"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right">1,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Shipping Admin :</td>
                                                        <td align="right"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right">1,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Shipping Discount :</td>
                                                        <td align="right" class="text-danger"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right"><b class="text-danger">1,000</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td align="right"></td>
                                                        <td align="right"><hr></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b class="text-muted">Total :</b></td>
                                                        <td align="right"><?php echo Core::lang('currency_format')?></td>
                                                        <td align="right"><b class="text-success">1,000</b></td>
                                                    </tr>
                                                </table>
                                                
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12"><hr></div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Description</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Cost</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>Milk Powder</td>
                                                    <td class="text-right">2 </td>
                                                    <td class="text-right"> $24 </td>
                                                    <td class="text-right"> $48 </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>Air Conditioner</td>
                                                    <td class="text-right"> 3 </td>
                                                    <td class="text-right"> $500 </td>
                                                    <td class="text-right"> $1500 </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3</td>
                                                    <td>RC Cars</td>
                                                    <td class="text-right"> 20 </td>
                                                    <td class="text-right"> %600 </td>
                                                    <td class="text-right"> $12000 </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">4</td>
                                                    <td>Down Coat</td>
                                                    <td class="text-right"> 60 </td>
                                                    <td class="text-right">$5 </td>
                                                    <td class="text-right"> $300 </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>Sub - Total amount: $13,848</p>
                                        <p>vat (10%) : $138 </p>
                                        <hr>
                                        <h3><b>Total :</b> $13,986</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- End Page Content -->
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
    <!-- JS Barcode -->
    <script src="../assets/plugins/jsbarcode/JsBarcode.all.min.js"></script>
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
            });
        });
        JsBarcode("#barcode", "<?php echo $waybill?>", {
  format: "code39",
  lineColor: "#000000",
  width: 2,
  height: 30,
  textMargin: 1,
  textAlign: "right",
  fontSize: 15,
  displayValue: true
});
    </script>

</body>

</html>
