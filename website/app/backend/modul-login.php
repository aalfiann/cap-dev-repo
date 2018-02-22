<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});?>
<!DOCTYPE html>
<html lang="<?php echo Core::getInstance()->setlang?>">

<head>
    <?php include_once 'global-meta.php';?>
    <title><?php echo Core::lang('login')?> - <?php echo Core::getInstance()->title?></title>
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
                    <?php 
                        if (isset($_POST['submitlogin'])){
                            $post_array = array(
                            	'Username' => $_POST['username'],
                            	'Password' => $_POST['password'],
                                'Rememberme' => (!empty($_POST['remember'])?$_POST['remember']:'')
                            );
                            Core::login(Core::getInstance()->api.'/user/login',$post_array);
                        }
                    ?>
                    <form class="form-horizontal form-material" id="loginform" action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <h3 class="box-title m-b-20"><?php echo Core::lang('login')?></h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input name="username" class="form-control" type="text" required="" placeholder="<?php echo Core::lang('username')?>"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input name="password" class="form-control" type="password" required="" placeholder="<?php echo Core::lang('password')?>"> </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 font-14">
                                <div class="checkbox checkbox-primary pull-left p-t-0">
                                    <input name="remember" id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup"> <?php echo Core::lang('remember_me')?> </label>
                                </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> <?php echo Core::lang('forgot_password')?></a> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button name="submitlogin" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"><?php echo Core::lang('login')?></button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
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