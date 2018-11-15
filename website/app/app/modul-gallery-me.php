<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php include_once 'global-meta.php';?>    
    <title><?php echo Core::lang('gallery_image_me')?> - <?php echo Core::getInstance()->title?></title>
    <!--alerts CSS -->
    <link href="<?php echo Core::getInstance()->assetspath?>/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
                    <h3 class="text-themecolor"><?php echo Core::lang('gallery_image_me')?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?php echo Core::lang('app')?></a></li>
                        <li class="breadcrumb-item active"><?php echo Core::lang('gallery_image_me')?></li>
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
            <div id="infomsg"></div>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Search Box -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6">
                                <button id="uploadbtn" data-toggle="modal" data-target=".addnew" class="btn btn-inverse" type="button"><i class="mdi mdi-cloud-upload"></i> <?php echo Core::lang('gallery_image_remote_upload')?></button>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="searchdt" type="text" class="form-control" placeholder="<?php echo Core::lang('input_search')?>">
                                    <span class="input-group-btn">
                                        <button id="submitsearchdt" onclick="searchPost();" class="btn btn-themecolor" type="button"><?php echo Core::lang('search')?></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- terms modal content -->
                <div class="modal fade addnew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-themecolor" id="myLargeModalLabel"><i class="mdi mdi-cloud-upload"></i> <?php echo Core::lang('gallery_image_remote_upload')?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <form class="form-horizontal form-material" id="addnewdata" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div id="report-newdata"></div>
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo Core::lang('gallery_image_url')?> <span class="text-danger">*</span></label>
                                        <div class="col-md-12">
                                            <input id="imageurl" placeholder="<?php echo Core::lang('gallery_image_url_placehold')?>" type="text" class="form-control form-control-line" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo Core::lang('gallery_image_title')?></label>
                                        <div class="col-md-12">
                                            <input id="title" type="text" placeholder="<?php echo Core::lang('gallery_image_title_placehold')?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><?php echo Core::lang('description')?></label>
                                        <div class="col-md-12">
                                            <textarea id="description" rows="3" style="resize:vertical;" type="text" placeholder="<?php echo Core::lang('gallery_image_desc_placehold')?>" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>
                                    <button type="button" id="uploadbtn" onclick="remoteUpload();" class="btn btn-success"><?php echo Core::lang('upload_now')?></button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div id="reportmsg"></div>
                <div id="mylist" class="card-columns el-element-overlay"></div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button id="loadbtn" type="button" class="btn btn-themecolor" onclick="loadPost();"><?php echo Core::lang('loadmore')?></button>
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
    <!-- Sweet-Alert  -->
    <script src="<?php echo Core::getInstance()->assetspath?>/plugins/sweetalert/sweetalert.min.js"></script>
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

        /* Initial page for loadmore */
        var pages = 1;
        /* Initial item for loadmore */
        var items = 6;

        /* Load more Post */
        function loadPost(){
            $(function(){
                $('#mylist').show();
                var btn = "loadbtn";
                disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/imagehoster/imgur/data/index/'.$datalogin['username'].'/'.$datalogin['token'])?>")+"/"+pages+"/"+items+"/?query="+encodeURIComponent($('#searchdt').val()),
                    dataType: "json",
                    type: "GET",
                    cache: false,
                    success: function(data) {
                        if (data.status == "success"){
                            if( pages <= data.metadata.page_total){
                                $.each(data.results, function(index, value){
                                    $('#mylist').append('<div id="'+value.ID+'" class="card">\
                                            <div class="el-card-item">\
                                                <div class="el-card-avatar el-overlay-1">\
                                                    <a class="image-popup-vertical-fit" href="#"> <img class="lazyload" data-src="'+value.Link+'" alt="'+value.Title+'" /> </a>\
                                                </div>\
                                                <div class="el-card-content text-left">\
                                                    <div class="col-md-12">\
                                                        <small class="pull-right"><a class="text-danger" href="javascript:void(0)" onclick="deleteConfirmation(\''+value.ID+'\')" title="<?php echo Core::lang('delete').' '.Core::lang('image')?>"><?php echo Core::lang('delete')?></a></small>\
                                                        <h3 class="box-title">'+((value.Title == '' || value.Title == null)?value.ID:value.Title)+'</h3> <small><a href="'+value.Link+'" target="_blank">'+value.Link+'</a></small>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>');
                                });
                                if(pages == data.metadata.page_total) $('#loadbtn').hide();
                                pages = pages+1;
                            }
                            $('#reportmsg').empty();
                        } else {
                            $('#mylist').hide();
                            writeMessage('#reportmsg','danger',data.message);
                            $('#loadbtn').hide();
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });
            });
        }

        /* delete post */
        function deletePost(id){
            $(function(){
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/imagehoster/data/delete')?>"),
                    dataType: "json",
                    type: "POST",
                    data: {
                        Username: '<?php echo $datalogin['username']?>',
                        Token: '<?php echo $datalogin['token']?>',
                        ID: id
                    },
                    success: function(data) {
                        if (data.status == "success"){
                            writeMessage('#reportmsg','success',data.message);
                            $('#'+id).remove();
                            swal({
                                title: "<?php echo Core::lang('image').' '.Core::lang('deleted')?>",
                                text: data.message,
                                type: "success"
                            });
                        } else {
                            writeMessage('#reportmsg','danger',data.message);
                            swal({
                                title: "<?php echo Core::lang('image').' '.Core::lang('deleted')?>",
                                text: data.message,
                                type: "error"
                            });
                        }
                    },
                    error: function(x, e) {}
                });
            });
        }


        function deleteConfirmation(dataid){
            $(function() {
                swal({   
                    title: "<?php echo Core::lang('are_u_sure')?>",   
                    text: "<?php echo Core::lang('deleted_file_warning')?>",
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "<?php echo Core::lang('delete_yes')?>",
                    cancelButtonText: "<?php echo Core::lang('cancel')?>",
                    closeOnConfirm: false 
                }, function(){
                    deletePost(dataid);
                });
            });
        }
        
        /* search post */
        function searchPost(){
            $(function(){
                pages = 1;
                $('#loadbtn').show();
                $('#mylist').empty();
                loadPost();
            });
        }

        /* upload */
        function remoteUpload(){
            $(function(){
                var btn = "uploadbtn";
                disableClickButton(btn);
                $.ajax({
                    url: Crypto.decode("<?php echo base64_encode(Core::getInstance()->api.'/imagehoster/imgur/upload')?>"),
                    dataType: "json",
                    type: "POST",
                    data: {
                        Username: '<?php echo $datalogin['username']?>',
                        Token: '<?php echo $datalogin['token']?>',
                        Image: $('#imageurl').val(),
                        Title: $('#title').val(),
                        Description: $('#description').val()
                    },
                    success: function(data) {
                        if (data.status == "success"){
                            $("#addnewdata")
                            .find("input,textarea")
                            .val("")
                            .end();
                            writeMessage('#reportmsg','success',data.message);
                            searchPost();
                        } else {
                            writeMessage('#reportmsg','danger',data.message);
                        }
                    },
                    complete: function(){
                        disableClickButton(btn,false);
                    },
                    error: function(x, e) {}
                });
            });
        }

        /* Load Post */
        loadPost();
        writeMessage('#infomsg','secondary','<?php echo Core::lang('gallery_image_about')?>','<?php echo Core::lang('gallery_image_about_2')?>');
        setTimeout(function(){
            $('#infomsg').hide('slow');
        },10000)
    </script>
</body>

</html>
