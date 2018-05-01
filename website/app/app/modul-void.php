<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$codeid = (empty($_GET['no'])?'':$_GET['no']);
$refpage = (empty($_GET['ref'])?Core::lang('void'):'<a href="'.$_GET['ref'].'"><i class="mdi mdi-arrow-left"></i> '.Core::lang('go_back').'</a>');?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('void')?> - <?php echo Core::getInstance()->title?></title>
    <!--alerts CSS -->
    <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('data')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('void')?></li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('void').' '.Core::lang('data')?></h3>
                                <p class="text-muted"><?php echo Core::lang('help_void')?></p>
                                <hr>
                                <form class="form-control-line" id="submitdata">
                                    <div id="rcodeid" class="form-group">
                                        <label class="form-control-label"><b><?php echo Core::lang('waybill')?></b></label>
                                        <input id="codeid" type="text" class="form-control" maxlength="13" value="<?php echo $codeid?>" required>
                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('help_void_waybill')?></small></span>
                                    </div>
                                    <div id="desc" class="form-group">
                                        <label class="form-control-label"><b><?php echo Core::lang('reason').' '.Core::lang('void')?></b></label>
                                        <textarea id="description" type="text" style="resize: vertical;" rows="5" class="form-control" maxlength="200" required></textarea>
                                        <span class="help-block text-muted"></span>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="button" onclick="sendVoid()" class="btn btn-themecolor"><?php echo Core::lang('submit')?></button>
                                    </div>                                        
                                </form>
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
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        function sendVoid(){
            $(function(){
                if (validateCheck()) {
                    $.ajax({
                        url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/transaction/data/void')?>"),
                        data : {
                            Username: "<?php echo $datalogin['username']?>",
                            Token: "<?php echo $datalogin['token']?>",
                            Waybill: $("#codeid").val(),
                            Description: $("#description").val()
                        },
                        dataType: "json",
                        type: "POST",
                        success: function(data) {
                            if (data.status == "success"){
                                /* clear from */
                                $("#submitdata")
                                .find("input,textarea")
                                .val("")
                                .end()
                                console.log("<?php echo Core::lang('submit').' '.Core::lang('void').' '.Core::lang('status_success')?>");
                                swal("<?php echo Core::lang('void').' '.Core::lang('status_success')?>", data.message,"success");
                            } else {
                                console.log("<?php echo Core::lang('submit').' '.Core::lang('void').' '.Core::lang('status_failed')?>");
                                swal("<?php echo Core::lang('void').' '.Core::lang('status_failed')?>", data.message,"error");
                            }
                        },
                        error: function(x, e) {}
                    });
                    validateClear();
                }
            });
        }

        function validateCheck(){
            var result = true;
            if (!$.trim($('#codeid').val()).length){
                $("#codeid").addClass('form-control-danger');
                $("#rcodeid").addClass('has-danger');
                result = false;
            }
            if (!$.trim($('#description').val()).length){
                $("#description").addClass('form-control-danger');
                $("#desc").addClass('has-danger');
                result = false;
            }
            return result;
        }

        function validateClear(){
            $(function(){
                console.log('Clear form data...');
                $("#codeid").removeClass('form-control-danger');
                $("#rcodeid").removeClass('has-danger');
                $("#description").removeClass('form-control-danger');
                $("#desc").removeClass('has-danger');
            });
        }
    </script>
</body>

</html>
