<?php include 'app/Core.php';?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo Core::getInstance()->description?>">
<meta name="keywords" content="<?php echo Core::getInstance()->keyword?>">
<meta name="author" content="M ABD AZIZ ALFIAN (about.me/azizalfian)">
<?php include 'main-meta.php';?>

<!-- SITE TITLE -->
<title><?php echo Core::getInstance()->title?> - Jasa Pengiriman Barang Murah</title>

<!-- =========================
      FAV AND TOUCH ICONS  
============================== -->
<link rel="shortcut icon" href="img/favicon.ico">

<!-- =========================
     STYLESHEETS   
============================== -->

<!-- STYLES FILE -->   
<link href="css/master.css" rel="stylesheet">	
        
<!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

	<!-- =========================
     PRE LOADER       
	============================== -->
	
    <div class="preloader" id="preloader">
        <div class="cssload-container">
        	<div class="cssload-whirlpool"></div>
        </div>
    </div>
	
	<!-- =========================
     END PRE LOADER       
	============================== -->
	
    <?php include 'main-top.php';?>
	
	<?php include 'main-slider.php';?>
     
	<?php include 'main-services.php';?>
	
	<?php include 'main-quote.php';?>
	
    <?php include 'main-reviews.php';?>
	
	<?php include 'main-stats.php';?>
     
	<?php include 'main-clients.php';?>
	 
	<?php include 'main-subscribe.php';?>
     
	<?php include 'main-footer.php';?>

	<?php include 'main-small-menu.php';?>

	<!-- =========================
	   BLACK OVERLAY
	============================== -->
	<div class="black-overlay" id="black-overlay"></div>
	<!-- =========================
	   END BLACK OVERLAY
	============================== -->
     
	<?php include 'main-js.php';?>
	
</body>
</html>