<?php 
spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$group = Core::getUserGroup();
if( $group > '2' && ($group != '6' || $group != '7') ) {Core::goToPage('modul-user-profile.php');exit;}?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>
    <!-- chartist CSS -->
    <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <title><?php echo Core::lang('chart').' '.Core::lang('transaction')?> - <?php echo Core::getInstance()->title?></title>
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
                    <h3 class="text-themecolor"><?php echo Core::lang('chart').' '.Core::lang('transaction')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('report')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('chart')?></li>
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
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-row">
                                <div class="p-2 display-5 text-themecolor"><i class="mdi mdi-chart-line"></i> <span id="agent_rate_shipping">0%</span></div>
                                <div class="p-2">
                                    <h3 class="m-b-0"><?php echo Core::lang('agent_rate_shipping')?></h3></div>
                                </div>
                                <hr>
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td><?php echo Core::lang('agent_gross_profit')?></td>
                                        <td class="font-medium"><span id="agent_gross_profit">0</span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Core::lang('agent_total_onprocess')?></td>
                                        <td class="font-medium"><span id="agent_total_onprocess">0</span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Core::lang('agent_total_success')?></td>
                                        <td class="font-medium"><span id="agent_total_success">0</span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Core::lang('agent_total_failed')?></td>
                                        <td class="font-medium"><span id="agent_total_failed">0</span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Core::lang('agent_total_return')?></td>
                                        <td class="font-medium"><span id="agent_total_return">0</span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Core::lang('agent_total_void')?></td>
                                        <td class="font-medium"><span id="agent_total_void">0</span></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Core::lang('agent_total_waybill')?></td>
                                        <td class="font-medium"><span id="agent_total_waybill">0</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- column -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo Core::lang('chart').' '.Core::lang('data').' '.Core::lang('agent_gross_profit')?> - <?php echo date('Y')?></h3>
                                <hr>
                                <div id="firstchart" class="ct-sm-line-chart" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <div class="col-lg-12"><?php echo Core::getMessage('success',Core::lang('notice_cache_onehour'),Core::lang('notice_cache_clear'))?></div>
                    <div class="col-lg-12"><?php echo Core::getMessage('warning',"",Core::lang('agent_notice_chart'))?></div>
                </div>
                <!-- Row -->
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
    <!-- chartist chart -->
    <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <script>
        $.when(
            $.ajax({ /* Get file statistic start */
				type: "GET",
				url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/report/branch/data/summary/'.date('Y').'/'.$datalogin['username'].'/'.$datalogin['token'])?>")+"?_="+randomText(60),
				dataType: "json",
				success: function( data ) {
				    document.getElementById("agent_rate_shipping").innerHTML="0%";
                    document.getElementById("agent_gross_profit").innerHTML="0";
                    document.getElementById("agent_total_onprocess").innerHTML="0";
                    document.getElementById("agent_total_success").innerHTML="0";
                    document.getElementById("agent_total_failed").innerHTML="0";
                    document.getElementById("agent_total_return").innerHTML="0";
                    document.getElementById("agent_total_void").innerHTML="0";
                    document.getElementById("agent_total_waybill").innerHTML="0";
					if(data.status=="success"){
					    document.getElementById("agent_gross_profit").innerHTML=addCommas(data.result[0].gross_profit);
                        document.getElementById("agent_rate_shipping").innerHTML=data.result[0].percent_up+"%";
                        document.getElementById("agent_total_onprocess").innerHTML=data.result[0].on_process;
                        document.getElementById("agent_total_success").innerHTML=data.result[0].success;
                        document.getElementById("agent_total_failed").innerHTML=data.result[0].failed;
                        document.getElementById("agent_total_return").innerHTML=data.result[0].returned;
                        document.getElementById("agent_total_void").innerHTML=data.result[0].void;
                        document.getElementById("agent_total_waybill").innerHTML=data.result[0].total;
					} else {
					    document.getElementById("agent_rate_shipping").innerHTML="0%";
                        document.getElementById("agent_gross_profit").innerHTML="0";
                        document.getElementById("agent_total_onprocess").innerHTML="0";
                        document.getElementById("agent_total_success").innerHTML="0";
                        document.getElementById("agent_total_failed").innerHTML="0";
                        document.getElementById("agent_total_return").innerHTML="0";
                        document.getElementById("agent_total_void").innerHTML="0";
                        document.getElementById("agent_total_waybill").innerHTML="0";
					}
				},
				error: function( xhr, textStatus, error ) {
				    console.log("XHR: " + xhr.statusText);
					console.log("STATUS: "+textStatus);
					console.log("ERROR: "+error);
				    console.log("TRACE: "+xhr.responseText);
				}
			})
		).then(function( summary ) {});

        //Simple line chart 
        $.when(
            $.ajax({ /* Get gross profit chart start */
				type: "GET",
				url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/cargo/report/branch/data/chart/'.date('Y').'/'.$datalogin['username'].'/'.$datalogin['token'])?>")+"?_="+randomText(60),
                dataType: "json"
			})
        ).then(function( grossc ) {
            var datalabels = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
            var gross = [null,null,null,null,null,null,null,null,null,null,null,null];

            if(grossc.status=="success"){
                gross = grossc.results.series[0];
			}

            new Chartist.Line('#firstchart', {
                labels: datalabels,
                series: [
                    gross
                ]
            },
            {
                fullWidth: true,
                plugins: [
                    Chartist.plugins.tooltip()
                ],
                showArea: true,
                chartPadding: {
                    right: 40
                }
            });
            
        });
    </script>
</body>

</html>
