<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
if(Core::getUserGroup() == '5') {Core::goToPage('modul-user-profile.php');exit;}?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('agent_setting')?> - <?php echo Core::getInstance()->title?></title>
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
                    <h3 class="text-themecolor"><?php echo Core::lang('agent_setting')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('extension')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('agent')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('agent_setting')?></li>
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
                        <div id="reportmsg"></div>
                        <div class="card">
                            <div class="card-body">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down"><i class="ti-home"></i> <?php echo Core::lang('agent_setting_company')?></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab"><span class="hidden-sm-up"><i class="ti-wallet"></i></span> <span class="hidden-xs-down"><i class="ti-wallet"></i> <?php echo Core::lang('agent_setting_bank')?></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab"><span class="hidden-sm-up"><i class="ti-settings"></i></span> <span class="hidden-xs-down"><i class="ti-settings"></i> <?php echo Core::lang('agent_setting_other')?></span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1" role="tabpanel">
                                        <br>
                                        <div class="form-control-line">
                                            
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_logo')?></b></label>
                                                <input id="agent_setting_logo" placeholder="<?php echo Core::lang('agent_placeholder_logo')?>" class="form-control" maxlength="250">
                                                <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_logo')?></small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_name')?> <span class="text-danger">*</span></b></label>
                                                <input id="agent_setting_company_name" type="text" placeholder="" class="form-control" maxlength="100" required>
                                                <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_company_name')?></small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_slogan')?></b></label>
                                                <textarea id="agent_setting_company_slogan" type="text" style="resize: vertical;" rows="3" placeholder="" class="form-control" maxlength="150"></textarea>
                                                <span class="help-block text-muted"><small></small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_address')?> <span class="text-danger">*</span></b></label>
                                                <textarea id="agent_setting_company_address" type="text" style="resize: vertical;" rows="3" placeholder="" class="form-control" maxlength="250" required></textarea>
                                                <span class="help-block text-muted"><small></small></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_phone')?> <span class="text-danger">*</span></b></label>
                                                        <input id="agent_setting_company_phone" type="text" placeholder="" class="form-control" maxlength="15" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                        <span class="help-block text-muted"><small></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_fax')?> </b></label>
                                                        <input id="agent_setting_company_fax" type="text" placeholder="" class="form-control" maxlength="15" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                        <span class="help-block text-muted"><small></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_email')?> </b></label>
                                                        <input id="agent_setting_company_email" type="text" placeholder="" class="form-control" maxlength="50">
                                                        <span class="help-block text-muted"><small></small></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_website')?> </b></label>
                                                        <input id="agent_setting_company_website" type="text" placeholder="" class="form-control" maxlength="50">
                                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_company_website')?></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_coordinat')?> </b></label>
                                                        <input id="agent_setting_company_coordinat" type="text" placeholder="" class="form-control" maxlength="50">
                                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_company_coordinat')?></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_hotline')?> </b></label>
                                                        <input id="agent_setting_company_hotline" type="text" placeholder="" class="form-control" maxlength="15">
                                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_company_hotline')?></small></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_facebook')?> </b></label>
                                                        <input id="agent_setting_company_facebook" type="text" placeholder="<?php echo Core::lang('agent_placeholder_company_facebook')?>" class="form-control" maxlength="100">
                                                        <span class="help-block text-muted"><small></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_twitter')?> </b></label>
                                                        <input id="agent_setting_company_twitter" type="text" placeholder="<?php echo Core::lang('agent_placeholder_company_twitter')?>" class="form-control" maxlength="100">
                                                        <span class="help-block text-muted"><small></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_gplus')?> </b></label>
                                                        <input id="agent_setting_company_gplus" type="text" placeholder="<?php echo Core::lang('agent_placeholder_company_gplus')?>" class="form-control" maxlength="100">
                                                        <span class="help-block text-muted"><small></small></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_owner')?> </b></label>
                                                        <input id="agent_setting_company_owner" type="text" placeholder="" class="form-control" maxlength="100">
                                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_company_owner')?></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_signature_name')?> </b></label>
                                                        <input id="agent_setting_company_signature_name" type="text" placeholder="" class="form-control" maxlength="100">
                                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_company_signature_name')?></small></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label"><b><?php echo Core::lang('agent_setting_company_tin')?> </b></label>
                                                        <input id="agent_setting_company_tin" type="text" placeholder="" class="form-control" maxlength="100">
                                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_company_tin')?></small></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2" role="tabpanel">
                                        <br>
                                        <div class="form-control-line">

                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_bank_name')?></b></label>
                                                <input id="agent_setting_bank_name" placeholder="<?php echo Core::lang('agent_placeholder_bank_name')?>" class="form-control" maxlength="50">
                                                <span class="help-block text-muted"><small></small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_bank_address')?></b></label>
                                                <textarea id="agent_setting_bank_address" type="text" style="resize: vertical;" rows="3" placeholder="" class="form-control" maxlength="150"></textarea>
                                                <span class="help-block text-muted"><small></small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_bank_account_name')?></b></label>
                                                <input id="agent_setting_bank_account_name" type="text" placeholder="" class="form-control" maxlength="100">
                                                <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_bank_account_name')?></small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_bank_account_no')?></b></label>
                                                <input id="agent_setting_bank_account_no" type="text" placeholder="" class="form-control" maxlength="100">
                                                <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_bank_account_no')?></small></span>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3" role="tabpanel">
                                        <br>
                                        <div class="form-control-line">

                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_origin_district')?></b></label>
                                                <input id="agent_setting_origin_district" placeholder="" class="form-control" maxlength="50">
                                                <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_origin_district')?></small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label"><b><?php echo Core::lang('agent_setting_admin_cost')?></b></label>
                                                <input id="agent_setting_admin_cost" placeholder="" class="form-control" maxlength="8" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('agent_helper_admin_cost')?></small></span>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            
                                <hr>
                                <div class="form-group">
                                    <button type="button" onclick="saveConfig()" class="btn btn-themecolor"><?php echo Core::lang('save')?> <?php echo Core::lang('settings')?></button>
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
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script>$(function(){$('head').append('<link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">')});</script>
    <script>
        function saveConfig(){
            $(function(){
                $.ajax({
                    type: "GET",
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargoagent/config/read/agent_config_'.$datalogin['username'].'/'.$datalogin['username'].'/'.$datalogin['token'])?>"),
                    dataType: "json",
                    cache: false,
                    success: function (data, textstatus) {
                        if (data.status == "success"){
                            updateConfig();
                        } else if (data.status == "error") {
                            addConfig();
                        }
                    },
                    error: function (data, textstatus) {
                        writeMessage("#reportmsg","danger",data.message);
                    }
                });
            });
        }

        function addConfig(){
            $(function(){
                if (!validationRegex($('#agent_setting_company_name').val(),"required")){
                    writeMessage("#reportmsg","danger","<?php echo Core::lang('core_update_failed')?>","<?php echo Core::lang('val_asterisk_required')?>");
                    swal("<?php echo Core::lang('core_update_failed')?>", "<?php echo Core::lang('val_asterisk_required')?>","error");
	                return false;
                } else if (!validationRegex($('#agent_setting_company_address').val(),"required")){
                    writeMessage("#reportmsg","danger","<?php echo Core::lang('core_update_failed')?>","<?php echo Core::lang('val_asterisk_required')?>");
                    swal("<?php echo Core::lang('core_update_failed')?>", "<?php echo Core::lang('val_asterisk_required')?>","error");
	                return false;
                } else if (!validationRegex($('#agent_setting_company_phone').val(),"required")){
                    writeMessage("#reportmsg","danger","<?php echo Core::lang('core_update_failed')?>","<?php echo Core::lang('val_asterisk_required')?>");
                    swal("<?php echo Core::lang('core_update_failed')?>", "<?php echo Core::lang('val_asterisk_required')?>","error");
	                return false;
                }

                if (!$.trim($('#agent_setting_logo').val())){} else {
                    if (!validationRegex($('#agent_setting_logo').val(),/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/)){
                        writeMessage("#reportmsg","danger","Logo URL <?php echo Core::lang('val_wrong_format')?>","<?php echo Core::lang('agent_placeholder_logo')?>");
                        swal("<?php echo Core::lang('core_update_failed')?>", "Logo URL <?php echo Core::lang('val_wrong_format').'\n'.Core::lang('agent_placeholder_logo')?>","error");
	                    return false;
                    }
                }

                $.ajax({
                    type: "POST",
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargoagent/config/add')?>"),
                    dataType: "json",
                    data: {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        Key: "agent_config_<?php echo $datalogin['username']?>",
                        Value: '{"logo":"'+$('#agent_setting_logo').val()+'","name":"'+$('#agent_setting_company_name').val()+'","slogan":"'+$('#agent_setting_company_slogan').val()+'","address":"'+$('#agent_setting_company_address').val()+'","phone":"'+$('#agent_setting_company_phone').val()+'","fax":"'+$('#agent_setting_company_fax').val()+'","email":"'+$('#agent_setting_company_email').val()+'","website":"'+$('#agent_setting_company_website').val()+'","coordinat":"'+$('#agent_setting_company_coordinat').val()+'","hotline":"'+$('#agent_setting_company_hotline').val()+'","facebook":"'+$('#agent_setting_company_facebook').val()+'","twitter":"'+$('#agent_setting_company_twitter').val()+'","gplus":"'+$('#agent_setting_company_gplus').val()+'","owner":"'+$('#agent_setting_company_owner').val()+'","signature":"'+$('#agent_setting_company_signature_name').val()+'","legality":"'+$('#agent_setting_company_tin').val()+'","bank_name":"'+$('#agent_setting_bank_name').val()+'","bank_address":"'+$('#agent_setting_bank_address').val()+'","bank_account_name":"'+$('#agent_setting_bank_account_name').val()+'","bank_account_no":"'+$('#agent_setting_bank_account_no').val()+'","origin_district":"'+$('#agent_setting_origin_district').val()+'","admin_cost":"'+$('#agent_setting_admin_cost').val()+'"}',
                        Description: "Agent Configuration"
                    },
                    success: function (data, textstatus) {
                        if (data.status == "success"){
                            writeMessage("#reportmsg","success",data.message);
                            swal("<?php echo Core::lang('core_update_success')?>", data.message,"success");
                        } else {
                            writeMessage("#reportmsg","danger",data.message);
                            swal("<?php echo Core::lang('core_update_failed')?>", data.message,"error");
                        }
                    },
                    error: function (data, textstatus) {
                        writeMessage("#reportmsg","danger",data.message);
                        swal("<?php echo Core::lang('core_update_failed')?>", data.message,"error");
                    }
                });
            });
        }

        function updateConfig(){
            $(function(){
                if (!validationRegex($('#agent_setting_company_name').val(),"required")){
                    writeMessage("#reportmsg","danger","<?php echo Core::lang('core_update_failed')?>","<?php echo Core::lang('val_asterisk_required')?>");
                    swal("<?php echo Core::lang('core_update_failed')?>", "<?php echo Core::lang('val_asterisk_required')?>","error");
	                return false;
                } else if (!validationRegex($('#agent_setting_company_address').val(),"required")){
                    writeMessage("#reportmsg","danger","<?php echo Core::lang('core_update_failed')?>","<?php echo Core::lang('val_asterisk_required')?>");
                    swal("<?php echo Core::lang('core_update_failed')?>", "<?php echo Core::lang('val_asterisk_required')?>","error");
	                return false;
                } else if (!validationRegex($('#agent_setting_company_phone').val(),"required")){
                    writeMessage("#reportmsg","danger","<?php echo Core::lang('core_update_failed')?>","<?php echo Core::lang('val_asterisk_required')?>");
                    swal("<?php echo Core::lang('core_update_failed')?>", "<?php echo Core::lang('val_asterisk_required')?>","error");
	                return false;
                }

                if (!$.trim($('#agent_setting_logo').val())){} else {
                    if (!validationRegex($('#agent_setting_logo').val(),/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/)){
                        writeMessage("#reportmsg","danger","Logo URL <?php echo Core::lang('val_wrong_format')?>","<?php echo Core::lang('agent_placeholder_logo')?>");
                        swal("<?php echo Core::lang('core_update_failed')?>", "Logo URL <?php echo Core::lang('val_wrong_format').'\n'.Core::lang('agent_placeholder_logo')?>","error");
	                    return false;
                    }
                }

                $.ajax({
                    type: "POST",
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargoagent/config/update')?>"),
                    dataType: "json",
                    data: {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        Key: "agent_config_<?php echo $datalogin['username']?>",
                        Value: '{"logo":"'+$('#agent_setting_logo').val()+'","name":"'+$('#agent_setting_company_name').val()+'","slogan":"'+$('#agent_setting_company_slogan').val()+'","address":"'+$('#agent_setting_company_address').val()+'","phone":"'+$('#agent_setting_company_phone').val()+'","fax":"'+$('#agent_setting_company_fax').val()+'","email":"'+$('#agent_setting_company_email').val()+'","website":"'+$('#agent_setting_company_website').val()+'","coordinat":"'+$('#agent_setting_company_coordinat').val()+'","hotline":"'+$('#agent_setting_company_hotline').val()+'","facebook":"'+$('#agent_setting_company_facebook').val()+'","twitter":"'+$('#agent_setting_company_twitter').val()+'","gplus":"'+$('#agent_setting_company_gplus').val()+'","owner":"'+$('#agent_setting_company_owner').val()+'","signature":"'+$('#agent_setting_company_signature_name').val()+'","legality":"'+$('#agent_setting_company_tin').val()+'","bank_name":"'+$('#agent_setting_bank_name').val()+'","bank_address":"'+$('#agent_setting_bank_address').val()+'","bank_account_name":"'+$('#agent_setting_bank_account_name').val()+'","bank_account_no":"'+$('#agent_setting_bank_account_no').val()+'","origin_district":"'+$('#agent_setting_origin_district').val()+'","admin_cost":"'+$('#agent_setting_admin_cost').val()+'"}',
                        Description: "Agent Configuration"
                    },
                    success: function (data, textstatus) {
                        if (data.status == "success"){
                            writeMessage("#reportmsg","success",data.message);
                            swal("<?php echo Core::lang('core_update_success')?>", data.message,"success");
                        } else {
                            writeMessage("#reportmsg","danger",data.message);
                            swal("<?php echo Core::lang('core_update_failed')?>", data.message,"error");
                        }
                    },
                    error: function (data, textstatus) {
                        writeMessage("#reportmsg","danger",data.message);
                        swal("<?php echo Core::lang('core_update_failed')?>", data.message,"error");
                    }
                });
            });
        }

        function readConfig(){
            $(function(){
                $.ajax({
                    type: "GET",
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargoagent/config/read/agent_config_'.$datalogin['username'].'/'.$datalogin['username'].'/'.$datalogin['token'])?>"),
                    dataType: "json",
                    cache: false,
                    success: function (data, textstatus) {
                        if (data.status == "success"){
                            if (!$.trim(data.result[0].Config)) {} else {
                                /* cleanup to get valid JSON chars */
                                s = data.result[0].Config.replace(/\\n/g, "\\n")  
                                    .replace(/\\'/g, "\\'")
                                    .replace(/\\"/g, '\\"')
                                    .replace(/\\&/g, "\\&")
                                    .replace(/\\r/g, "\\r")
                                    .replace(/\\t/g, "\\t")
                                    .replace(/\\b/g, "\\b")
                                    .replace(/\\f/g, "\\f");
                                /* remove non-printable and other non-valid JSON chars */
                                s = s.replace(/[\u0000-\u0019]+/g,""); 
                                var obj = JSON.parse(s);
                                if (!$.trim(obj.logo)) {} else {$("#agent_setting_logo").val(obj.logo)}
                                if (!$.trim(obj.name)) {} else {$("#agent_setting_company_name").val(obj.name)}
                                if (!$.trim(obj.slogan)) {} else {$("#agent_setting_company_slogan").val(obj.slogan)}
                                if (!$.trim(obj.address)) {} else {$("#agent_setting_company_address").val(obj.address)}
                                if (!$.trim(obj.phone)) {} else {$("#agent_setting_company_phone").val(obj.phone)}
                                if (!$.trim(obj.fax)) {} else {$("#agent_setting_company_fax").val(obj.fax)}
                                if (!$.trim(obj.email)) {} else {$("#agent_setting_company_email").val(obj.email)}
                                if (!$.trim(obj.website)) {} else {$("#agent_setting_company_website").val(obj.website)}
                                if (!$.trim(obj.coordinat)) {} else {$("#agent_setting_company_coordinat").val(obj.coordinat)}
                                if (!$.trim(obj.hotline)) {} else {$("#agent_setting_company_hotline").val(obj.hotline)}
                                if (!$.trim(obj.facebook)) {} else {$("#agent_setting_company_facebook").val(obj.facebook)}
                                if (!$.trim(obj.twitter)) {} else {$("#agent_setting_company_twitter").val(obj.twitter)}
                                if (!$.trim(obj.gplus)) {} else {$("#agent_setting_company_gplus").val(obj.gplus)}
                                if (!$.trim(obj.owner)) {} else {$("#agent_setting_company_owner").val(obj.owner)}
                                if (!$.trim(obj.signature)) {} else {$("#agent_setting_company_signature_name").val(obj.signature)}
                                if (!$.trim(obj.tin)) {} else {$("#agent_setting_company_tin").val(obj.tin)}
                                if (!$.trim(obj.bank_name)) {} else {$("#agent_setting_bank_name").val(obj.bank_name)}
                                if (!$.trim(obj.bank_address)) {} else {$("#agent_setting_bank_address").val(obj.bank_address)}
                                if (!$.trim(obj.bank_account_name)) {} else {$("#agent_setting_bank_account_name").val(obj.bank_account_name)}
                                if (!$.trim(obj.bank_account_no)) {} else {$("#agent_setting_bank_account_no").val(obj.bank_account_no)}
                                if (!$.trim(obj.origin_district)) {} else {$("#agent_setting_origin_district").val(obj.origin_district)}
                                if (!$.trim(obj.admin_cost)) {} else {$("#agent_setting_admin_cost").val(obj.admin_cost)}
                            }
                        }
                    },
                    error: function (data, textstatus) {
                        writeMessage("#reportmsg","danger",data.message);
                    }
                });
            });
        }
         readConfig();
    </script>
</body>

</html>
