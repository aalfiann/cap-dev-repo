<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
if(Core::getUserGroup() > '2') {Core::goToPage('modul-user-profile.php');exit;}
// Data Status
$urlstatus = Core::getInstance()->api.'/enterprise/company/data/status/'.$datalogin['token'];
$datastatus = json_decode(Core::execGetRequest($urlstatus));?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('data').' '.Core::lang('branch')?> - <?php echo Core::getInstance()->title?></title>
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
                    <h3 class="text-themecolor"><?php echo Core::lang('data').' '.Core::lang('branch')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('master')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('data').' '.Core::lang('branch')?></li>
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
                    <div class="col-md-12 col-12 align-self-center">
                        <div class="input-group">
                            <input id="searchdt" type="text" class="form-control" placeholder="<?php echo Core::lang('input_search')?>">
                            <span class="input-group-btn">
                                <button id="submitsearchdt" onclick="loadData('#datamain','1',selectedOption(),document.getElementById('searchdt').value);" class="btn btn-themecolor" type="button"><?php echo Core::lang('search')?></button>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div id="report-updatedata"></div>
                        <div class="card">
                            <div class="card-body">
                            <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('data').' '.Core::lang('branch')?></h3><hr>
                            <div class="table-responsive m-t-40">
                                    <a href="#" data-toggle="modal" data-target=".addnew" class="btn btn-inverse"><i class="mdi mdi-plus"></i> <?php echo Core::lang('add').' '.Core::lang('branch')?></a>
                                    <!-- modal content -->
                                    <div class="modal fade addnew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-plus"></i> <?php echo Core::lang('add').' '.Core::lang('branch')?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <form class="form-horizontal form-material" id="addnewdata" action="#">
                                                    <div class="modal-body">
                                                        <div id="report-newdata"></div>
                                                        <div class="form-group">
                                                            <label class="col-md-12"><?php echo Core::lang('branchid')?> <span class="text-danger">*</span></label>
                                                             <div class="col-md-12">
                                                                <input id="branchid" type="text" class="form-control form-control-line" required>
                                                                <span class="help-block text-danger branchid"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12"><?php echo Core::lang('name')?> <span class="text-danger">*</span></label>
                                                             <div class="col-md-12">
                                                                <input id="name" type="text" class="form-control form-control-line" required>
                                                                <span class="help-block text-danger name"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12"><?php echo Core::lang('address')?> <span class="text-danger">*</span></label>
                                                             <div class="col-md-12">
                                                                <textarea id="address" type="text" rows="3" style="resize: vertical;" class="form-control form-control-line" required></textarea>
                                                                <span class="help-block text-danger address"></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-12"><?php echo Core::lang('phone')?> <span class="text-danger">*</span></label>
                                                                     <div class="col-md-12">
                                                                        <input id="phone" type="text" class="form-control form-control-line" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                                        <span class="help-block text-danger phone"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-12"><?php echo Core::lang('fax')?></label>
                                                                        <div class="col-md-12">
                                                                            <input id="fax" type="text" class="form-control form-control-line" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-12"><?php echo Core::lang('email')?></label>
                                                                    <div class="col-md-12">
                                                                        <input id="email" type="email" class="form-control form-control-line">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-12"><?php echo Core::lang('owner')?></label>
                                                                     <div class="col-md-12">
                                                                        <input id="owner" type="text" class="form-control form-control-line">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-12"><?php echo Core::lang('pic')?></label>
                                                                        <div class="col-md-12">
                                                                            <input id="pic" type="text" class="form-control form-control-line">
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-12"><?php echo Core::lang('tin')?></label>
                                                                    <div class="col-md-12">
                                                                        <input id="tin" type="text" class="form-control form-control-line">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>
                                                        <button id="submitbtn" type="submit" class="btn btn-success"><?php echo Core::lang('submit')?></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                    <table id="datamain" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?php echo Core::lang('tb_no')?></th>
                                                <th><?php echo Core::lang('branchid')?></th>
                                                <th><?php echo Core::lang('name')?></th>
                                            	<th><?php echo Core::lang('address')?></th>
                                                <th><?php echo Core::lang('phone')?></th>
                                                <th><?php echo Core::lang('fax')?></th>
                                                <th><?php echo Core::lang('email')?></th>
                                                <th><?php echo Core::lang('owner')?></th>
                                                <th><?php echo Core::lang('pic')?></th>
                                                <th><?php echo Core::lang('tin')?></th>
                                                <th><?php echo Core::lang('status')?></th>
                                                <th><?php echo Core::lang('tb_created_at')?></th>
                                                <th><?php echo Core::lang('tb_username')?></th>
                                                <th><?php echo Core::lang('tb_updated_at')?></th>
                                                <th><?php echo Core::lang('tb_updated_by')?></th>
                                                <th class="not-export-col"><?php echo Core::lang('manage')?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th><?php echo Core::lang('tb_no')?></th>
                                                <th><?php echo Core::lang('branchid')?></th>
                                                <th><?php echo Core::lang('name')?></th>
                                            	<th><?php echo Core::lang('address')?></th>
                                                <th><?php echo Core::lang('phone')?></th>
                                                <th><?php echo Core::lang('fax')?></th>
                                                <th><?php echo Core::lang('email')?></th>
                                                <th><?php echo Core::lang('owner')?></th>
                                                <th><?php echo Core::lang('pic')?></th>
                                                <th><?php echo Core::lang('tin')?></th>
                                                <th><?php echo Core::lang('status')?></th>
                                                <th><?php echo Core::lang('tb_created_at')?></th>
                                                <th><?php echo Core::lang('tb_username')?></th>
                                                <th><?php echo Core::lang('tb_updated_at')?></th>
                                                <th><?php echo Core::lang('tb_updated_by')?></th>
                                                <th class="not-export-col"><?php echo Core::lang('manage')?></th>
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
            loadData(idtable,'1',selectedValue,document.getElementById('searchdt').value);
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
        function paginateDatatables(selector,idtable,itemperpage,pagenow,pagetotal,search){
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
                        data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary hidden-sm-down mr-2"><i class="mdi mdi-skip-backward"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        for (p=(pagenow-2);p<=(pagenow+2);p++){
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                    /* Last Pagination = total page >= 5 and if this page + 2 >= total page */
                    else if ((pagenow + 2) >= pagetotal && pagetotal >= 5){
                        if ((pagenow-1)>0){
                            data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=(pagetotal-4);p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        if (pagenow<pagetotal){
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                        }
                    }
                    /* Last Pagination = total page < 5 and if this page + 2 >= total page */
                    else if ((pagenow + 2) >= pagetotal && pagetotal < 5){
                        if ((pagenow-1)>0){
                            data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=(pagetotal-(pagetotal-1));p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        if (pagenow<pagetotal){
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                        }
                    }
                    /* First pagination and if total page <= 5 */
                    else if (pagetotal <= 5) {
                        if ((pagenow-1)>0){
                            if ((pagenow-1)>1) data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=1;p<=pagetotal;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
                    }
                    /* First pagination and if total page > 5 */
                    else if (pagetotal > 5 && pagenow <=2) {
                        if ((pagenow-1)>0){
                            if ((pagenow-1)>1) data += '<button onclick="loadData(\''+idtable+'\',\'1\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary mr-2 hidden-sm-down"><i class="mdi mdi-skip-backward"></i></button>';
                            data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow-1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-previous"></i></button>';
                        }
                        for (p=1;p<=5;p++)
                        {
                            data += '<button '+((p == pagenow)?'class="btn btn-themecolor disabled"':'onclick="loadData(\''+idtable+'\',\''+p+'\',\''+itemperpage+'\',\''+search+'\');" class="btn btn-secondary"')+' type="button">'+p+'</button>';
                        }
                        data += '<button onclick="loadData(\''+idtable+'\',\''+(pagenow+1)+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary"><i class="mdi mdi-skip-next"></i></button>';
                        data += '<button onclick="loadData(\''+idtable+'\',\''+pagetotal+'\',\''+itemperpage+'\',\''+search+'\');" type="button" class="btn btn-secondary ml-2 hidden-sm-down"><i class="mdi mdi-skip-forward"></i></button>';
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
        function loadData(idtable,page="1",itemperpage="10",search=""){
            $(function() {
                /* Make sure there is no datatables with same id */
                if ($.fn.DataTable.isDataTable(idtable)) {
                    $(idtable).DataTable().destroy();
                }
                /* Choose columns index for printing purpose */
                var selectCol = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ];
                /* Built table is here */
                var table = $(idtable).DataTable({
                    ajax: {
                        type: "GET",
                        url: "<?php echo Core::getInstance()->api.'/enterprise/company/data/search/'.$datalogin['username'].'/'.$datalogin['token'].'/"+page+"/"+itemperpage+"/?query="+encodeURIComponent(search)+"'?>",
                        cache: false,
                        dataSrc: function (json) {  /* You can handle json response data here */
                            if (json.status == "success"){
                                paginateDatatables("pagination",idtable,json.metadata.items_per_page,json.metadata.page_now,json.metadata.page_total,search); /* Remove or comment this line if you don't want to use custom pagination */
                                return json.results;
                            } else {
                                document.getElementById("pagination").innerHTML = ""; /* Remove or comment this line if you don't want to use custom pagination */
                                return [];
                            }
                        }
                    },
                    columns: [
                        { "render": function(data,type,row,meta) { /* render event defines the markup of the cell text */
                                var a =  meta.row + meta.settings._iDisplayStart + 1 + ((meta.settings.json.metadata.page_now-1)*meta.settings.json.metadata.items_per_page); /* row object contains the row data */
                                return a;
                            } 
                        },
                        { "render": function(data,type,row,meta) { /* render event defines the markup of the cell text */
                                return row.BranchID.toUpperCase();
                            } 
                        },
                        { data: "Name" },
                        { data: "Address" },
                        { data: "Phone" },
                        { data: "Fax" },
                        { data: "Email" },
                        { data: "Owner" },
                        { data: "PIC" },
                        { data: "TIN" },
                        { data: "Status" },
                        { data: "Created_at" },
                        { data: "Username" },
                        { data: "Updated_at" },
                        { data: "Updated_by" },
                        { "render": function(data,type,row,meta) { /* render event defines the markup of the cell text */ 
                                var $select = $('<select id="status'+row.BranchID+'" type="text" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" class="form-control form-control-line"><?php if (!empty($datastatus)) {
                                        foreach ($datastatus->results as $name => $valuestatus) {
                                            echo '<option value="'.$valuestatus->{'StatusID'}.'">'.$valuestatus->{'Status'}.'</option>';
                                        }
                                    }?></select>');
                                $select.find('option[value="'+row.StatusID+'"]').attr('selected', 'selected');
                                var b = $select[0].outerHTML;
                                var a = '<a href="#" data-toggle="modal" data-target=".'+row.BranchID+'"><i class="mdi mdi-pencil-box-outline"></i> <?php echo Core::lang('edit')?></a>'; /* row object contains the row data */
                                a += '<!-- terms modal content -->\
                                    <div class="modal fade '+row.BranchID+'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">\
                                        <div class="modal-dialog modal-lg">\
                                            <div class="modal-content">\
                                                <div class="modal-header">\
                                                    <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-plus"></i> <?php echo Core::lang('update').' '.Core::lang('branch')?></h4>\
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>\
                                                </div>\
                                                <form class="form-horizontal form-material" id="data'+row.BranchID+'" action="<?php echo $_SERVER['PHP_SELF']?>">\
                                                    <div class="modal-body">\
                                                        <div class="row">\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('branch')?></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="branch'+row.BranchID+'" type="text" class="form-control form-control-line" value="'+row.BranchID.toUpperCase()+'" readonly>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('status')?></label>\
                                                                    <div class="col-md-12">';
                                    a += b;
                                    a +=                            '</div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="form-group">\
                                                            <label class="col-md-12"><?php echo Core::lang('name')?> <span class="text-danger">*</span></label>\
                                                             <div class="col-md-12">\
                                                                <input id="name'+row.BranchID+'" type="text" class="form-control form-control-line" value="'+row.Name+'" required>\
                                                                <span class="help-block text-danger name'+row.BranchID+'"></span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="form-group">\
                                                            <label class="col-md-12"><?php echo Core::lang('address')?> <span class="text-danger">*</span></label>\
                                                             <div class="col-md-12">\
                                                                <textarea id="address'+row.BranchID+'" type="text" rows="3" style="resize: vertical;" class="form-control form-control-line" required>'+row.Address+'</textarea>\
                                                                <span class="help-block text-danger address'+row.BranchID+'"></span>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row">\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('phone')?> <span class="text-danger">*</span></label>\
                                                                     <div class="col-md-12">\
                                                                        <input id="phone'+row.BranchID+'" type="text" class="form-control form-control-line" value="'+row.Phone+'" oninput="if (/\\D/g.test(this.value)) this.value = this.value.replace(/\\D/g,\'\')" required>\
                                                                        <span class="help-block text-danger phone'+row.BranchID+'"></span>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('fax')?></label>\
                                                                        <div class="col-md-12">\
                                                                            <input id="fax'+row.BranchID+'" type="text" class="form-control form-control-line" value="'+row.Fax+'" oninput="if (/\\D/g.test(this.value)) this.value = this.value.replace(/\\D/g,\'\')">\
                                                                        </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('email')?></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="email'+row.BranchID+'" type="email" class="form-control form-control-line" value="'+row.Email+'">\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row">\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('owner')?></label>\
                                                                     <div class="col-md-12">\
                                                                        <input id="owner'+row.BranchID+'" type="text" class="form-control form-control-line" value="'+row.Owner+'">\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('pic')?></label>\
                                                                        <div class="col-md-12">\
                                                                            <input id="pic'+row.BranchID+'" type="text" class="form-control form-control-line" value="'+row.PIC+'">\
                                                                        </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('tin')?></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="tin'+row.BranchID+'" type="text" class="form-control form-control-line" value="'+row.TIN+'">\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <div class="modal-footer">\
                                                        <div class="col-sm-12">\
                                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">\
                                                            <div class="btn-group mr-2" role="group" aria-label="First group">\
                                                                <button id="deletebtn'+row.BranchID+'" type="submit" onclick="deletedata(\''+row.BranchID+'\');return false;" class="btn btn-danger"><?php echo Core::lang('delete')?></button>\
                                                            </div>\
                                                            <div class="btn-group mr-2" role="group" aria-label="Second group">\
                                                                <button type="button" class="btn btn-default waves-effect text-left mr-2" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>\
                                                                <button id="updatebtn'+row.BranchID+'" type="submit" onclick="updatedata(\''+row.BranchID+'\');return false;" class="btn btn-success"><?php echo Core::lang('update')?></button>\
                                                            </div>\
                                                        </div>\
                                                        </div>\
                                                    </div>\
                                                </form>\
                                            </div>\
                                            <!-- /.modal-content -->\
                                        </div>\
                                        <!-- /.modal-dialog -->\
                                    </div>\
                                    <!-- /.modal -->';
                                return a;
                            } 
                        }
                    ],
                    bFilter: false,
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
        
        /* Load data from datatables onload */
        loadData('#datamain','1','10');

        /* Add new data start */
        $("#addnewdata").on("submit",sendnewdata);
        function sendnewdata(e){
            console.log("Process add new data...");
            e.preventDefault();

            if (!$.trim($("#name").val())){
                $(".help-block.text-danger.name").html("<br><small><?php echo Core::lang('input_required')?></small>");
                return false;
            } else if (!$.trim($("#address").val())){
                $(".help-block.text-danger.address").html("<br><small><?php echo Core::lang('input_required')?></small>");
                return false;
            } else if (validationRegex($("#phone").val(),"numeric") == false){
                $(".help-block.text-danger.phone").html("<br><small><?php echo Core::lang('val_numeric_html')?></small>");
                return false;
            }

            var that = $(this);
            that.off("submit"); /* remove handler */
            var div = document.getElementById("report-newdata");
            var btn = "submitbtn";
            disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise/company/data/new')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        BranchID: $("#branchid").val(),
                        Name: $("#name").val(),
                        Address: $("#address").val(),
                        Phone: $("#phone").val(),
                        Fax: $("#fax").val(),
                        Email: $("#email").val(),
                        Owner: $("#owner").val(),
                        PIC: $("#pic").val(),
                        TIN: $("#tin").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        div.innerHTML = "";
                        if (data.status == "success"){
                            div.innerHTML = messageHtml("success","<?php echo Core::lang('core_process_add').' '.Core::lang('branch').' '.Core::lang('status_success')?>");
                            /* clear from */
                            $("#addnewdata")
                            .find("input,textarea")
                            .val("")
                            .end()
                            .find("input[type=checkbox]")
                            .prop("checked", "")
                            .end();
                            console.log("<?php echo Core::lang('core_process_add').' '.Core::lang('branch').' '.Core::lang('status_success')?>");
                            $('#datamain').DataTable().ajax.reload(); /* reload data table */
                            that.on("submit", sendnewdata); /* add handler back after ajax */
                        } else {
                            div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_add').' '.Core::lang('branch').' '.Core::lang('status_failed')?>",data.message);
                            that.on("submit", sendnewdata); /* add handler back after ajax */
                        }
                    },
                    complete: function() {
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });   
            
        }
        /* Add new data end */

        /* Update data start */
        function updatedata(dataid){
            $(function() {
                console.log("Process update data...");
                var div = document.getElementById("report-updatedata");

                if (!$.trim($("#name"+dataid).val())){
                    $(".help-block.text-danger.name"+dataid).html("<br><small><?php echo Core::lang('input_required')?></small>");
                    return false;
                } else if (!$.trim($("#address"+dataid).val())){
                    $(".help-block.text-danger.address"+dataid).html("<br><small><?php echo Core::lang('input_required')?></small>");
                    return false;
                } else if (validationRegex($("#phone"+dataid).val(),"numeric") == false){
                    $(".help-block.text-danger.phone"+dataid).html("<br><small><?php echo Core::lang('val_numeric_html')?></small>");
                    return false;
                }

                var btn = "updatebtn"+dataid;
                disableClickButton(btn);

                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise/company/data/update')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        BranchID: dataid,
                        Name: $("#name"+dataid).val(),
                        Address: $("#address"+dataid).val(),
                        Phone: $("#phone"+dataid).val(),
                        Fax: $("#fax"+dataid).val(),
                        Email: $("#email"+dataid).val(),
                        Owner: $("#owner"+dataid).val(),
                        PIC: $("#pic"+dataid).val(),
                        TIN: $("#tin"+dataid).val(),
                        StatusID: $("#status"+dataid).val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        div.innerHTML = "";
                        if (data.status == "success"){
                            div.innerHTML = messageHtml("success","<?php echo Core::lang('core_process_update').' '.Core::lang('branch').' '.Core::lang('status_success')?>");
                            console.log("<?php echo Core::lang('core_process_update').' '.Core::lang('branch').' '.Core::lang('status_success')?>");
                            $('#datamain').DataTable().ajax.reload(); /* reload data table */
                            $('.'+dataid).modal('hide');
                        } else {
                            div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_update').' '.Core::lang('branch').' '.Core::lang('status_failed')?>",data.message);
                            $('.'+dataid).modal('hide');
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });
            });
        }
        /* Update data end */

        /* Delete data start */
        function deletedata(dataid){
            $(function() {
                console.log("Process delete data...");
                var div = document.getElementById("report-updatedata");
                var btn = "deletebtn"+dataid;
                disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise/company/data/delete')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        BranchID: dataid
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        div.innerHTML = "";
                        if (data.status == "success"){
                            div.innerHTML = messageHtml("success","<?php echo Core::lang('core_process_delete').' '.Core::lang('branch').' '.Core::lang('status_success')?>");
                            console.log("<?php echo Core::lang('core_process_delete').' '.Core::lang('branch').' '.Core::lang('status_success')?>");
                            $('#datamain').DataTable().ajax.reload(); /* reload data table */
                            $('.'+dataid).modal('hide');
                        } else {
                            div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_delete').' '.Core::lang('branch').' '.Core::lang('status_failed')?>",data.message);
                            $('.'+dataid).modal('hide');
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });
            });
        }
        /* Delete data end */

    </script>
</body>

</html>
