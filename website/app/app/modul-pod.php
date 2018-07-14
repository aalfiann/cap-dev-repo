<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$group = Core::getUserGroup();
if( $group > '2' && ($group != '6' && $group != '7') ) {Core::goToPage('modul-user-profile.php');exit;}
$codeid = (empty($_GET['no'])?'':$_GET['no']);
$fd = (empty($_GET['fd'])?'':$_GET['fd']);
$ld = (empty($_GET['ld'])?'':$_GET['ld']);
$s = (empty($_GET['s'])?'':$_GET['s']);
$refdate = ((!empty($_GET['fd']) && !empty($_GET['ld']))?'?fd='.$fd.'&ld='.$ld.'&s='.$s:'');
$refpage = (empty($_GET['ref'])?Core::lang('pod'):'<a href="'.$_GET['ref'].$refdate.'"><i class="mdi mdi-arrow-left"></i> '.Core::lang('go_back').'</a>');?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('pod')?> - <?php echo Core::getInstance()->title?></title>
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
                        <li class="breadcrumb-item active"><?php echo Core::lang('pod')?></li>
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
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('pod')?></h3>
                                <p class="text-muted"><?php echo Core::lang('help_pod')?></p>
                                <hr>
                                <form class="form-control-line" id="submitdata">
                                    <div class="form-group">
                                        <label><?php echo Core::lang('status')?> :</label>
                                        <div class="radio-list">
                                            <label class="custom-control custom-radio">
                                                <input id="radio1" name="radio1" type="radio" checked="" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Delivered</span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio2" name="radio1" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Failed</span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio3" name="radio1" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Return</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="rcodeid" class="form-group col-md-6">
                                            <label class="form-control-label"><b><?php echo Core::lang('waybill')?></b></label>
                                            <input id="codeid" type="text" class="form-control" maxlength="13" value="<?php echo $codeid?>" required>
                                            <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('help_pod_waybill')?></small></span>
                                        </div>
                                        <div class="form-group col-md-6" hidden>
                                            <label class="form-control-label"><b><?php echo Core::lang('deliveryid')?></b></label>
                                            <input id="deliveryid" type="text" class="form-control" maxlength="20" value="<?php echo $codeid?>" required>
                                            <span class="help-block text-muted"></span>
                                        </div>
                                    </div>
                                    <div id="desc" class="form-group">
                                        <label class="form-control-label"><b><?php echo Core::lang('description')?></b></label>
                                        <textarea id="description" type="text" style="resize: vertical;" rows="5" class="form-control" maxlength="200" required></textarea>
                                        <span class="help-block text-muted"><small><i class="ti-info-alt"></i> <?php echo Core::lang('help_pod_description')?></small></span>
                                    </div>
                                    <div class="row">
                                        <div id="consignee" class="form-group col-md-6">
                                            <label class="form-control-label"><b><?php echo Core::lang('consignee_name')?></b></label>
                                            <input id="consignee_name" type="text" class="form-control" maxlength="50"  style="text-transform: uppercase" required>
                                            <span class="help-block text-muted"></span>
                                        </div>
                                        <div id="relation" class="form-group col-md-6">
                                            <label class="form-control-label"><b><?php echo Core::lang('relation_status')?></b></label>
                                            <select class="custom-select form-control required" id="relation_status" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" required></select>
                                            <span class="help-block text-muted"></span>
                                        </div>
                                    </div>
                                    <div id="return" class="form-group">
                                        <label><b><?php echo Core::lang('reason').' '.Core::lang('return')?></b></label>
                                        <div class="radio-list">
                                            <label class="custom-control custom-radio">
                                                <input id="radio4" name="radio2" type="radio" checked="" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description"><?php echo Core::lang('return_shipper')?></span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio5" name="radio2" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description"><?php echo Core::lang('return_recipient')?></span>
                                            </label>
                                            <label class="custom-control custom-radio">
                                                <input id="radio6" name="radio2" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description"><?php echo Core::lang('return_origin')?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button id="submitbtn" type="button" onclick="sendPOD()" class="btn btn-themecolor"><?php echo Core::lang('submit')?></button>
                                    </div>                                 
                                </form>
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
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        /* Get relation option start */
        function loadRelationOption(){
            $(function(){
                $.ajax({
				    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/relation/data/list/'.$datalogin['username'].'/'.$datalogin['token'])?>")+"?_="+randomText(60),
	    	    	dataType: 'json',
	    	    	type: 'GET',
		    		ifModified: true,
    		        success: function(data,status) {
    			    	if (status === "success") {
					    	if (data.status == "success"){
                                $.each(data.results, function(i, item) {
                                    $("#relation_status").append("<option value=\""+data.results[i].Relation+"\">"+data.results[i].Relation+"</option>");
                                });
    				    	}
    	    			}
	    		    },
                	error: function(x, e) {}
    	    	});
            });
        }
        /* Get relation option end */

        function sendPodSuccess(){
            $(function(){
                var btn = "submitbtn";
                disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/transaction/data/pod/delivered')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        Waybill: $("#codeid").val(),
                        Recipient: $("#consignee_name").val().toUpperCase(),
                        Relation: $("#relation_status").val().toUpperCase(),
                        DeliveryID: $("#deliveryid").val()
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
                            console.log("<?php echo Core::lang('submit').' '.Core::lang('pod').' '.Core::lang('status_success')?>");
                            swal("<?php echo Core::lang('pod').' '.Core::lang('status_success')?>", data.message,"success");
                        } else {
                            console.log("<?php echo Core::lang('submit').' '.Core::lang('pod').' '.Core::lang('status_failed')?>");
                            swal("<?php echo Core::lang('pod').' '.Core::lang('status_failed')?>", data.message,"error");
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });
            });
        }

        function sendPodFailed(){
            $(function(){
                var btn = "submitbtn";
                disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/transaction/data/pod/failed')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        Waybill: $("#codeid").val(),
                        Description: $("#description").val(),
                        DeliveryID: $("#deliveryid").val()
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
                            console.log("<?php echo Core::lang('submit').' '.Core::lang('pod').' '.Core::lang('status_success')?>");
                            swal("<?php echo Core::lang('pod').' '.Core::lang('status_success')?>", data.message,"success");
                        } else {
                            console.log("<?php echo Core::lang('submit').' '.Core::lang('pod').' '.Core::lang('status_failed')?>");
                            swal("<?php echo Core::lang('pod').' '.Core::lang('status_failed')?>", data.message,"error");
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });
            });
        }

        function sendPodReturn(opt='1'){
            $(function(){
                var btn = "submitbtn";
                disableClickButton(btn);
                var urldata = '';
                switch(opt){
                    case '1':
                        urldata = Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/transaction/data/pod/returned/consignor')?>");
                        break;
                    case '2':
                        urldata = Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/transaction/data/pod/returned/consignee')?>");
                        break;
                    default:
                        urldata = Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/transaction/data/pod/returned')?>");
                }
                $.ajax({
                    url: urldata,
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        Waybill: $("#codeid").val(),
                        DeliveryID: $("#deliveryid").val()
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
                            console.log("<?php echo Core::lang('submit').' '.Core::lang('pod').' '.Core::lang('status_success')?>");
                            swal("<?php echo Core::lang('pod').' '.Core::lang('status_success')?>", data.message,"success");
                        } else {
                            console.log("<?php echo Core::lang('submit').' '.Core::lang('pod').' '.Core::lang('status_failed')?>");
                            swal("<?php echo Core::lang('pod').' '.Core::lang('status_failed')?>", data.message,"error");
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });
            });
        }

        function showRecipient(allow=true){
            $(function(){
                if (allow){
                    $("#consignee").show();
                    $("#relation").show();
                    $("#desc").hide();
                    $('#return').hide();
                } else {
                    $("#consignee").hide();
                    $("#relation").hide();
                    if($('#radio3').is(':checked')) {
                        $("#desc").hide();
                        $('#return').show();
                    } else {
                        $("#desc").show();
                        $('#return').hide();
                    }
                }
            });
        }

        function sendPOD(){
            $(function(){
                if (validateCheck()){
                    if($('#radio1').is(':checked')){
                        sendPodSuccess();
                    } else if ($('#radio2').is(':checked')){
                        sendPodFailed();
                    } else if ($('#radio3').is(':checked')){
                        if ($('#radio4').is(':checked')){
                            sendPodReturn('1');
                        } else if ($('#radio5').is(':checked')){
                            sendPodReturn('2');
                        } else if ($('#radio6').is(':checked')){
                            sendPodReturn('3');
                        }
                    }
                    validateClear();
                }
            });
        }

        function validateCheck(){
            var result = true;
            if($('#radio1').is(':checked')){
                if (!$.trim($('#codeid').val()).length){
                    $("#codeid").addClass('form-control-danger');
                    $("#rcodeid").addClass('has-danger');
                    result = false;
                } 
                if (!$.trim($('#consignee_name').val()).length){
                    $("#consignee_name").addClass('form-control-danger');
                    $("#consignee").addClass('has-danger');
                    result = false;
                }
            } else if ($('#radio2').is(':checked')){
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
            } else if ($('#radio3').is(':checked')){
                if (!$.trim($('#codeid').val()).length){
                    $("#codeid").addClass('form-control-danger');
                    $("#rcodeid").addClass('has-danger');
                    result = false;
                }
            }
            return result;
        }

        function validateClear(){
            $(function(){
                console.log('Clear form data...');
                $("#codeid").removeClass('form-control-danger');
                $("#rcodeid").removeClass('has-danger');
                $("#consignee_name").removeClass('form-control-danger');
                $("#consignee").removeClass('has-danger');
                $("#description").removeClass('form-control-danger');
                $("#desc").removeClass('has-danger');
            });
        }
        
        /* event onload */
        $(function(){
            $('#radio1').click(function() {
                if($('#radio1').is(':checked')) {
                    showRecipient();
                }
            });

            $('#radio2').click(function() {
                if($('#radio2').is(':checked')) {
                    showRecipient(false);
                }
            });

            $('#radio3').click(function() {
                if($('#radio3').is(':checked')) {
                    showRecipient(false);
                }
            });

            $(document).on("focusin", "#relation_status", function() {
                $(this).css('height', '200px');  
            });

            $(document).on("focusout", "#relation_status", function() {
                $(this).css('height', '40px'); 
            });

            showRecipient();
            loadRelationOption();
        });
    </script>
</body>

</html>
