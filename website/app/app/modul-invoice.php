<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$group = Core::getUserGroup();
if( $group > '2' && ($group != '6' && $group != '7') ) {Core::goToPage('modul-user-profile.php');exit;}
// BranchID
$urlbranchid = Core::getInstance()->api.'/enterprise/user/data/branch/'.$datalogin['username'];
$databranchid = json_decode(Core::execGetRequest($urlbranchid));
// Param
$fd = (empty($_GET['fd'])?'':$_GET['fd']);
$ld = (empty($_GET['ld'])?'':$_GET['ld']);
$s = (empty($_GET['s'])?'':$_GET['s']);?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('invoice')?> - <?php echo Core::getInstance()->title?></title>
    <!-- Date picker plugins css -->
    <link href="<?php echo Core::getInstance()->assetspath?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                    <h3 class="text-themecolor"><?php echo Core::lang('invoice')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('data')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('invoice')?></li>
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
                <!-- Search Box -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="firstdate" class="hidden-md-up"><?php echo Core::lang('firstdate')?> :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="firstdate" placeholder="<?php echo Core::lang('firstdate')?>. Format: yyyy-mm-dd" value="<?php echo $fd?>">
                                    <span class="input-group-addon"><i class="icon-calender" id="fdcall"></i></span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 hidden-md-up"><br></div>

                            <div class="col-md-3">
                                <label for="lastdate" class="hidden-md-up"><?php echo Core::lang('lastdate')?> :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="lastdate" placeholder="<?php echo Core::lang('lastdate')?>. Format: yyyy-mm-dd" value="<?php echo $ld?>">
                                    <span class="input-group-addon"><i class="icon-calender" id="ldcall"></i></span>
                                </div>
                            </div>

                            <div class="col-md-6 hidden-md-up"><br></div>
                            
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="searchdt" type="text" class="form-control" placeholder="<?php echo Core::lang('input_search')?>" value="<?php echo $s?>">
                                    <span class="input-group-btn">
                                        <button id="submitsearchdt" onclick="loadData('#datamain','1',selectedOption(),document.getElementById('firstdate').value,document.getElementById('lastdate').value,document.getElementById('searchdt').value);" class="btn btn-themecolor" type="button"><?php echo Core::lang('search')?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('data').' '.Core::lang('invoice')?></h3><hr>
                            <div class="table-responsive m-t-40">
                                    <a href="modul-invoice-create.php" class="btn btn-inverse"><i class="mdi mdi-plus"></i> <?php echo Core::lang('add').' '.Core::lang('invoice')?></a>
                                    <table id="datamain" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?php echo Core::lang('tb_no')?></th>
                                                <th class="not-export-col"><?php echo Core::lang('manage')?></th>
                                                <th><?php echo Core::lang('invoice_id')?></th>
                                                <th><?php echo Core::lang('customer_id')?></th>
                                                <th><?php echo Core::lang('invoice_name')?></th>
                                            	<th><?php echo Core::lang('invoice_name_company')?></th>
                                                <th><?php echo Core::lang('invoice_phone')?></th>
                                                <th><?php echo Core::lang('invoice_email')?></th>
                                                <th><?php echo Core::lang('invoice_term')?></th>
                                                <th><?php echo Core::lang('invoice_tax')?></th>
                                                <th><?php echo Core::lang('invoice_total')?></th>
                                                <th><?php echo Core::lang('invoice_due_date')?></th>
                                                <th><?php echo Core::lang('status')?></th>
                                                <th><?php echo Core::lang('tb_created_at')?></th>
                                                <th><?php echo Core::lang('tb_username')?></th>
                                                <th><?php echo Core::lang('tb_updated_at')?></th>
                                                <th><?php echo Core::lang('tb_updated_by')?></th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th><?php echo Core::lang('tb_no')?></th>
                                                <th class="not-export-col"><?php echo Core::lang('manage')?></th>
                                                <th><?php echo Core::lang('invoice_id')?></th>
                                                <th><?php echo Core::lang('customer_id')?></th>
                                                <th><?php echo Core::lang('invoice_name')?></th>
                                            	<th><?php echo Core::lang('invoice_name_company')?></th>
                                                <th><?php echo Core::lang('invoice_phone')?></th>
                                                <th><?php echo Core::lang('invoice_email')?></th>
                                                <th><?php echo Core::lang('invoice_term')?></th>
                                                <th><?php echo Core::lang('invoice_tax')?></th>
                                                <th><?php echo Core::lang('invoice_total')?></th>
                                                <th><?php echo Core::lang('invoice_due_date')?></th>
                                                <th><?php echo Core::lang('status')?></th>
                                                <th><?php echo Core::lang('tb_created_at')?></th>
                                                <th><?php echo Core::lang('tb_username')?></th>
                                                <th><?php echo Core::lang('tb_updated_at')?></th>
                                                <th><?php echo Core::lang('tb_updated_by')?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <hr>
                                <div id="pagination"></div>

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
    <?php include_once 'global-datatables.php';?>
    <!-- Date Picker Plugin JavaScript -->
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script>
        /** 
         * Create event enter key on search (Pure JS)
         * Usage: button id in search element must be set to submitsearchdt
         */
        document.getElementById("searchdt").addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                document.getElementById("submitsearchdt").click();
            }
        });

        /** 
         * Create event select change index on select option (Pure JS)
         * Usage: textbox id in search element must be set to searchdt
         */
        function changeOption(idtable) {
            var selectBox = document.getElementById("selectoptdt");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            loadData(idtable,'1',selectedValue,document.getElementById('firstdate').value,document.getElementById('lastdate').value,document.getElementById('searchdt').value);
        }

        /** 
         * Get selected option value for search (Pure JS)
         * Usage: don't do anything, this is depends on paginateDatatables function
         */
        function selectedOption(){
            var selection = document.getElementById("selectoptdt") !== null;
            if (selection){
                var selectBox = document.getElementById("selectoptdt");
                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                return selectedValue;
            } else {
                return "10";
            }
        }
        
        /** 
         * Custom paginate data from datatables (Pure JS)
         *
         * @param selector is ID element to write html pagination
         * @param idtable is ID element of your datatables
         * @param itemperpage is how many item data will shows per pages
         * @param pagenow is current active page
         * @param pagetotal is how many total page in your records
         *
         * Why use custom paginate datatables:
         * - Mostly company has pagination system on their api json or response data which is they use custom json format
         *
         * Usage:
         * - Because this is called from function loadData(idtable,page="1",itemperpage="10",search=""), so you have to take a look how loadData function works before modifying this
         * - Language inside is using Core::lang PHP class
         */
        function paginateDatatables(selector,idtable,itemperpage,pagenow,pagetotal,firstdate,lastdate,search){
            var div = document.getElementById(selector);
            var data = '<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">\
                    <div class="btn-group mr-2" role="group" aria-label="First group"><p><?php echo Core::lang('dt_shows_page')?> '+pagenow+' <?php echo Core::lang('dt_of')?> '+pagetotal+'</p></div>\
                    <div class="btn-group mr-2" role="group" aria-label="Second group">';
                data += '<select id="selectoptdt" onchange="changeOption(\''+idtable+'\');" class="form-control custom-select mr-3">\
                        <option value="10"'+((itemperpage == '10')?' selected':'')+'>10</option>\
                        <option value="50"'+((itemperpage == '50')?' selected':'')+'>50</option>\
                        <option value="100"'+((itemperpage == '100')?' selected':'')+'>100</option>\
                        <option value="250"'+((itemperpage == '250')?' selected':'')+'>250</option>\
                        <option value="500"'+((itemperpage == '500')?' selected':'')+'>500</option>\
                        <option value="1000"'+((itemperpage == '1000')?' selected':'')+'>1000</option>\
                    </select>';
            if (pagenow <= pagetotal){
                    /* Middle Pagination = If this page + 2 < total page */
                    if ((pagenow + 2) < pagetotal && pagenow >= 3){
                        data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary hidden-sm-down mr-2"><i class="mdi mdi-skip-backward"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        for (p=(pagenow-2);p<=(pagenow+2);p++){
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                    /* Last Pagination = total page >= 5 and if this page + 2 >= total page */
                    else if ((pagenow + 2) >= pagetotal && pagetotal >= 5){
                        if ((pagenow-1)>0){
                            data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=(pagetotal-4);p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        if (pagenow<pagetotal){
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                        }
                    }
                    /* Last Pagination = total page < 5 and if this page + 2 >= total page */
                    else if ((pagenow + 2) >= pagetotal && pagetotal < 5){
                        if ((pagenow-1)>0){
                            data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=(pagetotal-(pagetotal-1));p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        if (pagenow<pagetotal){
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                        }
                    }
                    /* First pagination and if total page <= 5 */
                    else if (pagetotal <= 5) {
                        if ((pagenow-1)>0){
                            if ((pagenow-1)>1) data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=1;p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                    /* First pagination and if total page > 5 */
                    else if (pagetotal > 5 && pagenow <=2) {
                        if ((pagenow-1)>0){
                            if ((pagenow-1)>1) data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=1;p<=5;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+firstdate+'\',\''+lastdate+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                }
            data += '</div></div>';
            div.innerHTML = data;
        }
        
        /** 
         * Load data to datatables (jQuery)
         * 
         * @param idtable is ID element of your datatables
         * @param page is the number to be use to call data url api. (only required to handle custom pagination)
         * @param itemperpage is the number to be use to call data url api. (only required to handle custom pagination)
         * @param search is the query to search data to be use to call data url api. (only required to handle custom pagination)
         *
         * Usage: Want to learn, Go to >> https://datatables.net/examples/ 
         */
        function loadData(idtable,page="1",itemperpage="10",firstdate="",lastdate="",search=""){
            $(function() {
                if (firstdate == '') firstdate = document.getElementById('firstdate').value;
                if (lastdate == '') lastdate = document.getElementById('lastdate').value;
                if (search == ''){
                    $(document).attr("title", "[<?php echo Core::lang('data').' '.Core::lang('invoice')?>]-["+firstdate+"]-["+lastdate+"]");
                } else {
                    $(document).attr("title", "[<?php echo Core::lang('data').' '.Core::lang('invoice')?>]-["+firstdate+"]-["+lastdate+"]-"+search);
                }
                /* Make sure there is no datatables with same id */
                if ($.fn.DataTable.isDataTable(idtable)) {
                    $(idtable).DataTable().destroy();
                }
                /* Choose columns index for printing purpose */
                var selectCol = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16 ];
                /* Built table is here */
                var table = $(idtable).DataTable({
                    ajax: {
                        type: "GET",
                        url: "<?php echo Core::getInstance()->api.'/invoice/data/index/keywords/'.$datalogin['username'].'/'.$datalogin['token'].'/"+page+"/"+itemperpage+"/?firstdate="+firstdate+"&lastdate="+lastdate+"&keywords=\"BranchID\":\"'.$databranchid->result->BranchID?>\"&query="+encodeURIComponent(search),
                        cache: false,
                        dataSrc: function (json) {  /* You can handle json response data here */
                            if (json.status == "success"){
                                paginateDatatables("pagination",idtable,json.metadata.items_per_page,json.metadata.page_now,json.metadata.page_total,firstdate,lastdate,search); /* Remove or comment this line if you don't want to use custom pagination */
                                return json.results;
                            } else {
                                document.getElementById("pagination").innerHTML = ""; /* Remove or comment this line if you don't want to use custom pagination */
                                return [];
                            }
                        }
                    },
                    columns: [
                        { "render": function(data,type,row,meta) { /* render event defines the markup of the cell text */
                                var a =  meta.row + 1 + ((meta.settings.json.metadata.page_now-1)*meta.settings.json.metadata.items_per_page); /* row object contains the row data */
                                return a;
                            } 
                        },
                        { "render": function(data,type,row,meta) { /* render event defines the markup of the cell text */ 
                                var a = '<a href="modul-invoice-edit.php?no='+row.InvoiceID+'&ref=modul-invoice.php&fd='+firstdate+'&ld='+lastdate+'&s='+search+'"><i class="mdi mdi-pencil-box-outline"></i> <?php echo Core::lang('edit')?></a> | <a href="print-invoice.php?no='+row.InvoiceID+'&ref=modul-invoice.php&fd='+firstdate+'&ld='+lastdate+'&s='+search+'"><i class="mdi mdi-printer"></i> <?php echo Core::lang('print')?></a> | <a href="print-invoice.php?no='+row.InvoiceID+'&ref=modul-invoice.php&fd='+firstdate+'&ld='+lastdate+'&s='+search+'&item_id=<?php echo Core::lang('invoice_po')?>"><i class="mdi mdi-printer"></i> <?php echo Core::lang('print').' '.Core::lang('invoice_id_po')?></a>'; /* row object contains the row data */
                                return a;
                            } 
                        },
                        { data: "InvoiceID" },
                        { data: "Custom_id.CustomerID" },
                        { data: "To_name" },
                        { data: "To_name_company" },
                        { data: "To_phone" },
                        { data: "To_email" },
                        { data: "Term" },
                        { data: "Custom_field.Tax_rate"},
                        { data: "Total" },
                        { data: "Due_date" },
                        { data: "Status" },
                        { data: "Created_at" },
                        { data: "Created_by" },
                        { data: "Updated_at" },
                        { data: "Updated_by" }
                    ],
                    bFilter: true,
                    paging:   false,
                    info: false,
                    processing: true,
                    language: {
                        lengthMenu: "<?php echo Core::lang('dt_display')?>",
                        zeroRecords: "<?php echo Core::lang('dt_not_found')?>",
                        info: "<?php echo Core::lang('dt_info')?>",
                        infoEmpty: "<?php echo Core::lang('dt_info_empty')?>",
                        infoFiltered: "<?php echo Core::lang('dt_filtered')?>",
                        decimal: "",
                        emptyTable: "<?php echo Core::lang('dt_table_empty')?>",
                        infoPostFix: "",
                        thousands: "<?php echo Core::lang('dt_thousands')?>",
                        loadingRecords: "<?php echo Core::lang('dt_loading')?>",
                        processing: "<?php echo Core::lang('dt_process')?>",
                        search: "<?php echo Core::lang('dt_search')?>"
                    },
                    dom: "Bfrtip",
                    stateSave: true,
                    buttons: [
                        {
                            extend: "copy",
                            text: "<i class=\"mdi mdi-content-copy\"></i> Copy",
                            className: "bg-theme",
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        }, {
                            extend: "csv",
                            text: "<i class=\"mdi mdi-file-document\"></i> CSV",
                            className: "bg-theme",
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        }, {
                            extend: "excel",
                            text: "<i class=\"mdi mdi-file-excel\"></i> Excel",
                            className: "bg-theme",
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        }, {
                            extend: "pdf",
                            text: "<i class=\"mdi mdi-file-pdf\"></i> PDF",
                            className: "bg-theme",
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        }, {
                            extend: "print",
                            text: "<i class=\"mdi mdi-printer\"></i> Print",
                            className: "bg-theme",
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        }, {
                            extend: 'colvis',
                            text: "Hide/Show Collumn <i class=\"mdi mdi-chevron-down\"></i>",
                            className: "bg-secondary",
                            columns: selectCol
                        }
                    ]
                });
            });
        }

        $('#firstdate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            ignoreReadonly: true,
            allowInputToggle: true
        }).on('hide', function(e) {
            $(this).prop('readonly', false);
        });

        $('#lastdate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            ignoreReadonly: true,
            allowInputToggle: true
        }).on('hide', function(e) {
            $(this).prop('readonly', false);
        });

        $('#fdcall').on('click',function(){
            $('#firstdate').prop('readonly', true); 
            $('#firstdate').trigger('focus');
        });

        $('#ldcall').on('click',function(){
            $('#lastdate').prop('readonly', true); 
            $('#lastdate').trigger('focus');
        });

        /**
         * Get date or convert date to string
         *
         * @param date is the date. If empty will get today's date.
         * 
         * @return string with yyyy-mm-dd format.
         */
        function getDate(date='') {
            if (date == '') date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth()+1).toString();
            var dd  = date.getDate().toString();
            var mmChars = mm.split('');
            var ddChars = dd.split('');
            return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
        }
        <?php 
            if (empty($fd) && empty($ld)){
                echo '$(function(){
                    $("#firstdate").val(getDate());
                    $("#lastdate").val(getDate());
                });';
                echo '/* Load data from datatables onload */
                loadData("#datamain","1","10",getDate(),getDate());';
            } else {
                echo '/* Load data from datatables onload */
                loadData("#datamain","1","10","'.$fd.'","'.$ld.'","'.$s.'");';
            }
        ?>

    </script>
</body>

</html>
