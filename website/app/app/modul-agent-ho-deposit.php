<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
if(Core::getUserGroup() != '1') {Core::goToPage('modul-user-profile.php');exit;}
$fd = (empty($_GET['fd'])?'':$_GET['fd']);
$ld = (empty($_GET['ld'])?'':$_GET['ld']);
$s = (empty($_GET['s'])?'':$_GET['s']);?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('deposit_ho')?> - <?php echo Core::getInstance()->title?></title>
    <!-- Date picker plugins css -->
    <link href="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                    <h3 class="text-themecolor"><?php echo Core::lang('deposit_ho')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('extension')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('deposit_ho')?></li>
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
                <!-- Search Box -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="firstdate" class="hidden-md-up"><?php echo Core::lang('firstdate')?> :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="firstdate" placeholder="<?php echo Core::lang('firstdate')?>. Format: yyyy-mm-dd" value="<?php echo $fd?>">
                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 hidden-md-up"><br></div>

                            <div class="col-md-3">
                                <label for="lastdate" class="hidden-md-up"><?php echo Core::lang('lastdate')?> :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="lastdate" placeholder="<?php echo Core::lang('lastdate')?>. Format: yyyy-mm-dd" value="<?php echo $ld?>">
                                    <span class="input-group-addon"><i class="icon-calender"></i></span>
                                </div>
                            </div>

                            <div class="col-md-6 hidden-md-up"><br></div>
                            
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="searchdt" type="text" class="form-control" placeholder="<?php echo Core::lang('input_search')?>" value="<?php echo $s?>">
                                    <span class="input-group-btn">
                                        <button id="submitsearchdt" onclick="loadData('#datamain','1',selectedOption(),document.getElementById('firstdate').value,document.getElementById('lastdate').value,document.getElementById('searchdt').value);" class="btn btn-themecolor" type="button"><?php echo Core::lang('search')?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div id="reportmsg"></div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('deposit_mutation_data')?></h3><hr>
                                <h6 class="card-subtitle"><?php echo Core::lang('deposit_description')?></h6>
                                <div class="table-responsive m-t-40">
                                    <button type="button" class="btn btn-inverse" data-toggle="modal" data-target=".addnew"><i class="mdi mdi-credit-card-plus"></i> <?php echo Core::lang('deposit_transaction_create')?></button>
                                    <!-- terms modal content -->
                                    <div class="modal fade addnew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-credit-card-plus"></i> <?php echo Core::lang('deposit_transaction_create')?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <form class="form-horizontal form-control-line" id="addnewdata" action="#">
                                                    <div class="modal-body">
                                                        <div id="report-newdata"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 text-center">
                                                                <div class="radio-list">
                                                                    <label class="custom-control custom-radio">
                                                                        <input id="radio1" name="radio" type="radio" checked="" class="custom-control-input">
                                                                        <span class="custom-control-indicator"></span>
                                                                        <span class="custom-control-description"><?php echo Core::lang('deposit_debit')?></span>
                                                                    </label>
                                                                    <label class="custom-control custom-radio">
                                                                        <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                                                        <span class="custom-control-indicator"></span>
                                                                        <span class="custom-control-description"><?php echo Core::lang('deposit_credit')?></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="has_deposit_id" class="form-group">
                                                            <label class="col-md-12 form-control-label"><?php echo Core::lang('deposit_id')?></label>
                                                             <div class="col-md-12">
                                                                <input id="deposit_id" type="text" class="form-control form-control-danger" required>
                                                                <div id="feed_deposit_id" class="form-control-feedback"></div>
                                                                <span class="help-block text-muted"><small><?php echo Core::lang('deposit_help_id')?></small></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12"><?php echo Core::lang('deposit_refid')?></label>
                                                             <div class="col-md-12">
                                                                <input id="deposit_refid" type="text" class="form-control form-control-line">
                                                                <span class="help-block text-muted"><small><?php echo Core::lang('deposit_help_refid')?></small></span>
                                                            </div>
                                                        </div>
                                                        <div id="has_deposit_desc" class="form-group">
                                                            <label class="col-md-12"><?php echo Core::lang('deposit_desc')?></label>
                                                             <div class="col-md-12">
                                                                <textarea id="deposit_desc" rows="3" class="form-control form-control-danger required" style="resize: vertical;"></textarea>
                                                                <div id="feed_deposit_desc" class="form-control-feedback"></div>
                                                                <span class="help-block text-muted"><small><?php echo Core::lang('deposit_help_desc')?></small></span>
                                                            </div>
                                                        </div>
                                                        <div id="has_deposit_mutation" class="form-group">
                                                            <label class="col-md-12"><?php echo Core::lang('deposit_mutation')?></label>
                                                             <div class="col-md-12">
                                                                <input id="deposit_mutation" type="text" class="form-control form-control-danger"  style="text-align: right;"  oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                                <div id="feed_deposit_mutation" class="form-control-feedback"></div>
                                                                <span class="help-block text-muted"><small><?php echo Core::lang('deposit_help_mutation')?></small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>
                                                        <button type="button" class="btn btn-success" onclick="makeTransaction()"><?php echo Core::lang('submit')?></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    <table id="datamain" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?php echo Core::lang('tb_no')?></th>
                                                <th><?php echo Core::lang('deposit_id')?></th>
                                                <th><?php echo Core::lang('deposit_date')?></th>
                                                <th><?php echo Core::lang('deposit_refid')?></th>
                                                <th><?php echo Core::lang('deposit_desc')?></th>
                                                <th><?php echo Core::lang('deposit_task')?></th>
                                                <th><?php echo Core::lang('deposit_before')?></th>
                                                <th><?php echo Core::lang('deposit_mutation')?></th>
                                                <th><?php echo Core::lang('deposit_balance')?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th><?php echo Core::lang('tb_no')?></th>
                                                <th><?php echo Core::lang('deposit_id')?></th>
                                                <th><?php echo Core::lang('deposit_date')?></th>
                                                <th><?php echo Core::lang('deposit_refid')?></th>
                                                <th><?php echo Core::lang('deposit_desc')?></th>
                                                <th><?php echo Core::lang('deposit_task')?></th>
                                                <th><?php echo Core::lang('deposit_before')?></th>
                                                <th><?php echo Core::lang('deposit_mutation')?></th>
                                                <th><?php echo Core::lang('deposit_balance')?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <hr>
                                <div id="pagination"></div>
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
    <?php include_once 'global-datatables.php';?>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script>$(function(){$('head').append('<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">')});</script>
    <script>
        function generateReferenceID(){
            $(function(){
                $.ajax({
                    type: "GET",
                    url: "<?php echo Core::getInstance()->api.'/deposit/generate/referenceid/'.$datalogin['username'].'/'.$datalogin['token']?>",
                    dataType: "json",
                    cache: false,
                    success: function (data, textstatus) {
                        if (data.status == "success"){
                            $('#deposit_refid').val(data.ReferenceID);
                        } else {
                            writeMessage("#reportmsg","danger",data.message);
                            $('#deposit_refid').val('');
                        }
                    },
                    error: function (data, textstatus) {
                        writeMessage("#reportmsg","danger",data.message);
                        $('#deposit_refid').val('');
                    }
                });
            });
        }

        function makeTransaction(){
            $(function(){
                if (!validationRegex("deposit_id","required",true)){
                    $('#has_deposit_id').addClass('has-danger');
                    $('#feed_deposit_id').html('<i class="ti-info-alt"></i> <?php echo Core::lang('input_required')?>');
                    $('#deposit_id').select();
                    return false;
                } else if (!validationRegex("deposit_desc","required",true)){
                    $('#has_deposit_desc').addClass('has-danger');
                    $('#feed_deposit_desc').html('<i class="ti-info-alt"></i> <?php echo Core::lang('input_required')?>');
                    $('#deposit_desc').select();
                    return false;
                } else if ($('#deposit_mutation').val() <= 0){
                    $('#has_deposit_mutation').addClass('has-danger');
                    $('#feed_deposit_mutation').html('<i class="ti-info-alt"></i> <?php echo Core::lang('input_required_not_zero')?>');
                    $('#deposit_mutation').select();
                    return false;
                } else {
                    $('[id^=has_deposit_]').removeClass('has-danger');
                    $('[id^=feed_deposit_]').html('');
                }
                
                var radioTask = '';
                if($('#radio1').is(':checked')) {
                    radioTask = 'DB';
                } else {
                    radioTask = 'CR';
                }

                swal({   
                    title: "<?php echo Core::lang('are_u_sure')?>",   
                    text: "<?php echo Core::lang('deposit_transaction_do')?> "+((radioTask == 'DB')?'<?php echo Core::lang('deposit_debit')?>':'<?php echo Core::lang('deposit_credit')?>')+", \n<?php echo Core::lang('deposit_transaction_confirm')?>",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "<?php echo Core::lang('deposit_transaction_submit_yes')?>",   
                    closeOnConfirm: false 
                }, function(){    
                    $.ajax({
                        type: "POST",
                        url: "<?php echo Core::getInstance()->api.'/deposit/transaction/new'?>",
                        dataType: "json",
                        data: {
                            Username: "<?php echo $datalogin['username']?>",
                            Token: "<?php echo $datalogin['token']?>",
                            DepositID: $('#deposit_id').val(),
                            ReferenceID: $('#deposit_refid').val(),
                            Task: radioTask,
                            Mutation: $('#deposit_mutation').val(),
                            Description: $('#deposit_desc').val()
                        },
                        success: function (data, textstatus) {
                            if (data.status == "success"){
                                /* clear form */
                                $("#addnewdata")
                                .find("input,textarea")
                                .val("")
                                .end();
                                writeMessage("#reportmsg","success",data.message);
                                swal("<?php echo Core::lang('deposit_transaction_success')?>", "", "success");
                                $('#datamain').DataTable().ajax.reload();
                                generateReferenceID();
                            } else {
                                writeMessage("#reportmsg","danger",data.message);
                                swal("<?php echo Core::lang('deposit_transaction_failed')?>", data.message, "error");
                            }
                        },
                        error: function (data, textstatus) {
                            writeMessage("#reportmsg","danger",data.message);
                            swal("<?php echo Core::lang('deposit_transaction_failed')?>", data.message, "error");
                        }
                    });
                });
            });
        }

        /** 
         * Create event enter key on search (Pure JS)
         * Usage: button id in search element must be set to submitsearchdt
         */
        document.getElementById("searchdt").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("submitsearchdt").click();
            }
        });

        /** 
         * Create event select change index on select option (Pure JS)
         * Usage: textbox id in search element must be set to searchdt
         */
        function changeOption(idtable) {
            var selectBox = document.getElementById("selectoptdt");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            loadData(idtable,'1',selectedValue,document.getElementById('searchdt').value);
        }

        /** 
         * Get selected option value for search (Pure JS)
         * Usage: don't do anything, this is depends on paginateDatatables function
         */
        function selectedOption(){
            var selection = document.getElementById("selectoptdt") !== null;
            if (selection){
                var selectBox = document.getElementById("selectoptdt");
                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                return selectedValue;
            } else {
                return "10";
            }
        }
        
        /** 
         * Custom paginate data from datatables (Pure JS)
         *
         * @param selector is ID element to write html pagination
         * @param idtable is ID element of your datatables
         * @param itemperpage is how many item data will shows per pages
         * @param pagenow is current active page
         * @param pagetotal is how many total page in your records
         *
         * Why use custom paginate datatables:
         * - Mostly company has pagination system on their api json or response data which is they use custom json format
         *
         * Usage:
         * - Because this is called from function loadData(idtable,page="1",itemperpage="10",search=""), so you have to take a look how loadData function works before modifying this
         * - Language inside is using Core::lang PHP class
         */
        function paginateDatatables(selector,idtable,itemperpage,pagenow,pagetotal){
            var div = document.getElementById(selector);
            var data = '<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">\
                    <div class="btn-group mr-2" role="group" aria-label="First group"><p><?php echo Core::lang('dt_shows_page')?> '+pagenow+' <?php echo Core::lang('dt_of')?> '+pagetotal+'</p></div>\
                    <div class="btn-group mr-2" role="group" aria-label="Second group">';
                data += '<select id="selectoptdt" onchange="changeOption(\''+idtable+'\');" class="form-control custom-select mr-3">\
                        <option value="10"'+((itemperpage == '10')?' selected':'')+'>10</option>\
                        <option value="50"'+((itemperpage == '50')?' selected':'')+'>50</option>\
                        <option value="100"'+((itemperpage == '100')?' selected':'')+'>100</option>\
                        <option value="250"'+((itemperpage == '250')?' selected':'')+'>250</option>\
                        <option value="500"'+((itemperpage == '500')?' selected':'')+'>500</option>\
                        <option value="1000"'+((itemperpage == '1000')?' selected':'')+'>1000</option>\
                    </select>';
            if (pagenow <= pagetotal){
                    /* Middle Pagination = If this page + 2 < total page */
                    if ((pagenow + 2) < pagetotal && pagenow >= 3){
                        data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\');" type="button" class="btn btn-secondary hidden-sm-down mr-2"><i class="mdi mdi-skip-backward"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        for (p=(pagenow-2);p<=(pagenow+2);p++){
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                    /* Last Pagination = total page >= 5 and if this page + 2 >= total page */
                    else if ((pagenow + 2) >= pagetotal && pagetotal >= 5){
                        if ((pagenow-1)>0){
                            data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=(pagetotal-4);p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        if (pagenow<pagetotal){
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                        }
                    }
                    /* Last Pagination = total page < 5 and if this page + 2 >= total page */
                    else if ((pagenow + 2) >= pagetotal && pagetotal < 5){
                        if ((pagenow-1)>0){
                            data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=(pagetotal-(pagetotal-1));p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        if (pagenow<pagetotal){
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                        }
                    }
                    /* First pagination and if total page <= 5 */
                    else if (pagetotal <= 5) {
                        if ((pagenow-1)>0){
                            if ((pagenow-1)>1) data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=1;p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                    /* First pagination and if total page > 5 */
                    else if (pagetotal > 5 && pagenow <=2) {
                        if ((pagenow-1)>0){
                            if ((pagenow-1)>1) data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=1;p<=5;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                }
            data += '</div></div>';
            div.innerHTML = data;
        }
        
        /** 
         * Load data to datatables (jQuery)
         * 
         * @param idtable is ID element of your datatables
         * @param page is the number to be use to call data url api. (only required to handle custom pagination)
         * @param itemperpage is the number to be use to call data url api. (only required to handle custom pagination)
         * @param search is the query to search data to be use to call data url api. (only required to handle custom pagination)
         *
         * Usage: Want to learn, Go to >> https://datatables.net/examples/ 
         */
        function loadData(idtable,page="1",itemperpage="10",firstdate="",lastdate="",search=""){
            $(function() {
                /* Make sure there is no datatables with same id */
                if ($.fn.DataTable.isDataTable(idtable)) {
                    $(idtable).DataTable().destroy();
                }
                /* Choose columns index for printing purpose */
                var selectCol = [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ];
                /* Built table is here */
                var table = $(idtable).DataTable({
                    ajax: {
                        type: "GET",
                        url: "<?php echo Core::getInstance()->api.'/deposit/transaction/admin/data/mutation/'.$datalogin['username'].'/'.$datalogin['token'].'/"+page+"/"+itemperpage+"/?firstdate="+firstdate+"&lastdate="+lastdate+"&query="+encodeURIComponent(search)+"'?>",
                        cache: false,
                        dataSrc: function (json) {  /* You can handle json response data here */
                            if (json.status == "success"){
                                paginateDatatables("pagination",idtable,json.metadata.items_per_page,json.metadata.page_now,json.metadata.page_total); /* Remove or comment this line if you don't want to use custom pagination */
                                return json.results;
                            } else {
                                document.getElementById("pagination").innerHTML = ""; /* Remove or comment this line if you don't want to use custom pagination */
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
                        { data: "DepositID" },
                        { data: "Created_at" },
                        { data: "ReferenceID" },
                        { data: "Description" },
                        { data: "Task" },
                        { data: "Before" },
                        { data: "Mutation" },
                        { data: "Balance" }
                    ],
                    bFilter: false,
                    paging:   false,
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
                    },
                    dom: "Bfrtip",
                    stateSave: true,
                    buttons: [
                        {
                            extend: "copy",
                            text: "<i class=\"mdi mdi-content-copy\"></i> Copy",
                            className: "bg-theme",
                            exportOptions: {
                                columns: selectCol
                            }
                        }, {
                            extend: "csv",
                            text: "<i class=\"mdi mdi-file-document\"></i> CSV",
                            className: "bg-theme",
                            exportOptions: {
                                columns: selectCol
                            }
                        }, {
                            extend: "excel",
                            text: "<i class=\"mdi mdi-file-excel\"></i> Excel",
                            className: "bg-theme",
                            exportOptions: {
                                columns: selectCol
                            }
                        }, {
                            extend: "pdf",
                            text: "<i class=\"mdi mdi-file-pdf\"></i> PDF",
                            className: "bg-theme",
                            exportOptions: {
                                columns: selectCol
                            }
                        }, {
                            extend: "print",
                            text: "<i class=\"mdi mdi-printer\"></i> Print",
                            className: "bg-theme",
                            exportOptions: {
                                columns: selectCol
                            }
                        }, {
                            extend: 'colvis',
                            text: "Hide/Show Collumn <i class=\"mdi mdi-chevron-down\"></i>",
                            className: "bg-secondary",
                            columns: selectCol
                        }
                    ]
                });
            });
        }

        $(document).on("focusin", "#deposit_refid", function() {
            $(this).prop('readonly', true);  
        });

        $(document).on("focusout", "#deposit_refid", function() {
            $(this).prop('readonly', false); 
        });
        

        $('#firstdate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        $('#lastdate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        /**
         * Get date or convert date to string
         *
         * @param date is the date. If empty will get today's date.
         * 
         * @return string with yyyy-mm-dd format.
         */
        function getDate(date='') {
            if (date == '') date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString();
            var dd  = date.getDate().toString();
            var mmChars = mm.split('');
            var ddChars = dd.split('');
            return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
        }

        generateReferenceID();

        <?php 
            if (empty($fd) && empty($ld)){
                echo '$(function(){
                    $("#firstdate").val(getDate());
                    $("#lastdate").val(getDate());
                });';
                echo '/* Load data from datatables onload */
                loadData("#datamain","1","10",getDate(),getDate());';
            } else {
                echo '/* Load data from datatables onload */
                loadData("#datamain","1","10","'.$fd.'","'.$ld.'","'.$s.'");';
            }
        ?>
    </script>
</body>

</html>
