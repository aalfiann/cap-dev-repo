<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$fd = (empty($_GET['fd'])?'':$_GET['fd']);
$ld = (empty($_GET['ld'])?'':$_GET['ld']);
$s = (empty($_GET['s'])?'':$_GET['s']);
$type = (empty($_GET['item_id'])?Core::lang('invoice_item_id'):$_GET['item_id']);
$refdate = ((!empty($_GET['fd']) && !empty($_GET['ld']))?'?fd='.$fd.'&ld='.$ld.'&s='.$s:'');
$refpage = (empty($_GET['ref'])?'modul-invoice.php':$_GET['ref'].$refdate);
$codeid = (empty($_GET['no'])?'000000000000000':$_GET['no']);
$datalogin = Core::checkSessions();
// Get data invoice
$urlinvoice = Core::getInstance()->api.'/invoice/data/read/'.$codeid.'/'.$datalogin['username'].'/'.$datalogin['token'];
$datainvoice = json_decode(Core::execGetRequest($urlinvoice));
$callsuccess = false;
$callmsg = "";
if (!empty($datainvoice)){
    if ($datainvoice->{'status'} == 'success'){
        $callsuccess = true;
        $callmsg = $datainvoice->{'message'};
    } else {
        $callsuccess = false;
        $callmsg = $datainvoice->{'message'};
    }
} else {
    $callsuccess = false;
    $callmsg = Core::lang('core_not_connected');
}
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}
function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }     		
    return $hasil;
}
?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('invoice'),'-'.$codeid?></title>
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('data')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('print_preview').' '.Core::lang('invoice')?></li>
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
                            <h3 class="text-themecolor m-b-0 m-t-0">'.Core::lang('print_preview').' '.Core::lang('invoice').' <button id="print" class="btn btn-themecolor pull-right" type="button"> <span><i class="fa fa-print"></i> '.Core::lang('print').'</span> </button></h3>
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
                                <h3><b>'.strtoupper(Core::lang('invoice')).'</b> <span class="pull-right">#'.$datainvoice->result[0]->InvoiceID.'</span></h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-left">
                                            <address>
                                                <h3> &nbsp;<b class="text-primary">'.(!empty($datainvoice->result[0]->From_name_company)?$datainvoice->result[0]->From_name_company:$datainvoice->result[0]->From_name).'</b></h3>
                                                <p class="text-muted m-l-5">
                                                    '.preg_replace("/[\r\n]+/", "<br>", $datainvoice->result[0]->From_address).'
                                                    '.(!empty($datainvoice->result[0]->From_email)?'<br>'.$datainvoice->result[0]->From_email:'').'
                                                    '.(!empty($datainvoice->result[0]->From_phone)?'<br>'.$datainvoice->result[0]->From_phone:'').'
                                                    '.(!empty($datainvoice->result[0]->From_website)?'<br>'.$datainvoice->result[0]->From_website:'').'
                                                </p>
                                            </address>
                                            <p>'.Core::lang('invoice_payment').' via:
                                                <b><br> BANK '.$datainvoice->result[0]->Custom_field->Bank_name.'
                                                    <br> '.$datainvoice->result[0]->Custom_field->Bank_account_no.'
                                                    <br> '.$datainvoice->result[0]->Custom_field->Bank_account_name.'
                                                </b>
                                            </p>
                                        </div>
                                        <div class="pull-right text-right">
                                            <address>
                                                <h3>'.Core::lang('invoice_to').',</h3>
                                                <h4 class="font-bold">'.(!empty($datainvoice->result[0]->To_name_company)?$datainvoice->result[0]->To_name_company:$datainvoice->result[0]->To_name).'</h4>
                                                <p class="text-muted m-l-5">
                                                    '.preg_replace("/[\r\n]+/", "<br>", $datainvoice->result[0]->To_address).'
                                                    '.(!empty($datainvoice->result[0]->To_email)?'<br>'.$datainvoice->result[0]->To_email:'').'
                                                    '.(!empty($datainvoice->result[0]->To_phone)?'<br>'.$datainvoice->result[0]->To_phone:'').'
                                                    '.(!empty($datainvoice->result[0]->To_website)?'<br>'.$datainvoice->result[0]->To_website:'').'
                                                </p>
                                                <p><b>'.Core::lang('invoice_date').' :</b> <i class="fa fa-calendar"></i> '.date('d M Y',strtotime($datainvoice->result[0]->Created_at)).'<br>
                                                <b>'.Core::lang('invoice_due_date').' :</b> <i class="fa fa-calendar"></i> '.date('d M Y',strtotime($datainvoice->result[0]->Due_date)).'</p>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive" style="clear: both;">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">#</th>
                                                        <th width="10%">'.Core::lang('invoice_date').'</th>
                                                        <th width="10%" nowrap>'.$type.'</th>
                                                        <th>'.Core::lang('invoice_description').'</th>
                                                        <th width="5%" class="text-right">'.Core::lang('invoice_qty').'</th>
                                                        <th width="10%" class="text-right">'.Core::lang('invoice_amount').'</th>
                                                        <th width="10%" class="text-right">'.Core::lang('invoice_total').'</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ';
                                                    foreach($datainvoice->result[0]->Data_table as $key => $value){
                                                        echo '<tr style="font-size: 11px !important;line-height:5px;">
                                                            <td>'.($key+1).'</td>
                                                            <td>'.$value->date.'</td>
                                                            <td>'.$value->po.'</td>
                                                            <td>'.$value->desc.'</td>
                                                            <td class="text-right">'.$value->qty.'</td>
                                                            <td class="text-right">'.number_format($value->amount,0,",",".").'</td>
                                                            <td class="text-right">'.number_format($value->total,0,",",".").'</td>
                                                        </tr>';
                                                    }
                                                echo '
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="pull-right m-t-5 text-right">
                                            <p>Sub Total: '.number_format($datainvoice->result[0]->Total_sub,0,",",".").'</p>
                                            <p>Tax '.$datainvoice->result[0]->Custom_field->Tax_rate.'% : '.number_format($datainvoice->result[0]->Custom_field->Tax_total,0,",",".").'</p>
                                            <hr>
                                            <h3><b>Total :</b> Rp. '.number_format($datainvoice->result[0]->Total,0,",",".").'</h3>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="text-left">
                                            <b>'.Core::lang('invoice_amount_in_word').':</b> <i>'.ucwords(terbilang($datainvoice->result[0]->Total)).' Rupiah</i>.
                                        </div>
                                        <hr>
                                        <div class="text-right">
                                            <span class="text-left pull-left">'.Core::lang('invoice_recipient_signature').'<br><br><br>'.Core::lang('invoice_recipient_signature_info').'</span>
                                            <span>'.Core::lang('invoice_authorized_signature').'<br><br><br>'.strtoupper($datainvoice->result[0]->Signature).'<br>
                                            </span>
                                        </div>
                                    </div>
                                </div>                            
                                <!-- Sheet 1 end -->
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
                            <h3 class="text-themecolor m-b-0 m-t-0">'.Core::lang('print_preview').' '.Core::lang('invoice').' <button id="print2" class="btn btn-themecolor pull-right" type="button"> <span><i class="fa fa-print"></i> '.Core::lang('print').'</span> </button></h3>
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
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/jsbarcode/JsBarcode.all.min.js"></script>
    <!-- QR Barcode -->
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/jsqrcode/qrcode.min.js"></script>
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
        JsBarcode("#barcode", "<?php echo $codeid?>", {
            format: "code39",
            lineColor: "#000000",
            width: 1,
            height: 20,
            text: "Waybill: <?php echo $codeid?>",
            textMargin: 1,
            textAlign: "right",
            fontSize: 7,
            displayValue: true
        });
        var qrcode = new QRCode(document.getElementById("qrcodeid"), {
            text: "<?php echo $codeid?>",
            width: 50,
            height: 50,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>

</body>

</html>
