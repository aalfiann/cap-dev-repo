<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$group = Core::getUserGroup();
if( $group > '2' && ($group != '6' && $group != '7') ) {Core::goToPage('modul-user-profile.php');exit;}?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('info').' '.Core::lang('tariff')?> - <?php echo Core::getInstance()->title?></title>
    <!-- Typehead CSS -->
    <link href="<?php echo Core::getInstance()->assetspath?>/plugins/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
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
                    <h3 class="text-themecolor"><?php echo Core::lang('info').' '.Core::lang('tariff')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('inquiry')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('info').' '.Core::lang('tariff')?></li>
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
                <div class="container-fluid">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><b><i class="mdi mdi-magnify"></i> <?php echo Core::lang('check_tariff')?></b></h3><hr>
                                    <form class="form-horizontal" id="searchtariff" action="#">
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo Core::lang('origin')?></label>
                                            <div id="origin-list" class="col-md-12">
                                                <input id="origin" type="text" class="typeahead form-control" placeholder="<?php echo Core::lang('city_district')?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><?php echo Core::lang('destination')?></label>
                                            <div id="destination-list" class="col-md-12">
                                                <input id="destination" type="text" class="typeahead form-control" placeholder="<?php echo Core::lang('city_district')?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="mode"><?php echo Core::lang('mode')?></label>
                                                <select class="custom-select form-control required" id="mode" name="mode"></select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo Core::lang('weight')?> Kg</label>
                                                <label id="ekubik" class="inline custom-control custom-checkbox block pull-right">
                                                    <input id="kubik" type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0"><?php echo Core::lang('cubication')?></span>
                                                </label>
                                                <div class="input-group">
                                                    <input id="weight" type="text" maxlength="7" class="form-control" required>
                                                    <span class="input-group-addon" id="basic-addon2">Kg</span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="mode" class="hidden-md-up"><?php echo Core::lang('length')?> :</label>
                                                    <div class="input-group">
                                                        <input type="text" maxlength="7" class="form-control" placeholder="<?php echo Core::lang('length')?>" name="length" id="length">
                                                        <span class="input-group-addon" id="basic-addon2">cm</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 hidden-md-up"><br></div>
                                                <div class="col-md-4">
                                                    <label for="mode" class="hidden-md-up"><?php echo Core::lang('width')?> :</label>
                                                    <div class="input-group">
                                                        <input type="text" maxlength="7" class="form-control" placeholder="<?php echo Core::lang('width')?>" name="width" id="width">
                                                        <span class="input-group-addon" id="basic-addon2">cm</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 hidden-md-up"><br></div>
                                                <div class="col-md-4">
                                                    <label for="mode" class="hidden-md-up"><?php echo Core::lang('height')?> :</label>
                                                    <div class="input-group">
                                                        <input type="text" maxlength="7" class="form-control" placeholder="<?php echo Core::lang('height')?>" name="height" id="height">
                                                        <span class="input-group-addon" id="basic-addon2">cm</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"><br></div>
                                        <button type="submit" class="btn btn-themecolor w-100"><?php echo Core::lang('submit')?></button>
                                    </form>    
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-6">
                            <div id="floatcard" class="card">
                                <div class="card-header">
                                    <b><?php echo Core::lang('tariff').' '.Core::lang('via')?> <span id="servicemode"></span></b>
                                    <div class="card-actions">
                                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                        <a class="btn-close" onclick="closeCard('floatcard');"><i class="ti-close"></i></a>
                                    </div>
                                </div>
                                <div class="card-body collapse show">
                                    <div id="resultcard"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
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
    <!-- Typehead Plugin JavaScript -->
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/typeahead.js-master/dist/typeahead.bundle.min.js"></script>
    <script>
        /* Get origin and destination option start */
        $(function(){
            $('#weight').val(1);
            $('#length').val(0);
            $('#width').val(0);
            $('#height').val(0);
            $.ajax({
			    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/tariff/data/list/origin/search/'.$datalogin['token'].'/?query=')?>")+"&_="+randomText(60),
		    	dataType: 'json',
    	    	type: 'GET',
		    	ifModified: true,
    		    success: function(data,status) {
    		    	if (status === "success") {
				    	if (data.status == "success"){
                            var origin = [];
                            $.each(data.results, function(key, value) {
                                origin.push(value.Name);
                            });
                            /* constructs the suggestion engine */
                            var origin = new Bloodhound({
                                datumTokenizer: Bloodhound.tokenizers.whitespace,
                                queryTokenizer: Bloodhound.tokenizers.whitespace,
                                /* `states` is an array of state names defined in "The Basics" */
                                local: origin
                            });
     
                            /* -------- Scrollable -------- */
                            $('#origin-list .typeahead').typeahead(null, {
                                name: 'origin',
                                limit: 10,
                                source: origin
                            });
    				    }
    	    		}
	    		},
            	error: function(x, e) {}
    		});

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
        /* Get origin and destination option end */

        /* Search tariff start */
        $("#searchtariff").on("submit",searchdata);
        function searchdata(e){
            closeCard("floatcard",false);
            console.log("Process search data...");
            e.preventDefault();
            var that = $(this);
            that.off("submit"); /* remove handler */
            var div = document.getElementById("resultcard");
            div.innerHTML = "";
            var mode = "";

            switch(selectedOption()) {
                case '1':
                    mode = 'air';
                    break;
                case '2':
                    mode = 'road';
                    break;
                case '3':
                    mode = 'sea';
                    break;
                default:
                mode = 'road';
            }

            $.ajax({
                url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/tariff/data/get/search/'.$datalogin['token'].'/?')?>")+"origin="+encodeURIComponent($("#origin").val())+"&destination="+encodeURIComponent($("#destination").val())+"&mode="+encodeURIComponent(mode)+"&cubic="+encodeURIComponent($("#kubik").is(':checked'))+"&weight="+encodeURIComponent($("#weight").val())+"&length="+encodeURIComponent($("#length").val())+"&width="+encodeURIComponent($("#width").val())+"&height="+encodeURIComponent($("#height").val())+"&_="+randomText(60),
                dataType: "json",
                type: "GET",
                success: function(data) {
                    if (data.status == "success"){
                        div.innerHTML = '<h3>'+data.results[0].Origin+' <i class="mdi mdi-chevron-right"></i> '+data.results[0].Destination+'</h3>\
                                <h4><b>'+data.results[0].Kg+' Kg</b></h4>\
                                <h1 class="text-themecolor"><b><?php echo Core::lang('currency_format')?> '+addCommas(data.results[0].Tariff)+'</b></h1><p><?php echo Core::lang('estimation')?>: '+data.results[0].Estimasi+' <?php echo Core::lang('days')?><br><?php echo Core::lang('minimum_weight')?>: '+data.results[0].Min_Kg+' Kg</p>';
                        $('#servicemode').text(data.results[0].Mode);
                        console.log(data.message);
                        that.on("submit", searchdata); /* add handler back after ajax */
                    } else {
                        div.innerHTML = '<h3>'+data.message+'</h3>';
                        console.log(data.message);
                        that.on("submit", searchdata); /* add handler back after ajax */
                    }
                },
                error: function(x, e) {}
            });            
        }
        /* Search tariff end */

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

        /* Load Default */
        function loadDefault(){
            $(function(){
                $('#mode').change(function(){
                    if (selectedOption() == '3'){
                        $('#ekubik').show();
                    } else {
                        $('#kubik').prop('checked', false);
                        $('#ekubik').hide();
                    }
                });
                $('#ekubik').hide();
            });
        }

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

        function closeCard(selectorid,todo=true){
            if (todo){
                var div = document.getElementById(selectorid);
                div.style.display = "none";
            } else {
                var div = document.getElementById(selectorid);
                div.style.display = "block";
            }
        }

        closeCard('floatcard');
        loadModeOption();
        loadDefault();
    </script>
</body>

</html>
