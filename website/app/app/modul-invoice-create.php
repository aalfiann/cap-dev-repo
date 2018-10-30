<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$group = Core::getUserGroup();
if( $group > '2' && ($group != '6' && $group != '7') ) {Core::goToPage('modul-user-profile.php');exit;}?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>
    <title><?php echo Core::lang('invoice_create')?> - <?php echo Core::getInstance()->title?></title>
    <!--alerts CSS -->
    <link href="<?php echo Core::getInstance()->assetspath?>/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Date picker plugins css -->
    <link href="<?php echo Core::getInstance()->assetspath?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                    <h3 class="text-themecolor"><?php echo Core::lang('invoice_create')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('data')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('invoice_create')?></li>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="report-msg"></div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                        <form method="post" id="submitinvoice" action="#">
                            <div id="form-from" class="card-body">
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('invoice_from')?>
                                    <span class="pull-right">
                                        <button class="btn btn-secondary" type="button" onclick="clearFrom()"><?php echo Core::lang('clear')?></button>
                                    </span>
                                </h3><hr>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('branchid')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="from_id" class="form-control" placeholder="" maxlength="10" required>
                                    <span class="help-block text-danger"><small id="from_id_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_name')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="from_name" class="form-control" placeholder="" maxlength="50" required>
                                    <span class="help-block text-danger"><small id="from_name_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_name_company')?></b></label>
                                    <input type="text" id="from_name_company" class="form-control" placeholder="" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_address')?> <span class="text-danger">*</span></b></label>
                                    <textarea type="text" id="from_address" rows="2" style="resize: vertical;" class="form-control" placeholder="" maxlength="250" required></textarea>
                                    <span class="help-block text-danger"><small id="from_address_error"></small></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_phone')?> <span class="text-danger">*</span></b></label>
                                            <input type="text" id="from_phone" class="form-control" placeholder="" maxlength="15" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                            <span class="help-block text-danger"><small id="from_phone_error"></small></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_fax')?></b></label>
                                            <input type="text" id="from_fax" class="form-control" placeholder="" maxlength="15" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_email')?></b></label>
                                            <input type="text" id="from_email" class="form-control" placeholder="" maxlength="50">
                                            <span class="help-block text-danger"><small id="from_email_error"></small></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_website')?></b></label>
                                            <input type="text" id="from_website" class="form-control" placeholder="" maxlength="50">
                                            <span class="help-block text-danger"><small id="from_website_error"></small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div id="form-to" class="card-body">
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('invoice_to')?>
                                    <span class="pull-right">
                                        <button class="btn btn-themecolor" type="button" data-toggle="modal" data-target=".browse"><i class="mdi mdi-magnify"></i> <?php echo Core::lang('browse')?></button>
                                        <button class="btn btn-secondary" type="button" onclick="clearTo()"><?php echo Core::lang('clear')?></button>
                                    </span>
                                </h3><hr>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('customer_id')?></b></label>
                                    <input type="text" id="to_id" class="form-control" placeholder="" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_name')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="to_name" class="form-control" placeholder="" maxlength="50" required>
                                    <span class="help-block text-danger"><small id="to_name_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_name_company')?></b></label>
                                    <input type="text" id="to_name_company" class="form-control" placeholder="" maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_address')?> <span class="text-danger">*</span></b></label>
                                    <textarea type="text" id="to_address" rows="2" style="resize: vertical;" class="form-control" placeholder="" maxlength="250" required></textarea>
                                    <span class="help-block text-danger"><small id="to_address_error"></small></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_phone')?> <span class="text-danger">*</span></b></label>
                                            <input type="text" id="to_phone" class="form-control" placeholder="" maxlength="15" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                            <span class="help-block text-danger"><small id="to_phone_error"></small></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_fax')?></b></label>
                                            <input type="text" id="to_fax" class="form-control" placeholder="" maxlength="15" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_email')?></b></label>
                                            <input type="text" id="to_email" class="form-control" placeholder="" maxlength="50">
                                            <span class="help-block text-danger"><small id="to_email_error"></small></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_website')?></b></label>
                                            <input type="text" id="to_website" class="form-control" placeholder="" maxlength="50">
                                            <span class="help-block text-danger"><small id="to_website_error"></small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div id="form-bank" class="card-body">
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('invoice_bank')?>
                                    <span class="pull-right">
                                        <button class="btn btn-secondary" type="button" onclick="clearBank()"><?php echo Core::lang('clear')?></button>
                                    </span>
                                </h3><hr>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_bank_name')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="invoice_bank_name" class="form-control" placeholder="" maxlength="50" required>
                                    <span class="help-block text-danger"><small id="invoice_bank_name_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_bank_account_name')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="invoice_bank_account_name" class="form-control" placeholder="" maxlength="50" required>
                                    <span class="help-block text-danger"><small id="invoice_bank_account_name_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_bank_account_no')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="invoice_bank_account_no" class="form-control" placeholder="" maxlength="50" required>
                                    <span class="help-block text-danger"><small id="invoice_bank_account_no_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_bank_address')?></b></label>
                                    <textarea type="text" id="invoice_bank_address" rows="2" style="resize: vertical;" class="form-control" placeholder="" maxlength="250"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('invoice_payment')?></h3><hr>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_tax')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="invoice_tax" class="form-control" placeholder="0.00" maxlength="5" required>
                                    <span class="help-block text-danger"><small id="invoice_tax_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_term')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="invoice_term" class="form-control" placeholder="" maxlength="3" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                    <span class="help-block text-danger"><small id="invoice_term_error"></small></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_signature')?> <span class="text-danger">*</span></b></label>
                                    <input type="text" id="invoice_signature" class="form-control" placeholder="" maxlength="50" required>
                                    <span class="help-block text-danger"><small id="invoice_signature_error"></small></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-themecolor m-b-0 m-t-0">
                                    <span>
                                        <button class="btn btn-themecolor" type="button" data-toggle="modal" data-target=".addnew"><i class="mdi mdi-plus"></i> <?php echo Core::lang('add').' '.Core::lang('data')?></button>
                                    </span>
                                    <span class="pull-right">
                                        <button class="btn btn-secondary" type="button" onclick="clearTable()"><?php echo Core::lang('clear')?></button>
                                    </span>
                                </h3><hr>
                                <div class="form-group">
                                    <div class="table-responsive" style="height:200px;overflow: auto;">
                                        <table id="tableinvoice" class="table">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="10%"><?php echo Core::lang('invoice_date')?></th>
                                                    <th width="10%"><?php echo Core::lang('invoice_po')?></th>
                                                    <th><?php echo Core::lang('invoice_description')?></th>
                                                    <th width="5%"><?php echo Core::lang('invoice_qty')?></th>
                                                    <th width="10%"><?php echo Core::lang('invoice_amount')?></th>
                                                    <th width="10%"><?php echo Core::lang('invoice_total')?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        Total data : <span id="datainvoice">0</span>
                                        <div class="form-group" hidden>
                                            <label class="form-control-label"><b>tablejson</b></label>
                                            <textarea name="tablejson" id="tablejson" rows="6" class="form-control" style="resize: vertical;"></textarea>
                                        </div>
                                        <div class="col-md-3 pull-right">
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('invoice_sub_total')?> <span class="text-danger">*</span></b></label>
                                                <input type="text" id="invoice_sub_total" class="form-control" placeholder="" maxlength="15" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('invoice_tax_total')?> <span class="text-danger">*</span></b></label>
                                                <input type="text" id="invoice_tax_total" class="form-control" placeholder="" maxlength="15" required>
                                            </div>
                                
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('invoice_total')?> <span class="text-danger">*</span></b></label>
                                                <input type="text" id="invoice_total" class="form-control" placeholder="" maxlength="15" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12 text-center">
                                    <button id="submitbtn" type="submit" class="btn btn-themecolor"><?php echo Core::lang('submit').' '.Core::lang('invoice')?></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                    <!-- modal add -->
                    <div class="modal fade addnew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-plus"></i> <?php echo Core::lang('add').' '.Core::lang('data')?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div id="report-modal"></div>
                                    <div class="col-md-12 col-12 align-self-center">
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_date')?> <span class="text-danger">*</span></b></label>
                                            <input type="text" id="invoice_date" class="form-control" placeholder="Format: yyyy-mm-dd" maxlength="50" required>
                                            <span class="help-block text-danger"><small id="invoice_date_error"></small></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_po')?></b></label>
                                            <input type="text" id="invoice_po" class="form-control" placeholder="" maxlength="20">
                                        </div>
                                
                                        <div class="form-group">
                                            <label class="form-control-label"><b><?php echo Core::lang('invoice_description')?> <span class="text-danger">*</span></b></label>
                                            <textarea type="text" id="invoice_description" rows="2" style="resize: vertical;" class="form-control" placeholder="" maxlength="250" required></textarea>
                                            <span class="help-block text-danger"><small id="invoice_description_error"></small></span>
                                        </div>
                                            
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_qty')?> <span class="text-danger">*</span></b></label>
                                                    <input type="text" id="invoice_qty" class="form-control" placeholder="" maxlength="5" required>
                                                    <span class="help-block text-danger"><small id="invoice_qty_error"></small></span>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="form-control-label"><b><?php echo Core::lang('invoice_amount')?> <span class="text-danger">*</span></b></label>
                                                    <input type="text" id="invoice_amount" class="form-control" placeholder="" maxlength="15" required>
                                                    <span class="help-block text-danger"><small id="invoice_amount_error"></small></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-success" onclick="addInvoice()"><?php echo Core::lang('submit')?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                    <!-- modal browse -->
                    <div class="modal fade browse" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-magnify"></i> <?php echo Core::lang('browse').' '.Core::lang('data')?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form class="form-horizontal" id="browsedata" action="#">
                                    <div class="modal-body">
                                        <div id="report-modal"></div>
                                        <div class="col-md-12 col-12 align-self-center">
                                            <div class="input-group">
                                                <input id="searchdt" type="text" class="form-control" placeholder="<?php echo Core::lang('input_search')?>">
                                                <span class="input-group-btn">
                                                    <button id="submitsearchdt" onclick="loadData('#databrowse',document.getElementById('searchdt').value);" class="btn btn-themecolor" type="button"><?php echo Core::lang('search')?></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="table-responsive m-t-40">
                                            <table id="databrowse" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo Core::lang('tb_no')?></th>
                                                        <th>ID</th>
                                                        <th><?php echo Core::lang('name')?></th>
                                                        <th><?php echo Core::lang('name_alias')?></th>
                                                        <th><?php echo Core::lang('address')?></th>
                                                        <th><?php echo Core::lang('phone')?></th>
                                                        <th><?php echo Core::lang('fax')?></th>
                                                        <th><?php echo Core::lang('email')?></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th><?php echo Core::lang('tb_no')?></th>
                                                        <th>ID</th>
                                                        <th><?php echo Core::lang('name')?></th>
                                                        <th><?php echo Core::lang('name_alias')?></th>
                                                        <th><?php echo Core::lang('address')?></th>
                                                        <th><?php echo Core::lang('phone')?></th>
                                                        <th><?php echo Core::lang('fax')?></th>
                                                        <th><?php echo Core::lang('email')?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>    
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    
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
    <?php include_once 'global-datatables.php';?>
    <!-- Sweet-Alert  -->
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Table To Json  -->
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/table-to-json/lib/jquery.tabletojson.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script>
        var count = 1;
        /** 
         * Create event enter key on search (Pure JS)
         * Usage: button id in search element must be set to submitsearchdt
         */
        document.getElementById("searchdt").addEventListener("keypress", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("submitsearchdt").click();
            }
        });

        function loadData(idtable,search=""){
            $(function() {
                /* Make sure there is no datatables with same id */
                if ($.fn.DataTable.isDataTable(idtable)) {
                    $(idtable).DataTable().destroy();
                }
                /* Choose columns index for printing purpose */
                var selectCol = [ 0, 1, 2, 3, 4, 5, 6, 7 ];
                /* Built table is here */
                var table = $(idtable).DataTable({
                    ajax: {
                        type: "GET",
                        url: "<?php echo Core::getInstance()->api.'/enterprise_customer/company/data/search/'.$datalogin['username'].'/'.$datalogin['token'].'/1/1000/?query="+encodeURIComponent(search)+"&_="+randomText(5)+"'?>",
                        cache: true,
                        dataSrc: function (json) {  /* You can handle json response data here */
                            if (json.status == "success"){
                                return json.results;
                            } else {
                                return [];
                            }
                        }
                    },
                    columns: [
                        { "render": function(data,type,row,meta) { /* render event defines the markup of the cell text */
                                var a =  meta.row + meta.settings._iDisplayStart + 1 + ((meta.settings.json.metadata.page_now-1)*meta.settings.json.metadata.items_per_page); /* row object contains the row data */
                                return a;
                            } 
                        },
                        { "render": function(data,type,row,meta) {
                            return '<a href="#" onclick="moveData(\''+row.CompanyID+'\',\''+row.Company_name+'\',\''+row.PIC+'\',\''+row.Address+'\',\''+row.Phone+'\',\''+row.Fax+'\',\''+row.Email+'\');return false;">'+row.CompanyID+'</a>';
                            }
                        },
                        { data: "Company_name" },
                        { data: "Company_name_alias" },
                        { data: "Address" },
                        { data: "Phone" },
                        { data: "Fax" },
                        { data: "Email" }
                    ],
                    bFilter: false,
                    paging: true,
                    info: false,
                    processing: true,
                    language: {
                        lengthMenu: "<?php echo Core::lang('dt_display')?>",
                        zeroRecords: "<?php echo Core::lang('dt_not_found')?>",
                        info: "<?php echo Core::lang('dt_info')?>",
                        infoEmpty: "<?php echo Core::lang('dt_info_empty')?>",
                        infoFiltered: "<?php echo Core::lang('dt_filtered')?>",
                        decimal: "",
                        emptyTable: "<?php echo Core::lang('dt_table_empty')?>",
                        infoPostFix: "",
                        thousands: "<?php echo Core::lang('dt_thousands')?>",
                        loadingRecords: "<?php echo Core::lang('dt_loading')?>",
                        processing: "<?php echo Core::lang('dt_process')?>",
                        search: "<?php echo Core::lang('dt_search')?>"
                    }
                });
                return false;
            });
        }

        function moveData(id,company,pic="",address="",phone="",fax="",email=""){
            $('#to_id').val(id);
            $('#to_name').val(pic);
            $('#to_name_company').val(company);
            $('#to_address').val(address);
            $('#to_phone').val(phone);
            $('#to_fax').val(fax);
            $('#to_email').val(email);
            $('.browse').modal('hide');
        }
    
        function scrollToBottom() {
            $(function() {
                var scrollBottom = Math.max($('#tableinvoice >tbody').height() + 20, 0);
                $('.table-responsive').scrollTop(scrollBottom);
            });
        }

        function addInvoice(){
            $(function() {
                /* Validate */
                var errors = false;
                if (!validationRegex("invoice_date","date",true)){
                    $('#invoice_date_error').html('Format: yyyy-mm-dd');
                    errors = true;
                } else {
                    $('#invoice_date_error').html('');
                }

                if (!validationRegex("invoice_description","required",true)){
                    $('#invoice_description_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#invoice_description_error').html('');
                }

                if (!validationRegex("invoice_qty","numeric",true)){
                    $('#invoice_qty_error').html('<?php echo Core::lang('val_numeric_html')?>');
                    errors = true;
                } else {
                    $('#invoice_qty_error').html('');
                }

                if (!validationRegex("invoice_amount","decimal",true)){
                    $('#invoice_amount_error').html('<?php echo Core::lang('val_decimal_html')?>');
                    errors = true;
                } else {
                    $('#invoice_amount_error').html('');
                }

                if (errors) return false;

                var no = 0;
                var total = 0;
                no = count++;
                total = ($('#invoice_qty').val()*$('#invoice_amount').val());
                $("#tableinvoice").find('tbody').append(
                    $('<tr id="tablerow'+no+'">').append(
                        $('<td>').append('<a href="#" onclick="removeRow(\''+no+'\');return false;"><i class="mdi mdi-close"></i></a>'),
                        $('<td>').append($('#invoice_date').val()),
                        $('<td>').append($('#invoice_po').val()),
                        $('<td>').append($('#invoice_description').val()),
                        $('<td>').append($('#invoice_qty').val()),
                        $('<td>').append($('#invoice_amount').val()),
                        $('<td>').append(total)
                    )
                );
                calculateTotal();
                countRow();
                scrollToBottom();
                convertJSON();
            });
        }

        function calculateTotal(){
            $(function() {
                if (!validationRegex("invoice_tax","decimal",true)){
                    $('#invoice_tax_error').html('<?php echo Core::lang('val_decimal_html')?>');
                } else {
                    $('#invoice_tax_error').html('');
                }

                if ($.trim($('#invoice_tax').val()) == '') $('#invoice_tax').val(0).select();
                if ($.trim($('#invoice_term').val()) == '') $('#invoice_term').val(0).select();
                var subtotal = 0;
                $('#tableinvoice tr').each(function(){
                    var valuetotal = parseFloat($('td', this).eq(6).text());
                    if (!isNaN(valuetotal)){
                        subtotal += valuetotal;
                    }
                });
                var total = 0;
                var taxtotal = 0;
                var tax = parseFloat($('#invoice_tax').val());
                taxtotal = (subtotal * tax)/100;
                total = (subtotal + taxtotal);
                $('#invoice_sub_total').val(subtotal.toFixed(2));
                $('#invoice_tax_total').val(taxtotal.toFixed(2));
                $('#invoice_total').val(total.toFixed(2));
            });
        }

        function countRow(){
            $(function() {
                $('#datainvoice').text($('#tableinvoice >tbody >tr').length);
            });
        }

        function removeRow(id){
            $(function() {
                $("#tablerow"+id).remove();
                calculateTotal();
                countRow();
                scrollToBottom();
                convertJSON();
            });
        }

        function clearTable(){
            $(function(){
                $("#tableinvoice tr").not(function(){ return !!$(this).has('th').length; }).remove();
                $('#tablejson').val('');
                count = 1;
                countRow();
                calculateTotal();
            });
        }

        function clearTo(){
            $(function(){
                $("#form-to")
                    .find("input,textarea")
                    .val("")
                    .end()
            });
        }

        function clearFrom(){
            $(function(){
                $("#form-from")
                    .find("input,textarea")
                    .val("")
                    .end()
            });
        }

        function clearBank(){
            $(function(){
                $("#form-bank")
                    .find("input,textarea")
                    .val("")
                    .end()
            });
        }

        function convertJSON(){
            $(function(){
                var jsons = JSON.stringify($('#tableinvoice').tableToJSON({ignoreColumns:[0]}));
                jsons = jsons.replace(/<?php echo Core::lang('invoice_date')?>/g,'date')
                    .replace(/<?php echo Core::lang('invoice_po')?>/g,'po')
                    .replace(/<?php echo Core::lang('invoice_description')?>/g,'desc')
                    .replace(/<?php echo Core::lang('invoice_qty')?>/g,'qty')
                    .replace(/<?php echo Core::lang('invoice_amount')?>/g,'amount')
                    .replace(/<?php echo Core::lang('invoice_total')?>/g,'total');
                $('#tablejson').val(jsons);
            });
        }

        function defaultValue(){
            $(function(){
                count = 1;
                $('#invoice_tax').val(0);
                $('#invoice_term').val(14);
                $('#invoice_sub_total').val(0);
                $('#invoice_tax_total').val(0);
                $('#invoice_total').val(0);
                clearTable();
            });
        }

        function resetValue(){
            $(function(){
                $('#invoice_tax').val(0);
                $('#invoice_signature').val('');
                clearTable();
                clearTo();
            });
        }

        function throttle(f, delay){
            var timer = null;
            return function(){
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = window.setTimeout(function(){
                        f.apply(context, args);
                    },delay || 500);
            };
        }

        function getDataBranch(){
            $(function(){
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise/user/data/branch/'.$datalogin['username'])?>")+"?_="+randomText(5),
                    dataType: "json",
                    type: "GET",
                    success: function(data) {
                        if (data.status == "success"){
                            $.ajax({
                                url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise/company/data/company/detail/'.$datalogin['username'].'/'.$datalogin['token'].'/')?>")+data.result.BranchID+"?_="+randomText(5),
                                dataType: "json",
                                type: "GET",
                                success: function(data2) {
                                    if (data2.status == "success"){
                                        $('#from_id').val(data.result.BranchID.toUpperCase());
                                        $('#from_name_company').val('<?php echo Core::getInstance()->title?>');
                                        $('#from_address').val(data2.result[0].Address);
                                        $('#from_phone').val(data2.result[0].Phone);
                                        $('#from_fax').val(data2.result[0].Fax);
                                        $('#from_email').val(data2.result[0].Email);
                                        $('#from_website').val('<?php echo $_SERVER['SERVER_NAME']?>');
                                    }
                                },
                                error: function(x, e) {}
                            });
                        }
                    },
                    error: function(x, e) {}
                });
            });
        }
        
        /* onload */
        $(function(){
            defaultValue();
            getDataBranch();

            $(document).on("focusin", "#from_id", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#from_id", function() {
                $(this).prop('readonly', false); 
            });

            $(document).on("focusin", "#invoice_sub_total", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#invoice_sub_total", function() {
                $(this).prop('readonly', false); 
            });

            $(document).on("focusin", "#invoice_tax_total", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#invoice_tax_total", function() {
                $(this).prop('readonly', false); 
            });

            $(document).on("focusin", "#invoice_total", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#invoice_total", function() {
                $(this).prop('readonly', false); 
            });

            $('#invoice_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: false,
                todayHighlight: true
            });

            $('#invoice_tax').keyup(throttle(function(){
                calculateTotal();
            },1000));

            $("#submitinvoice").on("submit",submitInvoice);
            function submitInvoice(e){
                e.preventDefault();
                var that = $(this);
                that.off("submit"); /* remove handler */

                /* Validate */
                console.log("Validating data...");
                var errors = false;
                /* From */
                if (!validationRegex("from_id","required",true)){
                    $('#from_id_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#from_id_error').html('');
                }

                if (!validationRegex("from_name","required",true)){
                    $('#from_name_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#from_name_error').html('');
                }

                if (!validationRegex("from_address","required",true)){
                    $('#from_address_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#from_address_error').html('');
                }

                if (!validationRegex("from_phone","required",true)){
                    $('#from_phone_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#from_phone_error').html('');
                }
                
                if ($("#from_fax").val().length > 0){
                    if (!validationRegex("from_fax","numeric",true)){
                        $('#from_fax_error').html('<?php echo Core::lang('val_numeric_html')?>');
                        errors = true;
                    } else {
                        $('#from_fax_error').html('');
                    }
                }

                if ($("#from_email").val() && !validationRegex("from_email","email",true)){
                    $('#from_email_error').html('<?php echo Core::lang('val_email_html')?>');
                    errors = true;
                } else {
                    $('#from_email_error').html('');
                }

                if ($("#from_website").val() && !validationRegex("from_website","domain",true)){
                    $('#from_website_error').html('<?php echo Core::lang('val_wrong_format_domain')?>');
                    errors = true;
                } else {
                    $('#from_website_error').html('');
                }

                /* To */
                if (!validationRegex("to_name","required",true)){
                    $('#to_name_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#to_name_error').html('');
                }

                if (!validationRegex("to_address","required",true)){
                    $('#to_address_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#to_address_error').html('');
                }

                if (!validationRegex("to_phone","required",true)){
                    $('#to_phone_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#to_phone_error').html('');
                }
                
                if ($("#to_fax").val() && !validationRegex("to_fax","numeric",true)){
                    $('#to_fax_error').html('<?php echo Core::lang('val_numeric_html')?>');
                    errors = true;
                } else {
                    $('#to_fax_error').html('');
                }

                if ($("#to_email").val() && !validationRegex("to_email","email",true)){
                    $('#to_email_error').html('<?php echo Core::lang('val_email_html')?>');
                    errors = true;
                } else {
                    $('#to_email_error').html('');
                }

                if ($("#to_website").val() && !validationRegex("to_website","domain",true)){
                    $('#to_website_error').html('<?php echo Core::lang('val_wrong_format_domain')?>');
                    errors = true;
                } else {
                    $('#to_website_error').html('');
                }

                /* Bank */
                if (!validationRegex("invoice_bank_name","required",true)){
                    $('#invoice_bank_name_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#invoice_bank_name_error').html('');
                }

                if (!validationRegex("invoice_bank_account_name","required",true)){
                    $('#invoice_bank_account_name_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#invoice_bank_account_name_error').html('');
                }

                if (!validationRegex("invoice_bank_account_no","required",true)){
                    $('#invoice_bank_account_no_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#invoice_bank_account_no_error').html('');
                }

                /* Payment */
                if (!validationRegex("invoice_term","numeric",true)){
                    $('#invoice_term_error').html('<?php echo Core::lang('val_numeric_html')?>');
                    errors = true;
                } else {
                    $('#invoice_term_error').html('');
                }

                if (!validationRegex("invoice_signature","required",true)){
                    $('#invoice_signature_error').html('<?php echo Core::lang('input_required')?>');
                    errors = true;
                } else {
                    $('#invoice_signature_error').html('');
                }

                if ($('#tableinvoice >tbody >tr').length == 0){
                    swal({
                        title: "<?php echo Core::lang('submit').' '.Core::lang('invoice').' '.Core::lang('status_failed')?>",
                        text: "<?php echo Core::lang('invoice_val_row_empty')?>",
                        type: "error"
                    });
                    errors = true;
                }

                if(errors) {
                    that.on("submit", submitInvoice); /* add handler back after ajax */
                    console.log("Invalid parameter...");
                    return false;
                }

                console.log("Process sending data invoice...");
                var div = document.getElementById("report-msg");
                var btn = "submitbtn";
                disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/invoice/data/new')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        From_name: $("#from_name").val(),
                        From_name_company: $("#from_name_company").val(),
                        From_address: $("#from_address").val(),
                        From_phone: $("#from_phone").val(),
                        From_fax: $("#from_fax").val(),
                        From_email: $("#from_email").val(),
                        From_website: $("#from_website").val(),
                        To_name: $("#to_name").val(),
                        To_name_company: $("#to_name_company").val(),
                        To_address: $("#to_address").val(),
                        To_phone: $("#to_phone").val(),
                        To_fax: $("#to_fax").val(),
                        To_email: $("#to_email").val(),
                        To_website: $("#to_website").val(),
                        Custom_id: '{"BranchID":"'+$("#from_id").val()+'","CustomerID":"'+$('#to_id').val()+'"}',
                        Custom_field: '{"Tax_rate":"'+$('#invoice_tax').val()+'","Tax_total":"'+$('#invoice_tax_total').val()+'","Bank_name":"'+$('#invoice_bank_name').val()+'","Bank_account_name":"'+$('#invoice_bank_account_name').val()+'","Bank_account_no":"'+$('#invoice_bank_account_no').val()+'","Bank_address":"'+$('#invoice_bank_address').val()+'"}',
                        Data_table: $("#tablejson").val(),
                        Total_sub: $('#invoice_sub_total').val(),
                        Total: $('#invoice_total').val(),
                        Term: $('#invoice_term').val(),
                        Signature: $('#invoice_signature').val(),
                        Prefix: $("#from_id").val(),
                        Sequence: "true",
                        Countzero: "4"
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        div.innerHTML = "";
                        if (data.status == "success"){
                            div.innerHTML = messageHtml("success","<?php echo Core::lang('core_process_add').' '.Core::lang('invoice').' '.Core::lang('status_success')?>","No Invoice: "+data.invoiceid);
                            swal({
                                title: "<?php echo Core::lang('submit').' '.Core::lang('invoice').' '.Core::lang('status_success')?>",
                                text: "No Invoice: "+data.invoiceid,
                                type: "success"
                            });
                            /* clear form */
                            resetValue();
                            console.log("<?php echo Core::lang('core_process_add').' '.Core::lang('invoice').' '.Core::lang('status_success')?>");
                            that.on("submit", submitInvoice); /* add handler back after ajax */
                        } else {
                            div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_add').' '.Core::lang('invoice').' '.Core::lang('status_failed')?>",data.message);
                            swal({
                                title: "<?php echo Core::lang('submit').' '.Core::lang('invoice').' '.Core::lang('status_failed')?>",
                                text: data.message,
                                type: "error"
                            });
                            that.on("submit", submitInvoice); /* add handler back after ajax */
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {
                        var obj = JSON.parse(x.responseText);
                        div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_add').' '.Core::lang('invoice').' '.Core::lang('status_failed')?>",obj.message);
                        swal({
                            title: "<?php echo Core::lang('submit').' '.Core::lang('invoice').' '.Core::lang('status_failed')?>",
                            text: obj.message,
                            type: "error"
                        });
                        that.on("submit", submitInvoice); /* add handler back after ajax */
                    }
                });
            }
        });
    </script>
</body>

</html>
