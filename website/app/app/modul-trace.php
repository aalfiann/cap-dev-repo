<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$codeid = (empty($_GET['no'])?'':$_GET['no']);?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('trace').' '.Core::lang('waybill')?> - <?php echo Core::getInstance()->title?></title>
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
                    <h3 class="text-themecolor"><?php echo Core::lang('trace').' '.Core::lang('waybill')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('app')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('trace').' '.Core::lang('waybill')?></li>
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
                <!-- Search Box start -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        <div class="input-group">
                            <input id="search" type="text" class="form-control" placeholder="<?php echo Core::lang('trace_placeholder_waybill')?>" value="<?php echo $codeid?>">
                            <span class="input-group-btn">
                                <button id="submitsearchdt" onclick="getWaybill(document.getElementById('search').value);" class="btn btn-themecolor" type="button"><?php echo Core::lang('trace_go')?></button>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Search Box end -->
                <!-- ============================================================== -->
                <div id="errorinfo"></div>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div id="card1" class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <small class="text-muted pull-left"><?php echo Core::lang('waybill')?> </small>
                                    <h3 class="pull-right" id="hwaybill"></h3>
                            </div>
                            <div><hr></div>
                            <div class="card-body"> 
                                <small class="text-muted"><?php echo Core::lang('shipper_name')?> </small>
                                    <h6 id="shippername"></h6> 
                                <small class="text-muted p-t-10 db"><?php echo Core::lang('address')?></small>
                                <h6 id="shipperaddress"></h6>
                            </div>
                            <div><hr></div>
                            <div class="card-body"> <small class="text-muted"><?php echo Core::lang('consignee_name')?> </small>
                                <h6 id="consigneename"></h6> 
                                <small class="text-muted p-t-10 db"><?php echo Core::lang('address')?></small>
                                <h6 id="consigneeaddress"></h6>
                            </div>
                            <div><hr></div>
                            <div class="card-body"> <small class="text-muted"><?php echo Core::lang('route_shipment')?> </small>
                                <h6 id="route"></h6> 
                                <small class="text-muted pull-left"><?php echo Core::lang('mode')?></small>
                                <h6 class="pull-right" id="routemode"></h6><br>
                                <small class="text-muted pull-left"><?php echo Core::lang('estimation')?></small>
                                    <h6 class="pull-right" id="routeestimation"></h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div id="card2" class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><?php echo Core::lang('shipment_history')?></a> </li>
                                <li class="nav-item"> <a class="nav-link" role="tab" id="hstatus"><span id="hrecipient"></span> <span id="hrelation"></span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <div id="trace" class="profiletimeline"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
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
    <script>
        function getWaybill(waybill){
            $(function(){
                clearData();
                var sources = "";
                if (waybill.indexOf('AGT') > -1) sources = "agent";
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo')?>")+sources+Crypto.decode("<?php echo base64_encode('/transaction/data/public/trace/simple/waybill/?apikey='.Core::getInstance()->apikey.'&lang='.Core::getInstance()->setlang.'&no=')?>")+encodeURIComponent(waybill)+"&_="+randomText(2),
                    dataType: "json",
                    type: "GET",
                    success: function(data) {
                        if (data.status == "success"){
                            console.log(data.message);
                            closeCard('card1',false);
                            closeCard('card2',false);
                            $('#hwaybill').html(data.result[0].Data.Waybill.toUpperCase());
                            $('#hstatus').html('>> '+ucwords(data.result[0].Log.Status)+(!$.isEmptyObject(data.result[0].POD.Recipient)?' >> '+data.result[0].POD.Recipient:'')+(!$.isEmptyObject(data.result[0].POD.Relation)?' ('+data.result[0].POD.Relation+')':''));
                            
                            //shipper
                            $('#shippername').html(ucwords(data.result[0].Consignor.Name));
                            $('#shipperaddress').html(data.result[0].Consignor.Address);

                            //consignee
                            $('#consigneename').html(ucwords(data.result[0].Consignee.Name));
                            $('#consigneeaddress').html(data.result[0].Consignee.Address);

                            //route
                            $('#routemode').html(ucwords(data.result[0].Route.Mode));
                            $('#route').html(ucwords(data.result[0].Route.Origin+" >> "+data.result[0].Route.Destination));
                            $('#routeestimation').html(data.result[0].Route.Estimation+"<?php echo Core::lang('days')?>");

                            //trace
                            $.each(data.result[0].Trace, function(index, value){
                                var icon = "";
                                if (value.StatusID == '19' || value.StatusID == '47'){icon = "close";} else {icon = "check";}
                                $('#trace').append('<div class="sl-item">\
                                            <div class="sl-left"><img src="../assets/images/icon/flat-'+icon+'.png" alt="user" class="img-circle" /> </div>\
                                            <div class="sl-right">\
                                                <div class="link">'+ucwords(value.Status)+' <span class="sl-date">'+formatDate(value.Created_at,true)+'</span>\
                                                    <p>'+value.Description+'</p>\
                                                </div>\
                                            </div>\
                                        </div>\
                                        <hr>');
                            });
                        } else {
                            console.log(data.message);
                            writeMessage('#errorinfo','danger',data.message);
                            closeCard('card1');
                            closeCard('card2');
                        }
                    },
                    error: function(x, e) {}
                }); 
            });    
        }

        function clearData(){
            $("#trace").html("");
            $('#errorinfo').html("");
            $('#hwaybill').html("");
            $('#hstatus').html("");
            //shipper
            $('#shippername').html("");
            $('#shipperaddress').html("");
            //consignee
            $('#consigneename').html("");
            $('#consigneeaddress').html("");
            //route
            $('#routemode').html("");
            $('#route').html("");
            $('#routeestimation').html("");
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

        $(function(){
            closeCard('card1');
            closeCard('card2');
            <?php 
                if (!empty($_GET['no'])){
                    echo 'getWaybill("'.$_GET['no'].'");';
                }
            ?>
        });
    </script>
</body>

</html>
