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
    <!-- Typehead CSS -->
    <link href="../assets/plugins/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
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
                                                    <label for="phone"><?php echo Core::lang('shipper_phone')?> : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" name="phone" id="phone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fax"><?php echo Core::lang('shipper_fax')?> : </label>
                                                    <input type="text" class="form-control" name="fax" id="fax" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email"> <?php echo Core::lang('email_address')?> : </label>
                                                    <input type="email" class="form-control" name="email" id="email">
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
                                                    <label for="attentionname"> <?php echo Core::lang('attention_name')?> : </label>
                                                    <input type="text" class="form-control" id="attentionname" name="attentionname">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="consigneeaddress"><?php echo Core::lang('consignee_address')?> : <span class="text-danger">*</span> </label>
                                                    <textarea name="consigneeaddress" id="consigneeaddress" rows="6" class="form-control required" style="resize: vertical;"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="consigneephone"><?php echo Core::lang('consignee_phone')?> : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" name="consigneephone" id="consigneephone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="consigneefax"><?php echo Core::lang('consignee_fax')?> : </label>
                                                    <input type="text" class="form-control" name="consigneefax" id="consigneefax" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"> </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6><?php echo Core::lang('goods_detail')?></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mode"><?php echo Core::lang('mode')?></label>
                                                    <select class="custom-select form-control required" id="mode" name="mode"></select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="instructions"><?php echo Core::lang('goods_instruction')?> :</label>
                                                    <textarea name="instructions" id="instructions" rows="6" class="form-control" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="descriptions"><?php echo Core::lang('goods_description')?> : <span class="text-danger">*</span> </label>
                                                    <textarea name="descriptions" id="descriptions" rows="6" class="form-control required" style="resize: vertical;"></textarea>
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="tablejson">JSON Table : </label>
                                                    <textarea name="tablejson" id="tablejson" rows="6" class="form-control" style="resize: vertical;"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mode"><?php echo Core::lang('goods_weight')?></label>
                                                <label id="ekubik" class="inline custom-control custom-checkbox block pull-right">
                                                    <input id="kubik" type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0"><?php echo Core::lang('cubication')?></span>
                                                </label>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up"><?php echo Core::lang('length')?> :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="<?php echo Core::lang('length')?>" name="length" id="length">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">cm</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up"><?php echo Core::lang('width')?> :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="<?php echo Core::lang('width')?>" name="width" id="width">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">cm</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up"><?php echo Core::lang('height')?> :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="<?php echo Core::lang('height')?>" name="height" id="height">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">cm</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-3">
                                                        <label for="mode" class="hidden-md-up"><?php echo Core::lang('actkg')?> :</label>
                                                        <div class="input-group">
                                                            <input type="text" maxlength="7" class="form-control" placeholder="<?php echo Core::lang('actkg')?>" name="actkg" id="actkg">
                                                            <span class="input-group-addon hidden-md-down" id="basic-addon2">Kg</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <small id="errorvolume" class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-md-12"><br></div>
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-themecolor w-100" onclick="addVolume()"><?php echo Core::lang('add')?> <?php echo Core::lang('volume')?></button>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <div class="table-responsive" style="height:200px;overflow: auto;">
                                                    <table id="tablevolume" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th><?php echo Core::lang('length')?></th>
                                                                <th><?php echo Core::lang('width')?></th>
                                                                <th><?php echo Core::lang('height')?></th>
                                                                <th><?php echo Core::lang('actual')?></th>
                                                                <th><?php echo Core::lang('volume')?></th>
                                                                <th><?php echo Core::lang('total')?></th>
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
                                                        <button type="button" class="btn btn-default w-100" onclick="clearTable()"><?php echo Core::lang('clear')?> <?php echo Core::lang('volume')?></button>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"><br></div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="mode"><?php echo Core::lang('realkg')?> :</label>
                                                        <input type="text" class="form-control" placeholder="<?php echo Core::lang('realkg')?>" name="realkg" id="realkg" readonly>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-4">
                                                        <label for="mode"><?php echo Core::lang('weight')?> Kg :</label>
                                                        <input type="text" class="form-control" placeholder="<?php echo Core::lang('weight')?>" name="weight" id="weight" readonly>
                                                    </div>
                                                    <div class="col-md-12 hidden-md-up"><br></div>
                                                    <div class="col-md-4">
                                                        <label for="mode"><?php echo Core::lang('bag')?> :</label>
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
                                                <h3><?php echo Core::lang('tariff')?></h3><hr>
                                                <div class="form-group">
                                                    <label for="origin"><?php echo Core::lang('origin')?> :</label>
                                                    <select class="custom-select form-control required" id="origin" name="origin" readonly></select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="destination"><?php echo Core::lang('destination')?> :</label>
                                                    <div id="destination-list">
                                                        <input class="typeahead form-control required" id="destination" name="destination" placeholder="<?php echo Core::lang('city_district')?>"></input>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-themecolor w-100"><?php echo Core::lang('submit').' '.Core::lang('tariff')?></button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h3><?php echo Core::lang('payment')?></h3><hr>
                                                <div class="form-group row">
                                                    <label for="goods_value" class="col-sm-3"><?php echo Core::lang('goods_value')?> :</label>
                                                    <input name="goods_value" id="goods_value" class="form-control is-valid col-sm-9" style="text-align: right;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost" class="col-sm-3"><?php echo Core::lang('shipping_cost')?> :</label>
                                                    <input name="shipping_cost" id="shipping_cost" class="form-control col-sm-9" style="text-align: right;color: limegreen;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_insurance" class="col-sm-3"><?php echo Core::lang('shipping_cost_insurance')?> :</label>
                                                    <input name="shipping_cost_insurance" id="shipping_cost_insurance" class="form-control col-sm-9" style="text-align: right;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_packing" class="col-sm-3"><?php echo Core::lang('shipping_cost_packing')?> :</label>
                                                    <input name="shipping_cost_packing" id="shipping_cost_packing" class="form-control col-sm-9" style="text-align: right;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_forward" class="col-sm-3"><?php echo Core::lang('shipping_cost_forward')?> :</label>
                                                    <input name="shipping_cost_forward" id="shipping_cost_forward" class="form-control col-sm-9" style="text-align: right;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_surcharge" class="col-sm-3"><?php echo Core::lang('shipping_cost_surcharge')?> :</label>
                                                    <input name="shipping_cost_surcharge" id="shipping_cost_surcharge" class="form-control col-sm-9" style="text-align: right;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_admin" class="col-sm-3"><?php echo Core::lang('shipping_cost_admin')?> :</label>
                                                    <input name="shipping_cost_admin" id="shipping_cost_admin" class="form-control col-sm-9" style="text-align: right;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_discount" class="col-sm-3"><?php echo Core::lang('shipping_cost_discount')?> :</label>
                                                    <input name="shipping_cost_discount" id="shipping_cost_discount" class="form-control col-sm-9" style="text-align: right;color: red;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_total" class="col-sm-3"><?php echo Core::lang('shipping_cost_total')?> :</label>
                                                    <input name="shipping_cost_total" id="shipping_cost_total" class="form-control form-control-lg col-sm-9" style="text-align: right;color: limegreen;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
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
    <!-- Table To Json  -->
    <script src="../assets/plugins/table-to-json/lib/jquery.tabletojson.min.js"></script>
    <!-- Typehead Plugin JavaScript -->
    <script src="../assets/plugins/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
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

        /* Get origin option start */
        function loadOriginOption(){
            $(function(){
                $.ajax({
				    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/tariff/data/list/origin/auto/search/'.$datalogin['username'].'/'.$datalogin['token'].'/?query=')?>")+"&_="+randomText(60),
	    	    	dataType: 'json',
	    	    	type: 'GET',
		    		ifModified: true,
    		        success: function(data,status) {
    			    	if (status === "success") {
					    	if (data.status == "success"){
                                $.each(data.results, function(i, item) {
                                    $("#origin").append("<option value=\""+data.results[i].Name+"\">"+data.results[i].Name+"</option>");
                                });
    				    	}
    	    			}
	    		    },
                	error: function(x, e) {}
    	    	}),
                $.ajax({
			        url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/tariff/data/list/destination/search/'.$datalogin['token'].'/?query=')?>")+"&_="+randomText(60),
    		    	dataType: 'json',
        	    	type: 'GET',
		        	ifModified: true,
    		        success: function(data,status) {
    		        	if (status === "success") {
				        	if (data.status == "success"){
                                var destination = [];
                                $.each(data.results, function(key, value) {
                                    destination.push(value.Kabupaten);
                                });
                                /* constructs the suggestion engine */
                                var destination = new Bloodhound({
                                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                                    /* `states` is an array of state names defined in "The Basics" */
                                    local: destination
                                });
     
                                /* -------- Scrollable -------- */
                                $('#destination-list .typeahead').typeahead(null, {
                                    name: 'destination',
                                    limit: 10,
                                    source: destination
                                });
    				        }
        	    		}
	        		},
                	error: function(x, e) {}
    		    });
            });
        }
        /* Get origin option end */

        /** 
         * Get selected option value for search (Pure JS)
         * Usage: don't do anything, this is depends on paginateDatatables function
         */
        function selectedOption(){
            var selection = document.getElementById("mode") !== null;
            if (selection){
                var selectBox = document.getElementById("mode");
                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                return selectedValue;
            } else {
                return "0";
            }
        }

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
                $('#tablejson').val('');
                count = 1;
            });
        }

        function convertJSON(){
            $(function(){
                var jsons = JSON.stringify($('#tablevolume').tableToJSON());
                jsons = jsons.replace(/#/g,'no')
                    .replace(/<?php echo Core::lang('length')?>/g,'length')
                    .replace(/<?php echo Core::lang('width')?>/g,'width')
                    .replace(/<?php echo Core::lang('height')?>/g,'height')
                    .replace(/<?php echo Core::lang('actual')?>/g,'actual')
                    .replace(/<?php echo Core::lang('volume')?>/g,'volume')
                    .replace(/<?php echo Core::lang('total')?>/g,'total');
                $('#tablejson').val(jsons);
            });
        }

        function addVolume(){
            $(function() {
                if (!validationRegex("length","decimal",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_decimal_html')?>');
                    $('#length').select();
                    return false;
                } else if (!validationRegex("width","decimal",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_decimal_html')?>');
                    $('#width').select();
                    return false;
                } else if (!validationRegex("height","decimal",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_decimal_html')?>');
                    $('#height').select();
                    return false;
                } else if (!validationRegex("actkg","decimal",true)){
                    $('#errorvolume').html('<?php echo Core::lang('val_decimal_html')?>');
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
                var cargovol = 0;
                var ilength = parseFloat($('#length').val());
                var iwidth = parseFloat($('#width').val());
                var iheight = parseFloat($('#height').val());
                var ikg = parseFloat($('#actkg').val());
                
                
                switch(selectedOption()) {
                    case '1':
                        cargovol = 6000;
                        break;
                    case '2':
                        cargovol = 4000;
                        break;
                    case '3':
                        cargovol = 4000;
                        if ($('#kubik:checked').length != 0){
                            cargovol = 1000000;
                        }
                        break;
                    default:
                    mode = 'road';
                }

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
                convertJSON();
            });
        }

        loadModeOption();
        loadOriginOption();
        
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
                    swal("Form Submitted!",  $('#tablejson').val());
                }
            });
            
            $.validator.addMethod('decimal', function (value, element) {
                return this.optional(element) || /^[+-]?[0-9]+(?:\.[0-9]+)?$/.test(value);
            }, "<?php echo Core::lang('val_decimal_html')?>");

            $.validator.addMethod('double', function (value, element) {
                return this.optional(element) || /^[+-]?[0-9]+(?:,[0-9]+)*(?:\.[0-9]+)?$/.test(value);
            }, "<?php echo Core::lang('val_double_html')?>");

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
            // default set */
            $('#ekubik').hide();
            $('a[href$="#next"]').addClass('bg-theme');
            /* default event */
            $(document).on("focusin", "#koli", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#koli", function() {
                $(this).prop('readonly', false); 
            });

            $('#mode').change(function(){
                if (selectedOption() == '3'){
                    $('#ekubik').show();
                } else {
                    $('#kubik').prop('checked', false);
                    $('#ekubik').hide();
                }
                clearTable();
            });

        });
    </script>
</body>

</html>
