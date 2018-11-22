<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();
$group = Core::getUserGroup();
if($group > '2' && ($group != '6' && $group != '7')) {Core::goToPage('modul-user-profile.php');exit;}
// Data Status
$urlstatus = Core::getInstance()->api.'/enterprise_customer/option/data/status/'.$datalogin['token'];
$datastatus = json_decode(Core::execGetRequest($urlstatus));?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('data').' '.Core::lang('member')?> - <?php echo Core::getInstance()->title?></title>
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
                    <h3 class="text-themecolor"><?php echo Core::lang('data').' '.Core::lang('member')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('system')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('data')?></a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('customer')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('data').' '.Core::lang('member')?></li>
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
                                <h3 class="text-themecolor m-b-0 m-t-0"><?php echo Core::lang('data').' '.Core::lang('member')?></h3><hr>
                                <div class="table-responsive m-t-40">
                                    <a href="#" data-toggle="modal" data-target=".addnew" class="btn btn-inverse"><i class="mdi mdi-key-plus"></i> <?php echo Core::lang('add').' '.Core::lang('member')?></a>
                                    <!-- terms modal content -->
                                    <div class="modal fade addnew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-key-plus"></i> <?php echo Core::lang('add').' '.Core::lang('member')?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <form class="form-horizontal form-material" id="addnewdata" action="#">
                                                    <div class="modal-body">
                                                        <div id="report-newdata"></div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><?php echo Core::lang('name')?> <span class="text-danger">*</span></label>
                                                                        <input id="name" type="text" class="form-control form-control-line" title="<?php echo Core::lang('input_required')?>" required>
                                                                        <small id="errorname" class="form-text text-danger"></small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><?php echo Core::lang('name_alias')?></label>
                                                                        <input id="name_alias" type="text" class="form-control form-control-line">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label><?php echo Core::lang('address')?> <span class="text-danger">*</span></label>
                                                                <textarea id="address" type="text" rows="3" style="resize: vertical;" title="<?php echo Core::lang('input_required')?>" class="form-control form-control-line" required></textarea>
                                                                <small id="erroraddress" class="form-text text-danger"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><?php echo Core::lang('phone')?> <span class="text-danger">*</span></label>
                                                                        <input id="phone" type="text" class="form-control form-control-line" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label><?php echo Core::lang('fax')?></label>
                                                                        <input id="fax" type="text" class="form-control form-control-line" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label><?php echo Core::lang('email')?></label>
                                                                        <input id="email" type="text" class="form-control form-control-line">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label><?php echo Core::lang('discount')?> % <span class="text-danger">*</span></label>
                                                                        <input id="discount" type="text" class="form-control form-control-line" maxlength="7" oninput="if (/[^\d.]/g.test(this.value)) this.value = this.value.replace(/[^\d.]/g, '')" required>
                                                                        <small id="errordiscount" class="form-text text-danger"></small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label><?php echo Core::lang('admin_cost')?> <span class="text-danger">*</span></label>
                                                                        <input id="admin_cost" type="text" oninput="if (/[^\d.]/g.test(this.value)) this.value = this.value.replace(/[^\d.]/g,'')" class="form-control form-control-line" maxlength="10" required>
                                                                        <small id="erroradmin_cost" class="form-text text-danger"></small>
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
                                                <th><?php echo Core::lang('memberid')?></th>
                                                <th><?php echo Core::lang('name')?></th>
                                                <th><?php echo Core::lang('name_alias')?></th>
                                                <th><?php echo Core::lang('address')?></th>
                                                <th><?php echo Core::lang('phone')?></th>
                                                <th><?php echo Core::lang('fax')?></th>
                                                <th><?php echo Core::lang('email')?></th>
                                                <th><?php echo Core::lang('discount')?></th>
                                                <th><?php echo Core::lang('admin_cost')?></th>
                                                <th><?php echo Core::lang('status')?></th>
                                                <th><?php echo Core::lang('tb_created_at')?></th>
                                                <th><?php echo Core::lang('tb_created_by')?></th>
                                                <th><?php echo Core::lang('tb_updated_at')?></th>
                                                <th><?php echo Core::lang('tb_updated_by')?></th>
                                                <th class="not-export-col"><?php echo Core::lang('manage')?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th><?php echo Core::lang('tb_no')?></th>
                                                <th><?php echo Core::lang('memberid')?></th>
                                                <th><?php echo Core::lang('name')?></th>
                                                <th><?php echo Core::lang('name_alias')?></th>
                                                <th><?php echo Core::lang('address')?></th>
                                                <th><?php echo Core::lang('phone')?></th>
                                                <th><?php echo Core::lang('fax')?></th>
                                                <th><?php echo Core::lang('email')?></th>
                                                <th><?php echo Core::lang('discount')?></th>
                                                <th><?php echo Core::lang('admin_cost')?></th>
                                                <th><?php echo Core::lang('status')?></th>
                                                <th><?php echo Core::lang('tb_created_at')?></th>
                                                <th><?php echo Core::lang('tb_created_by')?></th>
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
         * Get selected option value for industry (Pure JS)
         */
        function selectedOptionIndustry(){
            var selection = document.getElementById("industry") !== null;
            if (selection){
                var selectBox = document.getElementById("industry");
                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                return selectedValue;
            } else {
                return "0";
            }
        }

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
                        url: "<?php echo Core::getInstance()->api.'/enterprise_customer/member/data/search/'.$datalogin['username'].'/'.$datalogin['token'].'/"+page+"/"+itemperpage+"/?query="+encodeURIComponent(search)+"'?>",
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
                                var a =  meta.row + 1 + ((meta.settings.json.metadata.page_now-1)*meta.settings.json.metadata.items_per_page); /* row object contains the row data */
                                return a;
                            } 
                        },
                        { data: "MemberID" },
                        { data: "Member_name" },
                        { data: "Member_name_alias" },
                        { data: "Address" },
                        { data: "Phone" },
                        { data: "Fax" },
                        { data: "Email" },
                        { data: "Discount" },
                        { data: "Admin_cost" },
                        { data: "Status" },
                        { data: "Created_at" },
                        { data: "Created_by" },
                        { data: "Updated_at" },
                        { data: "Updated_by" },
                        { "render": function(data,type,row,meta) { /* render event defines the markup of the cell text */ 
                                var a = '<a href="#" data-toggle="modal" data-target=".'+row.MemberID+'"><i class="mdi mdi-pencil-box-outline"></i> <?php echo Core::lang('edit')?></a>'; /* row object contains the row data */
                                
                                var $select = $('<select id="status'+row.MemberID+'" type="text" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" class="form-control form-control-line"><?php if (!empty($datastatus)) {
                                        foreach ($datastatus->results as $name => $valuestatus) {
                                            echo '<option value="'.$valuestatus->{'StatusID'}.'">'.$valuestatus->{'Status'}.'</option>';
                                        }
                                    }?></select>');
                                $select.find('option[value="'+row.StatusID+'"]').attr('selected', 'selected');
                                var b = $select[0].outerHTML;
                                
                                a += '<!-- terms modal content -->\
                                    <div class="modal fade '+row.MemberID+'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">\
                                        <div class="modal-dialog modal-lg">\
                                            <div class="modal-content">\
                                                <div class="modal-header">\
                                                    <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-key-plus"></i> <?php echo Core::lang('update').' '.Core::lang('member')?></h4>\
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>\
                                                </div>\
                                                <form class="form-horizontal form-material" id="data'+row.MemberID+'" action="<?php echo $_SERVER['PHP_SELF']?>">\
                                                    <div class="modal-body">\
                                                        <div class="row">\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('memberid')?></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="memberid'+row.MemberID+'" type="text" class="form-control form-control-line" title="<?php echo Core::lang('input_required')?>" value="'+row.MemberID+'" readonly>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('status')?></label>\
                                                                    <div class="col-md-12">';
                                a += b;
                                a +=                                    '<small id="errorstatus'+row.MemberID+'" class="form-text text-danger"></small>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row">\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('name')?> <span class="text-danger">*</span></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="name'+row.MemberID+'" type="text" class="form-control form-control-line" title="<?php echo Core::lang('input_required')?>" value="'+row.Member_name+'" required>\
                                                                        <small id="errorname'+row.MemberID+'" class="form-text text-danger"></small>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('name_alias')?></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="name_alias'+row.MemberID+'" type="text" class="form-control form-control-line" value="'+row.Member_name_alias+'">\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="form-group">\
                                                            <label class="col-md-12"><?php echo Core::lang('address')?> <span class="text-danger">*</span></label>\
                                                            <div class="col-md-12">\
                                                                <textarea id="address'+row.MemberID+'" type="text" rows="3" style="resize: vertical;" title="<?php echo Core::lang('input_required')?>" class="form-control form-control-line" required>'+row.Address+'</textarea>\
                                                                <small id="erroraddress'+row.MemberID+'" class="form-text text-danger"></small>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row">\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('phone')?> <span class="text-danger">*</span></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="phone'+row.MemberID+'" type="text" class="form-control form-control-line" oninput="if (/\\D/g.test(this.value)) this.value = this.value.replace(/\\D/g,\'\')" value="'+row.Phone+'" required>\
                                                                        <small id="errorphone'+row.MemberID+'" class="form-text text-danger"></small>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-6">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('fax')?></label>\
                                                                    <div class="col-md-12"">\
                                                                        <input id="fax'+row.MemberID+'" type="text" class="form-control form-control-line" oninput="if (/\\D/g.test(this.value)) this.value = this.value.replace(/\\D/g,\'\')" value="'+row.Fax+'">\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row">\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('email')?></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="email'+row.MemberID+'" type="text" class="form-control form-control-line" value="'+row.Email+'">\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('discount')?> % <span class="text-danger">*</span></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="discount'+row.MemberID+'" type="text" class="form-control form-control-line" maxlength="7" oninput="if (/[^\\d.]/g.test(this.value)) this.value = this.value.replace(/[^\\d.]/g, \'\')" value="'+row.Discount+'" required>\
                                                                        <small id="errordiscount'+row.MemberID+'" class="form-text text-danger"></small>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="col-md-12"><?php echo Core::lang('admin_cost')?> <span class="text-danger">*</span></label>\
                                                                    <div class="col-md-12">\
                                                                        <input id="admin_cost'+row.MemberID+'" type="text" oninput="if (/[^\\d.]/g.test(this.value)) this.value = this.value.replace(/[^\\d.]/g,\'\')" class="form-control form-control-line" maxlength="10" value="'+row.Admin_cost+'" required>\
                                                                        <small id="erroradmin_cost'+row.MemberID+'" class="form-text text-danger"></small>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <div class="modal-footer">\
                                                        <div class="col-sm-12">\
                                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">\
                                                            <div class="btn-group mr-2" role="group" aria-label="First group">\
                                                                <button id="deletebtn'+row.MemberID+'" type="submit" onclick="deletedata(\''+row.MemberID+'\');return false;" class="btn btn-danger"><?php echo Core::lang('delete')?></button>\
                                                            </div>\
                                                            <div class="btn-group mr-2" role="group" aria-label="Second group">\
                                                                <button type="button" class="btn btn-default waves-effect text-left mr-2" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>\
                                                                <button id="updatebtn'+row.MemberID+'" type="submit" onclick="updatedata(\''+row.MemberID+'\');return false;" class="btn btn-success"><?php echo Core::lang('update')?></button>\
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
                $("#errorname").html("<?php echo Core::lang('input_required')?>");
                return false;
            } else if (!$.trim($("#address").val())){
                $("#erroraddress").html("<?php echo Core::lang('input_required')?>");
                return false;
            } else if (validationRegex($("#phone").val(),"numeric") == false){
                $("#errorphone").html("<?php echo Core::lang('val_numeric_html')?>");
                return false;
            } else if (validationRegex($("#discount").val(),"decimal") == false){
                $("#errordiscount").html("<?php echo Core::lang('val_decimal_html')?>");
                return false;
            } else if (validationRegex($("#admin_cost").val(),"decimal") == false){
                $("#erroradmin_cost").html("<?php echo Core::lang('val_decimal_html')?></small>");
                return false;
            } else {
                $('#errorname').html('');
                $('#erroraddress').html('');
                $('#errorphone').html('');
                $('#errordiscount').html('');
                $('#erroradmin_cost').html('');
            }

            var that = $(this);
            that.off("submit"); /* remove handler */
            var div = document.getElementById("report-newdata");
            var btn = "submitbtn";
            disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise_customer/member/data/new')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        Name: $("#name").val(),
                        Alias: $("#name_alias").val(),
                        Address: $("#address").val(),
                        Phone: $("#phone").val(),
                        Fax: $("#fax").val(),
                        Email: $("#email").val(),
                        Discount: $("#discount").val(),
                        Admin_cost: $("#admin_cost").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        div.innerHTML = "";
                        if (data.status == "success"){
                            div.innerHTML = messageHtml("success","<?php echo Core::lang('core_process_add').' '.Core::lang('member').' '.Core::lang('status_success')?>");
                            /* clear from */
                            $("#addnewdata")
                            .find("input,textarea")
                            .val("")
                            .end();
                            console.log("<?php echo Core::lang('core_process_add').' '.Core::lang('member').' '.Core::lang('status_success')?>");
                            $('#datamain').DataTable().ajax.reload(); /* reload data table */
                            that.on("submit", sendnewdata); /* add handler back after ajax */
                        } else {
                            div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_add').' '.Core::lang('member').' '.Core::lang('status_failed')?>",data.message);
                            that.on("submit", sendnewdata); /* add handler back after ajax */
                        }
                    },
                    complete: function(){
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

                /* Validation */
                if (!$.trim($("#status"+dataid).val())){
                    $("#errorstatus"+dataid).html("<?php echo Core::lang('input_required')?>");
                    return false;
                } else if (!$.trim($("#name"+dataid).val())){
                    $("#errorname"+dataid).html("<?php echo Core::lang('input_required')?>");
                    return false;
                } else if (!$.trim($("#address"+dataid).val())){
                    $("#erroraddress"+dataid).html("<?php echo Core::lang('input_required')?>");
                    return false;
                } else if (validationRegex($("#phone"+dataid).val(),"numeric") == false){
                    $("#errorphone"+dataid).html("<?php echo Core::lang('val_numeric_html')?>");
                    return false;
                } else if (validationRegex($("#discount"+dataid).val(),"decimal") == false){
                    $("#errordiscount"+dataid).html("<?php echo Core::lang('val_decimal_html')?>");
                    return false;
                } else if (validationRegex($("#admin_cost"+dataid).val(),"double") == false){
                    $("#erroradmin_cost"+dataid).html("<?php echo Core::lang('val_double_html')?></small>");
                    return false;
                }

                var btn = "updatebtn"+dataid;
                disableClickButton(btn);

                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise_customer/member/data/update')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        Name: $("#name"+dataid).val(),
                        Alias: $("#name_alias"+dataid).val(),
                        Address: $("#address"+dataid).val(),
                        Phone: $("#phone"+dataid).val(),
                        Fax: $("#fax"+dataid).val(),
                        Email: $("#email"+dataid).val(),
                        Discount: $("#discount"+dataid).val(),
                        Admin_cost: $("#admin_cost"+dataid).val(),
                        StatusID: $("#status"+dataid).val(),
                        MemberID: dataid
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        div.innerHTML = "";
                        if (data.status == "success"){
                            div.innerHTML = messageHtml("success","<?php echo Core::lang('core_process_update').' '.Core::lang('member').' '.Core::lang('status_success')?>");
                            console.log("<?php echo Core::lang('core_process_update').' '.Core::lang('member').' '.Core::lang('status_success')?>");
                            $('#datamain').DataTable().ajax.reload(); /* reload data table */
                            $('.'+dataid).modal('hide');
                        } else {
                            div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_update').' '.Core::lang('member').' '.Core::lang('status_failed')?>",data.message);
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
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/enterprise_customer/member/data/delete')?>"),
                    data : {
                        Username: "<?php echo $datalogin['username']?>",
                        Token: "<?php echo $datalogin['token']?>",
                        MemberID: dataid
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        div.innerHTML = "";
                        if (data.status == "success"){
                            div.innerHTML = messageHtml("success","<?php echo Core::lang('core_process_delete').' '.Core::lang('member').' '.Core::lang('status_success')?>");
                            console.log("<?php echo Core::lang('core_process_delete').' '.Core::lang('member').' '.Core::lang('status_success')?>");
                            $('#datamain').DataTable().ajax.reload(); /* reload data table */
                            $('.'+dataid).modal('hide');
                        } else {
                            div.innerHTML = messageHtml("danger","<?php echo Core::lang('core_process_delete').' '.Core::lang('member').' '.Core::lang('status_failed')?>",data.message);
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
