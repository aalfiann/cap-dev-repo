<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title>Transaction - <?php echo Core::getInstance()->title?></title>
    <!--wizard CSS -->
    <link href="../assets/plugins/wizard/steps.css" rel="stylesheet">
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
                    <h3 class="text-themecolor"><?php echo Core::lang('transaction')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('data')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('transaction')?></li>
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
                <div class="row" >
                    <div class="col-12">
                        <div class="card wizard-content">
                            <div class="card-body">
                                <form action="#" class="validation-wizard wizard-circle">
                                    <!-- Step 1 -->
                                    <h6><?php echo Core::lang('shipper')?></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="custid"> <?php echo Core::lang('customer_id')?> : </label>
                                                    <div class="input-group">
                                                        <input type="text" id="custid" name="custid" class="form-control" placeholder="<?php echo Core::lang('input_browse_customer')?>">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-themecolor" type="button"><?php echo Core::lang('browse')?>!</button>
                                                        </span>
                                                    </div>
                                                    <small id="custidHelp" class="form-text text-muted"><?php echo Core::lang('help_browse_customer')?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shippername"> <?php echo Core::lang('shipper_name')?> : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="shippername" name="shippername">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="aliasname"> <?php echo Core::lang('shipper_alias_name')?> : </label>
                                                    <input type="text" class="form-control" id="aliasname" name="aliasname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="address"> <?php echo Core::lang('shipper_address')?> : <span class="text-danger">*</span> </label>
                                                    <textarea name="address" id="address" rows="6" class="form-control required" style="resize: vertical;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email"> <?php echo Core::lang('email_address')?> : </label>
                                                    <input type="email" class="form-control" name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phone"><?php echo Core::lang('shipper_phone')?> : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" name="phone" id="phone">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fax"><?php echo Core::lang('shipper_fax')?> : </label>
                                                    <input type="text" class="form-control" name="fax" id="fax">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 2 -->
                                    <h6><?php echo Core::lang('consignee')?></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="refid"> <?php echo Core::lang('referensi_id')?> : </label>
                                                    <div class="form-group">
                                                        <input type="text" id="refid" name="refid" class="form-control" placeholder="<?php echo Core::lang('input_referensi_id')?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="consigneename"> <?php echo Core::lang('consignee_name')?> : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="consigneename" name="consigneename">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="attentionname"> Attention Name : </label>
                                                    <input type="text" class="form-control" id="attentionname" name="attentionname">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="consigneeaddress">Consignee Address : <span class="text-danger">*</span> </label>
                                                    <textarea name="consigneeaddress" id="consigneeaddress" rows="6" class="form-control required" style="resize: vertical;"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="consigneephone">Phone Number : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" name="consigneephone" id="consigneephone"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="consigneefax">Fax Number : </label>
                                                    <input type="text" class="form-control" name="consigneefax" id="consigneefax"> </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6><?php echo Core::lang('goods_detail')?></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mode">Mode</label>
                                                    <select class="custom-select form-control required" id="mode" name="mode"></select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="instructions">Instructions :</label>
                                                    <textarea name="instructions" id="instructions" rows="6" class="form-control" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="descriptions">Descriptions : <span class="text-danger">*</span> </label>
                                                    <textarea name="descriptions" id="descriptions" rows="6" class="form-control required" style="resize: vertical;"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mode">Weight of Goods</label>
                                                
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up">Lenght :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="Lenght" name="length" id="length">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">cm</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up">Width :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="Width" name="width" id="width">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">cm</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up">Height :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="Height" name="height" id="height">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">cm</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up">Act. Kg :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="Act. Kg" name="actkg" id="actkg">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">Kg</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <small id="errorvolume" class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-md-12"><br></div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-themecolor w-100" onclick="addVolume()">Add Volume</button>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <div class="table-responsive" style="height:200px;overflow: auto;">
                                                    <table id="tablevolume" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Panjang</th>
                                                                <th>Lebar</th>
                                                                <th>Tinggi</th>
                                                                <th>Actual</th>
                                                                <th>Volume</th>
                                                                <th>Total</th>
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
                                                        <button type="button" class="btn btn-default w-100" onclick="clearTable()">Clear Volume</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"><br></div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="mode">Real Kg :</label>
                                                        <input type="text" class="form-control" placeholder="Real" name="realkg" id="realkg" readonly>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-4">
                                                        <label for="mode">Weight Kg :</label>
                                                        <input type="text" class="form-control" placeholder="Weight" name="weight" id="weight" readonly>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-4">
                                                        <label for="mode">Koli :</label>
                                                        <input type="text" class="form-control" placeholder="Koli" name="koli" id="koli">
                                                    </div>
                                                </div>
                                                <div class="col-md-12"><br></div>     
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 4 -->
                                    <h6><?php echo Core::lang('payment')?></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Behaviour :</label>
                                                    <input type="text" class="form-control required" id="behName1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="participants1">Confidance</label>
                                                    <input type="text" class="form-control required" id="participants1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="participants1">Result</label>
                                                    <select class="custom-select form-control required" id="participants1" name="location">
                                                        <option value="">Select Result</option>
                                                        <option value="Selected">Selected</option>
                                                        <option value="Rejected">Rejected</option>
                                                        <option value="Call Second-time">Call Second-time</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="decisions1">Comments</label>
                                                    <textarea name="decisions" id="decisions1" rows="4" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rate Interviwer :</label>
                                                    <div class="c-inputs-stacked">
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">1 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">2 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">3 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">4 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">5 star</span> </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
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
    <!-- Wizard  -->
    <script src="../assets/plugins/wizard/jquery.steps.min.js"></script>
    <script src="../assets/plugins/wizard/jquery.validate.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        var count = 1;
        /* Get mode option start */
        function loadModeOption(){
            $(function(){
                $.ajax({
				    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/mode/data/list/'.$datalogin['username'].'/'.$datalogin['token'])?>")+"?_="+randomText(60),
	    	    	dataType: 'json',
	    	    	type: 'GET',
		    		ifModified: true,
    		        success: function(data,status) {
    			    	if (status === "success") {
					    	if (data.status == "success"){
                                $.each(data.results, function(i, item) {
                                    $("#mode").append("<option value=\""+data.results[i].ModeID+"\">"+data.results[i].Mode+"</option>");
                                });
    				    	}
    	    			}
	    		    },
                	error: function(x, e) {}
    	    	});
            });
        }
        /* Get mode option end */

        function calculateKgOld(){
            $(function() {
                var totalkg = 0;
                $('#tablevolume tr').each(function(){
                    var valuekg = parseFloat($('td', this).eq(4).text());
                    if (!isNaN(valuekg)){
                        totalkg += valuekg;
                    }
                });
                var totalvol = 0;
                $('#tablevolume tr').each(function(){
                    var valuevol = parseFloat($('td', this).eq(5).text());
                    if (!isNaN(valuevol)){
                        totalvol += valuevol;
                    }
                });

                if (limitRound(totalkg,0.3) >= limitRound(totalvol,0.3)){
                    $('#weight').val(limitRound(totalkg,0.3));
                } else {
                    $('#weight').val(limitRound(totalvol,0.3));
                }
            });
        }

        function calculateKg(){
            $(function() {
                var totalkg = 0;
                var realkg = 0;
                $('#tablevolume tr').each(function(){
                    var valuekg = parseFloat($('td', this).eq(6).text());
                    if (!isNaN(valuekg)){
                        totalkg += valuekg;
                    }
                    var valuerealkg = parseFloat($('td', this).eq(6).text());
                    if (!isNaN(valuerealkg)){
                        realkg += valuerealkg;
                    }
                });
                $('#realkg').val(realkg.toFixed(2));
                $('#weight').val(limitRound(totalkg,0.3));
            });
        }

        function countRow(){
            $(function() {
                $('#koli').val($('#tablevolume >tbody >tr').length);
            });
        }

        function clearTable(){
            $(function(){
                $("#tablevolume tr").not(function(){ return !!$(this).has('th').length; }).remove();
                $('#length').val(0);
                $('#width').val(0);
                $('#height').val(0);
                $('#actkg').val('');
                $('#realkg').val(0);
                $('#weight').val(0);
                $('#koli').val(0);
                count = 1;
            });
        }

        function addVolume(){
            $(function() {
                if (!validationRegex("length","double",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_numeric_html')?>');
                    $('#length').select();
                    return false;
                } else if (!validationRegex("width","double",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_numeric_html')?>');
                    $('#width').select();
                    return false;
                } else if (!validationRegex("height","double",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_numeric_html')?>');
                    $('#height').select();
                    return false;
                } else if (!validationRegex("actkg","double",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_numeric_html')?>');
                    $('#actkg').select();
                    return false;
                } else if ($('#actkg').val() <= 0){
                    $('#errorvolume').html('<?php echo Core::lang('input_required_not_zero')?>');
                    $('#actkg').select();
                    return false;
                } else {
                    $('#errorvolume').html('');
                }
                
                var result = 0;
                var totalkg = 0;
                var ilength = parseFloat($('#length').val());
                var iwidth = parseFloat($('#width').val());
                var iheight = parseFloat($('#height').val());
                var ikg = parseFloat($('#actkg').val());
                var cargovol = 4000;
                var temp    = (ilength * iwidth * iheight) / cargovol;
                if (temp>0 && temp<1){
                    result = 1;
                } else if (temp<0){
                    result = 0;
                } else {
                    result = temp.toFixed(2);
                }

                if (ikg >= result){
                    totalkg = ikg
                } else {
                    totalkg = result
                }

                $("#tablevolume").find('tbody').append(
                    $('<tr>').append(
                        $('<td>').append((count++)),
                        $('<td>').append($('#length').val()),
                        $('<td>').append($('#width').val()),
                        $('<td>').append($('#height').val()),
                        $('<td>').append($('#actkg').val()),
                        $('<td>').append(result),
                        $('<td>').append(totalkg)
                    )
                );
                
                $('#length').val(0);
                $('#width').val(0);
                $('#height').val(0);
                $('#actkg').val('');
                calculateKg();
                countRow();
            });
        }

        loadModeOption();
        
        $(function(){
            var form = $(".validation-wizard").show();

            $(".validation-wizard").steps({
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#', 
                labels: {
                    cancel: '<?php echo Core::lang('cancel')?>',
                    current: '<?php echo Core::lang('step_current')?>',
                    pagination: '<?php echo Core::lang('step_pagination')?>',
                    finish: '<?php echo Core::lang('submit')?>',
                    next: '<?php echo Core::lang('step_next')?>',
                    previous: '<?php echo Core::lang('step_previous')?>',
                    loading: '<?php echo Core::lang('step_loading')?>'
                },
                onStepChanging: function (event, currentIndex, newIndex) {
                    return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
                },
                onFinishing: function (event, currentIndex) { 
                    return form.validate().settings.ignore = ":disabled", form.valid()
                },
                onFinished: function (event, currentIndex) {
                    swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
                }
            });
            
            $.validator.addMethod('double', function (value, element) {
                return this.optional(element) || /^[+-]?[0-9]+(?:,[0-9]+)*(?:\.[0-9]+)?$/.test(value);
            }, "<?php echo Core::lang('val_numeric_html')?>");

            $.validator.addMethod('email', function (value, element) {
                return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
            }, "<?php echo Core::lang('val_email_html')?>");
            
            $.validator.addMethod('notzero', function (value, element) {
                return this.optional(element) || /^[^0]+$/.test(value);
            }, "<?php echo Core::lang('input_required')?>");

            $.validator.addMethod('numeric', function (value, element) {
                return this.optional(element) || /^[0-9]+$/.test(value);
            }, "<?php echo Core::lang('val_numeric_html')?>");

            $.validator.addMethod('alphanumeric', function (value, element) {
                return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
            }, "<?php echo Core::lang('val_alphanumeric_html')?>");
            
            $(".validation-wizard").validate({
                ignore: "input[type=hidden]",
                errorClass: "text-danger",
                successClass: "text-success",
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass)
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass)
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element)
                },
                rules: {
                    email: 'email',
                    phone: 'numeric',
                    fax: 'numeric',
                    refid: 'alphanumeric',
                    consigneephone: 'numeric',
                    koli: 'notzero'
                }
            });

            $('#custid').on('keyup', function() {
                if (!$.trim($('#custid').val()).length){
                    $("#shippername").prop('readonly', false);
                    $("#aliasname").prop('readonly', false);
                    $("#address").prop('readonly', false);
                    $("#email").prop('readonly', false);
                    $("#phone").prop('readonly', false);
                    $("#fax").prop('readonly', false);
                    $("#shippername").val('');
                    $("#aliasname").val('');
                    $("#address").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $("#fax").val('');
                } else {
                    $("#shippername").prop('readonly', true);
                    $("#aliasname").prop('readonly', true);
                    $("#address").prop('readonly', true);
                    $("#email").prop('readonly', true);
                    $("#phone").prop('readonly', true);
                    $("#fax").prop('readonly', true);
                }
            });
            /* Default value */
            $('#length').val(0);
            $('#width').val(0);
            $('#height').val(0);
            $('#realkg').val(0);
            $('#weight').val(0);
            $('#koli').val(0);
            $('a[href$="#next"]').addClass('bg-theme');
            /* default event */
            $(document).on("focusin", "#koli", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#koli", function() {
                $(this).prop('readonly', false); 
            });
        });
    </script>
</body>

</html>
