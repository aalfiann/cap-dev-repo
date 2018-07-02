<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('agent').' '.Core::lang('transaction')?> - <?php echo Core::getInstance()->title?></title>
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
                    <h3 class="text-themecolor"><?php echo Core::lang('transaction')?> <b class="text-themecolor"><i class="mdi mdi-currency-usd"></i> <span id="mydeposit">0</span></b></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('extension')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('agent')?></a></li>
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
                                                    <label><?php echo Core::lang('customer_type')?> :</label>
                                                    <div class="radio-list">
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio1" name="radio" type="radio" checked="" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Non Member</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Member</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input id="radio3" name="radio" type="radio" class="custom-control-input">
                                                            <span class="custom-control-indicator"></span>
                                                            <span class="custom-control-description">Corporate</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="dobrowse" class="form-group">
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
                                                    <input type="text" class="form-control required" name="phone" id="phone" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fax"><?php echo Core::lang('shipper_fax')?> : </label>
                                                    <input type="text" class="form-control" name="fax" id="fax" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
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
                                                    <label for="refid"> <?php echo Core::lang('reference_id')?> : </label>
                                                    <div class="form-group">
                                                        <input type="text" id="refid" name="refid" class="form-control" placeholder="<?php echo Core::lang('input_reference_id')?>">
                                                        <small class="form-text text-muted"><?php echo Core::lang('help_reference_id')?></small>
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
                                                    <input type="text" class="form-control required" name="consigneephone" id="consigneephone" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="consigneefax"><?php echo Core::lang('consignee_fax')?> : </label>
                                                    <input type="text" class="form-control" name="consigneefax" id="consigneefax" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"> </div>
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
                                                        <label for="mode"><?php echo Core::lang('bag')?> : <span class="text-danger">*</span> </label>
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
                                                <h3><?php echo Core::lang('route_shipment')?></h3><hr>
                                                <div class="form-group">
                                                    <label for="origin"> <?php echo Core::lang('origin')?> : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="origin" name="origin" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="destination"> <?php echo Core::lang('destination')?> : <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="destination" name="destination" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="estimation"><?php echo Core::lang('estimation')?> : <span class="text-danger">*</span></label>
                                                            <input name="estimation" id="estimation" class="form-control" style="text-align: right;" maxlength="2" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required></input>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="handling"><?php echo Core::lang('shipping_cost_handling')?> :</label>
                                                            <input name="handling" id="handling" class="form-control" style="text-align: right;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h3><?php echo Core::lang('insurance_calculate')?></h3><hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="insurance_rate"><?php echo Core::lang('insurance_rate')?> :</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="insurance_rate" name="insurance_rate" placeholder="0.000"></input>
                                                                <span class="input-group-addon hidden-md-down" id="basic-addon2">%</span>
                                                            </div>
                                                            <small id="errorinsurance_rate" class="form-text text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="goods_value"><?php echo Core::lang('goods_value')?> :</label>
                                                            <input name="goods_value" id="goods_value" class="form-control is-valid" style="text-align: right;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group" hidden>
                                                    <label for="company_logo"> <?php echo Core::lang('agent_setting_logo')?> : </label>
                                                    <input type="text" class="form-control" id="company_logo" name="company_logo">
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="company_name"> <?php echo Core::lang('agent_setting_company_name')?> : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="company_name" name="company_name">
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="company_address"> <?php echo Core::lang('agent_setting_company_address')?> : <span class="text-danger">*</span> </label>
                                                    <textarea type="text" class="form-control required" id="company_address" name="company_address"></textarea>
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="company_phone"> <?php echo Core::lang('agent_setting_company_phone')?> : <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="company_phone" name="company_phone">
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="company_fax"> <?php echo Core::lang('agent_setting_company_fax')?> : </label>
                                                    <input type="text" class="form-control" id="company_fax" name="company_fax">
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="company_email"> <?php echo Core::lang('agent_setting_company_email')?> : </label>
                                                    <input type="text" class="form-control" id="company_email" name="company_email">
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="signature"> <?php echo Core::lang('agent_setting_company_signature_name')?> : </label>
                                                    <input type="text" class="form-control" id="signature" name="signature">
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="company_tin"> <?php echo Core::lang('agent_setting_company_tin')?> : </label>
                                                    <input type="text" class="form-control" id="company_tin" name="company_tin">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group" hidden>
                                                            <label for="kgp"><?php echo Core::lang('kgp')?> :</label>
                                                            <input type="text" class="form-control" id="kgp" name="kgp"></input>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group" hidden>
                                                            <label for="kgs"><?php echo Core::lang('kgs')?> :</label>
                                                            <input name="kgs" id="kgs" class="form-control" style="text-align: right;"></input>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group" hidden>
                                                            <label for="minkgp"><?php echo Core::lang('kgs')?> :</label>
                                                            <input name="minkgp" id="minkgp" class="form-control" style="text-align: right;"></input>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group" hidden>
                                                            <label for="hkgp"><?php echo Core::lang('hkgp')?> :</label>
                                                            <input type="text" class="form-control" id="hkgp" name="hkgp"></input>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group" hidden>
                                                            <label for="hkgs"><?php echo Core::lang('hkgs')?> :</label>
                                                            <input name="hkgs" id="hkgs" class="form-control" style="text-align: right;"></input>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group" hidden>
                                                            <label for="minhkgp"><?php echo Core::lang('kgs')?> :</label>
                                                            <input name="minhkgp" id="minhkgp" class="form-control" style="text-align: right;"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"><br></div>
                                            </div>
                                            <div class="col-md-6">
                                                <h3><?php echo Core::lang('payment')?><b><div id="displaytotal" class="pull-right d-md-none d-lg-block" style="color: #00897b;"></div></b></h3>
                                                <hr>
                                                <div class="form-group row">
                                                    <label for="shipping_cost" class="col-sm-3"><?php echo Core::lang('shipping_cost')?> : <span class="text-danger">*</span></label>
                                                    <input name="shipping_cost" id="shipping_cost" class="form-control form-control-lg col-sm-9" style="text-align: right;color: #00897b;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_insurance" class="col-sm-3"><?php echo Core::lang('shipping_cost_insurance')?> :</label>
                                                    <input name="shipping_cost_insurance" id="shipping_cost_insurance" class="form-control col-sm-9" style="text-align: right;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_packing" class="col-sm-3"><?php echo Core::lang('shipping_cost_packing')?> :</label>
                                                    <input name="shipping_cost_packing" id="shipping_cost_packing" class="form-control col-sm-9" style="text-align: right;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_forward" class="col-sm-3"><?php echo Core::lang('shipping_cost_forward')?> :</label>
                                                    <input name="shipping_cost_forward" id="shipping_cost_forward" class="form-control col-sm-9" style="text-align: right;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_surcharge" class="col-sm-3"><?php echo Core::lang('shipping_cost_surcharge')?> :</label>
                                                    <input name="shipping_cost_surcharge" id="shipping_cost_surcharge" class="form-control col-sm-9" style="text-align: right;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_admin" class="col-sm-3"><?php echo Core::lang('shipping_cost_admin')?> :</label>
                                                    <input name="shipping_cost_admin" id="shipping_cost_admin" class="form-control col-sm-9" style="text-align: right;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_discount" class="col-sm-3"><?php echo Core::lang('shipping_cost_discount')?> :</label>
                                                    <input name="shipping_cost_discount" id="shipping_cost_discount" class="form-control col-sm-9" style="text-align: right;color: red;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="shipping_cost_total" class="col-sm-3"><?php echo Core::lang('shipping_cost_total')?> : <span class="text-danger">*</span> </label>
                                                    <input name="shipping_cost_total" id="shipping_cost_total" class="form-control form-control-lg col-sm-9" style="text-align: right;color: #00897b;" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></input>
                                                </div>
                                                <div class="form-group row" hidden>
                                                    <label for="payment_method" class="col-sm-3"><?php echo Core::lang('payment_method')?></label>
                                                    <select class="custom-select form-control col-sm-9 required" id="payment_method" name="payment_method"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="col-md-12 m-l-5"><p><i class="mdi mdi-information text-themecolor"></i> <?php echo Core::lang('transaction_input_notice')?></p></div>
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
        var admincost = 0;
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

        /* Get payment method option start */
        function loadPaymentOption(){
            $(function(){
                $.ajax({
				    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/payment/data/list/'.$datalogin['username'].'/'.$datalogin['token'])?>")+"?_="+randomText(60),
	    	    	dataType: 'json',
	    	    	type: 'GET',
		    		ifModified: true,
    		        success: function(data,status) {
    			    	if (status === "success") {
					    	if (data.status == "success"){
                                $.each(data.results, function(i, item) {
                                    $("#payment_method").append("<option value=\""+data.results[i].PaymentID+"\">"+data.results[i].Payment+"</option>");
                                });
    				    	}
    	    			}
	    		    },
                	error: function(x, e) {}
    	    	});
            });
        }
        /* Get payment method option end */

        function scrollToBottom() {
            $(function() {
                var scrollBottom = Math.max($('#tablevolume >tbody').height() + 20, 0);
                $('.table-responsive').scrollTop(scrollBottom);
            });
        }

        

        function inputCost(allow=true){
            $(function() {
                var disable = false;
                if (allow == false) disable = true;
                $('#insurance_rate').prop('readonly', disable);
                $('#goods_value').prop('readonly', disable);
                $('#shipping_cost').prop('readonly', true);
                $('#shipping_cost_insurance').prop('readonly', disable);
                $('#shipping_cost_packing').prop('readonly', disable);
                $('#shipping_cost_forward').prop('readonly', disable);
                $('#shipping_cost_surcharge').prop('readonly', disable);
                $('#shipping_cost_admin').prop('readonly', disable);
                $('#shipping_cost_discount').prop('readonly', disable);
                $('#shipping_cost_total').prop('readonly', disable);
            });
        }

        function inputConsignee(allow=true){
            $(function(){
                var disable = false;
                if (allow == false) disable = true;
                $("#shippername").prop('readonly', disable);
                $("#aliasname").prop('readonly', disable);
                $("#address").prop('readonly', disable);
                $("#email").prop('readonly', disable);
                $("#phone").prop('readonly', disable);
                $("#fax").prop('readonly', disable);
            });
        }

        function consigneeReset(){
            $(function(){
                $("#custid").val('');
                $("#shippername").val('');
                $("#aliasname").val('');
                $("#address").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#fax").val('');
            });
        }

        function costReset(){
            $(function(){
                $('#kgp').val(0);
                $('#kgs').val(0);
                $('#minkgp').val(0);
                $('#estimation').val(0);
                $('#hkgp').val(0);
                $('#hkgs').val(0);
                $('#minhkgp').val(0);
                $('#handling').val(0);
                $('#insurance_rate').val(0);
                $('#goods_value').val(0);
                $('#shipping_cost').val(0);
                $('#shipping_cost_insurance').val(0);
                $('#shipping_cost_packing').val(0);
                $('#shipping_cost_forward').val(0);
                $('#shipping_cost_surcharge').val(0);
                $('#shipping_cost_admin').val(admincost);
                $('#shipping_cost_discount').val(0);
                $('#shipping_cost_total').val(0);
            });
        }

        function calculateCost(){
            $(function(){
                if ($.trim($('#shipping_cost').val()) == '') $('#shipping_cost').val(0).select();
                if ($.trim($('#shipping_cost_insurance').val()) == '') $('#shipping_cost_insurance').val(0).select();
                if ($.trim($('#shipping_cost_packing').val()) == '') $('#shipping_cost_packing').val(0).select();
                if ($.trim($('#shipping_cost_forward').val()) == '') $('#shipping_cost_forward').val(0).select();
                if ($.trim($('#shipping_cost_surcharge').val()) == '') $('#shipping_cost_surcharge').val(0).select();
                if ($.trim($('#shipping_cost_admin').val()) == '') $('#shipping_cost_admin').val(0).select();
                if ($.trim($('#shipping_cost_discount').val()) == '') $('#shipping_cost_discount').val(0).select();
                if ($.trim($('#shipping_cost_total').val()) == '') $('#shipping_cost_total').val(0).select();

                var a = parseInt($('#shipping_cost').val());
                var b = parseInt($('#shipping_cost_insurance').val());
                var c = parseInt($('#shipping_cost_packing').val());
                var d = parseInt($('#shipping_cost_forward').val());
                var e = parseInt($('#shipping_cost_surcharge').val());
                var f = parseInt($('#shipping_cost_admin').val());
                var g = parseInt($('#shipping_cost_discount').val());
                var result = (a+b+c+d+e+f)-g;
                if (isNaN(result)) result = 0;
                $('#shipping_cost_total').val(result);
                $('#displaytotal').html('<?php echo Core::lang('currency_format')?> '+addCommas(result)); 
            });
        }

        function calculateInsurance(){
            $(function(){
                if (!validationRegex("insurance_rate","decimal",true)){
                    $('#errorinsurance_rate').html('<?php echo Core::lang('val_decimal_html')?>');
                    return false;
                } else {
                    $('#errorinsurance_rate').html('');
                }
                var a = parseFloat($('#insurance_rate').val());
                var b = parseInt($('#goods_value').val());
                var result = (a*b)/100;
                if (!isNaN(result)){
                    if (result == 0){
                        result = 0;
                    } else if (result < 1000){
                        result = 1000;
                    }
                } else {
                    result = 0;
                }
                if (a==0) $('#goods_value').val(0);
                if ($.trim($('#goods_value').val()) == '') $('#goods_value').val(0).select();
                $('#shipping_cost_insurance').val(Math.round(result));
                calculateCost();     
            });
        }

        /** 
         * Get selected option value for moda (Pure JS)
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

        /** 
         * Get selected option value for payment (Pure JS)
         */
        function selectedOptionPayment(){
            var selection = document.getElementById("payment_method") !== null;
            if (selection){
                var selectBox = document.getElementById("payment_method");
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

        function volumeReset(){
            $(function(){
                $('#length').val(0);
                $('#width').val(0);
                $('#height').val(0);
                $('#actkg').val('');
                $('#realkg').val(0);
                $('#weight').val(0);
                $('#koli').val(0);
            });
        }

        function clearTable(){
            $(function(){
                $("#tablevolume tr").not(function(){ return !!$(this).has('th').length; }).remove();
                volumeReset();
                $('#tablejson').val('');
                count = 1;
                costReset();
                calculateCost();
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
                $('#length').select();
                scrollToBottom();
                costReset();
                calculateCost();
            });
        }

        loadModeOption();
        loadPaymentOption();
        
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
                    if (($('#radio2').is(':checked') || $('#radio3').is(':checked')) && !$.trim($('#custid').val()).length){
                        swal("<?php echo Core::lang('transaction_failed')?>", "<?php echo Core::lang('transaction_failed_customer')?>","error");
                    } else {
                        sendnewdata();
                    }
                }
            });
            
            $.validator.addMethod('decimal', function (value, element) {
                return this.optional(element) || /^[+-]?[0-9]+(?:\.[0-9]+)?$/.test(value);
            }, "<?php echo Core::lang('val_decimal_html')?>");

            $.validator.addMethod('rate', function (value, element) {
                return this.optional(element) || /^[+-]?[0-9]+(?:\.[0-9]+)?$/.test(value);
            }, "");

            $.validator.addMethod('goods_value', function (value, element) {
                if ($('#insurance_rate').val() != 0 && ($('#goods_value').val() > 0)){
                    return true;
                } else if ($('#insurance_rate').val() == 0 && ($('#goods_value').val() == 0)){
                    return true;
                }
            }, "<?php echo Core::lang('input_required')?>");

            $.validator.addMethod('double', function (value, element) {
                return this.optional(element) || /^[+-]?[0-9]+(?:,[0-9]+)*(?:\.[0-9]+)?$/.test(value);
            }, "<?php echo Core::lang('val_double_html')?>");

            $.validator.addMethod('email', function (value, element) {
                return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
            }, "<?php echo Core::lang('val_email_html')?>");
            
            $.validator.addMethod('notzero', function (value, element) {
                return this.optional(element) || /^[1-9][0-9]*$/.test(value);
            }, "<?php echo Core::lang('input_required')?>");

            $.validator.addMethod('notblank', function (value, element) {
                if ($(element).val().trim() != "") return this.optional(element) || true;
                return this.optional(element) || false;
            }, "<?php echo Core::lang('input_required')?>");

            $.validator.addMethod('refid', function (value, element) {
                return this.optional(element) || /^[a-zA-Z0-9_@./#&+-]{8,20}$/.test(value);
            }, "<?php echo Core::lang('input_reference_id_val')?>");

            $.validator.addMethod('numeric', function (value, element) {
                return this.optional(element) || /^[0-9]+$/.test(value);
            }, "<?php echo Core::lang('val_numeric_html')?>");

            $.validator.addMethod('alphanumeric', function (value, element) {
                return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
            }, "<?php echo Core::lang('val_alphanumeric_html')?>");
            
            $.validator.addMethod("valueNotEquals", function(value, element, arg){
                return arg !== value;
            }, "<?php echo Core::lang('input_required')?>");
            
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
                    refid: 'refid',
                    consigneephone: 'numeric',
                    koli: 'notzero',
                    insurance_rate: 'rate',
                    goods_value: 'goods_value',
                    shipping_cost: 'notzero',
                    shipping_cost_total: 'notzero',
                    origin: 'notblank',
                    destination: 'notblank',
                    estimation: 'notzero',
                    destid: 'valueNotEquals'
                },
                messages: {
                    destid: "<?php echo Core::lang('select_destination_required')?>",
                    origin: "<?php echo Core::lang('input_required')?>",
                    destination: "<?php echo Core::lang('input_required')?>",
                    estimation: "<?php echo Core::lang('input_required')?>",
                } 
            });
            
            $(document).on("focusin", "#custid", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#custid", function() {
                $(this).prop('readonly', false); 
            });

            $(document).on("focusin", "#shipping_cost_total", function() {
                $(this).prop('readonly', true);  
            });

            $(document).on("focusout", "#shipping_cost_total", function() {
                $(this).prop('readonly', false); 
            });
            
            $('#radio1').click(function() {
                if($('#radio1').is(':checked')) {
                    consigneeReset();
                    inputConsignee();
                    $("#payment_method").val('1');
                    $("#dobrowse").hide();
                }
            });

            $('#radio2').click(function() {
                if($('#radio2').is(':checked')) {
                    consigneeReset();
                    inputConsignee(); 
                    $("#payment_method").val('1');
                    $("#dobrowse").show();
                }
            });

            $('#radio3').click(function() {
                if($('#radio3').is(':checked')) {
                    consigneeReset();
                    inputConsignee(); 
                    $("#payment_method").val('4');
                    $("#dobrowse").show();
                }
            });

            $('#insurance_rate').on('keyup', function() {
                calculateInsurance();
            });
            $('#goods_value').on('keyup', function() {
                calculateInsurance();
            });

            $('#shipping_cost').on('keyup', function() {
                calculateCost();
            });
            $('#shipping_cost_insurance').on('keyup', function() {
                calculateCost();
            });
            $('#shipping_cost_packing').on('keyup', function() {
                calculateCost();
            });
            $('#shipping_cost_forward').on('keyup', function() {
                calculateCost();
            });
            $('#shipping_cost_surcharge').on('keyup', function() {
                calculateCost();
            });
            $('#shipping_cost_admin').on('keyup', function() {
                calculateCost();
            });
            $('#shipping_cost_discount').on('keyup', function() {
                calculateCost();
            });
            $('#handling').on('keyup',function(){
                if ($.trim($('#handling').val()) == '') $('#handling').val(0).select();
            });
            /* Default value */
            volumeReset();
            /* default value payment */
            costReset();
            /* default set */
            $('#ekubik').hide();
            $('a[href$="#next"]').addClass('bg-theme');
            $("#dobrowse").hide();
            /* default event */
            $('#mode').change(function(){
                if (selectedOption() == '3'){
                    $('#ekubik').show();
                } else {
                    $('#kubik').prop('checked', false);
                    $('#ekubik').hide();
                }
                clearTable();
            });
            /* Default Mode */
            setTimeout(function(){
                $("select#mode").prop('selectedIndex', 1);
            },3000);
            /* Default onload */
            readConfig();
            getBalance();
            /* Check agent settings */
            setTimeout(function(){
                if ($('#company_name').val().trim() == "") {
                    swal({
                            title: "<?php echo Core::lang('agent_setting_warning_transaction_title')?>",
                            text: "<?php echo Core::lang('agent_setting_warning_transaction_setting')?>",
                            type: "warning"
                        },
                        function(){
                            window.location.href = "modul-agent-settings.php";
                    });
                }
            },10000)
        });


        /* Submit transaction start */
        function sendnewdata(){
            $(function(){
                console.log("Process add new data...");
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargoagent/transaction/data/new')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        CustomerID: $("#custid").val(),
                        Consignor_name: $("#shippername").val(),
                        Consignor_alias: $("#aliasname").val(),
                        Consignor_address: $("#address").val(),
                        Consignor_phone: $("#phone").val(),
                        Consignor_fax: $("#fax").val(),
                        Consignor_email: $("#email").val(),
                        ReferenceID: $("#refid").val(),
                        Consignee_name: $("#consigneename").val(),
                        Consignee_attention: $("#attentionname").val(),
                        Consignee_address: $("#consigneeaddress").val(),
                        Consignee_phone: $("#consigneephone").val(),
                        Consignee_fax: $("#consigneefax").val(),
                        Mode: $("#mode option:selected").text(),
                        Origin: $("#origin").val(),
                        Destination: $("#destination").val(),
                        Estimation: $("#estimation").val(),
                        Instruction: $("#instructions").val(),
                        Description: $("#descriptions").val(),
                        Goods_data: $("#tablejson").val(),
                        Goods_koli: $("#koli").val(),
                        Weight: $("#weight").val(),
                        Weight_real: $("#realkg").val(),
                        Insurance_rate: $("#insurance_rate").val(),
                        Goods_value: $("#goods_value").val(),
                        Payment: $("#payment_method option:selected").text(),
                        Shipping_cost: $("#shipping_cost").val(),
                        Shipping_insurance: $("#shipping_cost_insurance").val(),
                        Shipping_packing: $("#shipping_cost_packing").val(),
                        Shipping_forward: $("#shipping_cost_forward").val(),
                        Shipping_handling: $("#handling").val(),
                        Shipping_surcharge: $("#shipping_cost_surcharge").val(),
                        Shipping_admin: $("#shipping_cost_admin").val(),
                        Shipping_discount: $("#shipping_cost_discount").val(),
                        Shipping_cost_total: $("#shipping_cost_total").val(),
                        Company_logo: $("#company_logo").val(),
                        Company_name: $("#company_name").val(),
                        Company_address: $("#company_address").val(),
                        Company_phone: $("#company_phone").val(),
                        Company_fax: $("#company_fax").val(),
                        Company_email: $("#company_email").val(),
                        Company_tin: $("#company_tin").val(),
                        Signature: $("#signature").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        if (data.status == "success"){
                            console.log("<?php echo Core::lang('core_process_add').' '.Core::lang('transaction').' '.Core::lang('status_success')?>");
                            swal({
                                title: "<?php echo Core::lang('transaction_success')?>",
                                text: "No Waybill: "+data.waybill,
                                type: "success"
                            },
                            function(){
                                window.location.href = "print-agent-waybill.php?no="+data.waybill+"&ref=modul-agent-transaction.php";
                            });
                        } else {
                            console.log("<?php echo Core::lang('core_process_add').' '.Core::lang('transaction').' '.Core::lang('status_failed')?>");
                            console.log("Message: "+data.message);
                            swal("<?php echo Core::lang('transaction_failed')?>",  data.message,"error");
                        }
                    },
                    error: function(x, e) {}
                }); 
            });
        }
        /* Submit transaction end */

        function readConfig(){
            $(function(){
                $.ajax({
                    type: "GET",
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/flexibleconfig/read/agent_config_'.$datalogin['username'].'/'.$datalogin['username'].'/'.$datalogin['token'])?>"),
                    dataType: "json",
                    cache: false,
                    success: function (data, textstatus) {
                        if (data.status == "success"){
                            if (!$.trim(data.result[0].value)) {} else {
                                var obj = JSON.parse(data.result[0].value);
                                if (!$.trim(obj.logo)) {} else {$("#company_logo").val(obj.logo)}
                                if (!$.trim(obj.name)) {} else {$("#company_name").val(obj.name)}
                                if (!$.trim(obj.address)) {} else {$("#company_address").val(obj.address)}
                                if (!$.trim(obj.phone)) {} else {$("#company_phone").val(obj.phone)}
                                if (!$.trim(obj.fax)) {} else {$("#company_fax").val(obj.fax)}
                                if (!$.trim(obj.email)) {} else {$("#company_email").val(obj.email)}
                                if (!$.trim(obj.signature)) {$("#signature").val("<?php echo $datalogin['username']?>")} else {$("#signature").val(obj.signature)}
                                if (!$.trim(obj.tin)) {} else {$("#company_tin").val(obj.tin)}
                                if (!$.trim(obj.origin_district)) {} else {$("#origin").val(obj.origin_district)}
                                if (!$.trim(obj.admin_cost)) {$("#shipping_cost_admin").val(0)} else {$("#shipping_cost_admin").val(obj.admin_cost)}
                                admincost = obj.admin_cost;
                            }
                        }
                    },
                    error: function (data, textstatus) {
                        console.log("Error: "+data.message);
                    }
                });
            });
        }
        
        function getBalance(){
            $(function(){
                /* Get balance */
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/deposit/transaction/data/balance/'.$datalogin['username'].'/'.$datalogin['token'])?>")+"?_="+randomText(1),
                    dataType: "json",
                    type: "GET",
                    success: function(data) {
                        if (data.status == "success"){
                            if (!$.trim(data.result.Balance)){
                                $("#mydeposit").html("0");
                            } else {
                                $("#mydeposit").html(addCommas(data.result.Balance));
                            }
                        }
                    },
                    error: function(x, e) {}
                });
            });
        }
    </script>
</body>

</html>
