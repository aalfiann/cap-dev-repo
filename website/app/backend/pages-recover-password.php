<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'global-meta.php';?>
    <title>Admin Press Admin Template - The Ultimate Bootstrap 4 Admin Template</title>
</head>

<body>
    <?php include_once 'global-preloader.php';?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">        
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="index.html">
                    <h3 class="box-title m-b-20">Recover Password</h3>
                    <div class="form-group ">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                      </div>
                    </div>
                  </form>
            </div>
          </div>
        </div>
        
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <?php include_once 'global-js.php';?>
</body>

</html>