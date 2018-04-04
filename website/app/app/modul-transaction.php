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
                                                    <label for="custid"> Customer ID : </label>
                                                    <div class="input-group">
                                                        <input type="text" id="custid" name="custid" class="form-control" placeholder="Customer ID could be ID Corporate or ID Member...">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-info" type="button">Browse!</button>
                                                        </span>
                                                    </div>
                                                    <small id="custidHelp" class="form-text text-muted">Click browse to search Customer ID.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shippername"> Shipper Name : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="shippername" name="shippername"> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="aliasname"> Alias Name : </label>
                                                    <input type="text" class="form-control" id="aliasname" name="aliasname"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="address"> Address : <span class="text-danger">*</span> </label>
                                                    <textarea name="address" id="address" rows="6" class="form-control required" style="resize: vertical;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email"> Email Address : </label>
                                                    <input type="email" class="form-control" name="email" id="email"> </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phone">Phone Number : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" name="phone" id="phone"> </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fax">Fax Number : </label>
                                                    <input type="text" class="form-control" name="fax" id="fax"> </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 2 -->
                                    <h6><?php echo Core::lang('consignee')?></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="refid"> Referensi ID : </label>
                                                    <div class="form-group">
                                                        <input type="text" id="refid" name="refid" class="form-control" placeholder="Referensi ID must unique...">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="consigneename"> Consignee Name : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="consigneename" name="consigneename"> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="attentionname"> Attention Name : </label>
                                                    <input type="text" class="form-control" id="attentionname" name="attentionname"> </div>
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
                                                    <input type="text" class="form-control required" name="consigneephone" id="consigneephone"> </div>
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
                                                    <label for="instructions">Instructions :</label>
                                                    <textarea name="instructions" id="instructions" rows="6" class="form-control" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="descriptions">Descriptions : <span class="text-danger">*</span> </label>
                                                    <textarea name="descriptions" id="descriptions" rows="6" class="form-control required" style="resize: vertical;"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="participants1">Type</label>
                                                    <select class="custom-select form-control required" id="participants1" name="location">
                                                        <option value="Document">Document</option>
                                                        <option value="Package">Package</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="participants1">Volume Kg</label>
                                                    <div class="table-responsive" style="height:300px;overflow: auto;">
                                                    <table id="myTable" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Panjang</th>
                                                                <th>Lebar</th>
                                                                <th>Tinggi</th>
                                                                <th>Vol. Kg</th>
                                                                <th>Act. Kg</th>
                                                                <th>Surcharge</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>20</td>
                                                                <td>30</td>
                                                                <td>40</td>
                                                                <td>22</td>
                                                                <td>10</td>
                                                                <td>0</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
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
                    consigneephone: 'numeric'
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
        });
    </script>
</body>

</html>
