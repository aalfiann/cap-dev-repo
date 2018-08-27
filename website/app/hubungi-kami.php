<?php include 'app/Core.php';?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Anda dapat mengirim pesan kepada kami dengan mengisi form pesan ini. Kami dengan senang hati akan membantu Anda.">
<meta name="keywords" content="<?php echo Core::getInstance()->keyword?>">
<meta name="author" content="M ABD AZIZ ALFIAN (about.me/azizalfian)">
<?php include 'main-meta.php';?>

<!-- SITE TITLE -->
<title><?php echo Core::getInstance()->title?> - Hubungi Kami</title>

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
	
	
	<!-- =========================
		TOP MAIN NAVBAR
	============================== -->
	<div class="main-navbar main-navbar-1">
		<div class="container">
			<div class="row">
                 
				<!-- === TOP LOGO === -->
				 
				<div class="logo" id="main-logo">
					<div class="logo-text">
						CAP <span class="color-primary">Express</span>
					</div>
				</div>
				 
				<!-- === TOP SEARCH === -->
				 
				<div class="main-search-input" id="main-search-input">
					<form>
						<input type="text" id="main-search" name="main-search" placeholder="Try and type enter..." />
					</form>
				</div>
				 
				<div class="search-control">
					<!-- === top search button show === -->
					<a id="show-search" class="show-search latest" href="#">
						<div class="my-btn my-btn-primary">
                            <div class="my-btn-bg-top"></div>
                            <div class="my-btn-bg-bottom"></div>
                            <div class="my-btn-text">
                                <i class="fa fa-search"></i>
                            </div>
						</div>
					</a>
					<!-- === top search button close === -->
					<a id="close-search" class="close-search latest" href="#">
						<div class="my-btn my-btn-primary">
							<div class="my-btn-bg-top"></div>
							<div class="my-btn-bg-bottom"></div>
							<div class="my-btn-text">
								<i class="fa fa-close"></i>
							</div>
						</div>
					</a>
				</div>
				
				<div class="show-menu-control">
					<!-- === top search button show === -->
					<a id="show-menu" class="show-menu" href="#">
						<div class="my-btn my-btn-primary">
                            <div class="my-btn-bg-top"></div>
                            <div class="my-btn-bg-bottom"></div>
                            <div class="my-btn-text">
                                <i class="fa fa-bars"></i>
                            </div>
						</div>
					</a>
				</div>
				 
				<!-- === TOP MENU === -->
								 
				<div class="collapse navbar-collapse main-menu main-menu-1" id="main-menu">
					<ul class="nav navbar-nav">
											
						<!-- === top menu item === -->
						<li>
							<a href="index.php">Beranda</a>
						</li>
						<li class="main-menu-separator"></li>
						<!-- === top menu item === -->
						<li>
							<a href="tentang-kami.php">Tentang Kami</a>
						</li>
						<li class="main-menu-separator"></li>
						<!-- === top menu item === -->
						<li>
							<a href="app/modul-info-tariff.php">Info Tariff</a>
						</li>
						<li class="main-menu-separator"></li>
						<!-- === top menu item === -->
						<li class="active">
							<a class="latest" href="hubungi-kami.php">Hubungi Kami</a>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</div>
	 
	 <!-- =========================
		END TOP MAIN NAVBAR
	============================== -->
     
	 
	<!-- ===================================
		PAGE HEADER
	======================================== -->
	<div class="page-header" data-stellar-background-ratio="0.4">
		<div class="page-header-overlay"></div>
		<div class="container">
			<div class="row">
				
				<!-- === PAGE HEADER TITLE === -->
				<div class="page-header-title">
					<h2>HUBUNGI KAMI</h2>
				</div>
				
				<!-- === PAGE HEADER BREADCRUMB === -->
				<div class="page-header-breadcrumb">
					<ol class="breadcrumb">
						<li><a href="index.html">Beranda</a></li>
						<li class="active">HUBUNGI KAMI</li>
					</ol>
				</div>
				
				
			</div>
		</div>
	</div>
	<!-- ===================================
		END PAGE HEADER
	======================================== -->
	<?php include 'main-tracking.php';?>
	<!-- =========================
		CONTACTS
	============================== -->
    <div class="def-section">
		<div class="container">
			<div class="row">
				
				<!-- === CONTACTS INFO === -->
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="contacts-info">
						<div class="contacts-info-title">
							<div class="contacts-info-title-icon">
								<i class="fa fa-envelope"></i>
							</div>
							<h3>Hubungi kami kapan saja</h3>
						</div>
						<div class="contacts-info-text">
							Anda dapat mengirim pesan kepada kami dengan mengisi form pesan ini. Kami dengan senang hati akan membantu Anda. 
						</div>
						
					</div>
				</div>
				
				<!-- === CONTACTS FORM === -->
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
					<div class="contacts-form row">
						<div class="send-result"></div>
						<form name="contact-form" id="contact-form" method="POST" action="javascript:void(null);" onsubmit="sendmail_2();">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 contacts-form-item">
								<input type="text" name="contact-name" placeholder="Nama Lengkap" />
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 contacts-form-item">
								<input type="text" name="contact-email" placeholder="Email" />
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 contacts-form-item">
								<input type="text" name="contact-phone" placeholder="Phone" />
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 contacts-form-item">
								<input type="text" name="contact-site" placeholder="Website" />
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contacts-form-item">
								<textarea name="contact-message" placeholder="Apa yang dapat kami bantu?"></textarea>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contacts-form-item contacts-form-button">
								<button><span class="my-btn my-btn-grey">
									<span class="my-btn-bg-top"></span>
									<span class="my-btn-bg-bottom"></span>
									<span class="my-btn-text">
										KIRIM PESAN
									</span>
								</span></button>
							</div>
						</form>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
	
	<!-- =========================
		CONTACTS DETAILS
	============================== -->
    <div class="def-section contact-details">
		<div class="container">
			<div class="row">
				
				<!-- === CONTACTS DETAILS ITEM === -->
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 contact-detail">
					<div class="contact-detail-icon">
						<i class="flaticon-map58"></i>
					</div>
					<div class="contact-detail-title">
						<h3>ALAMAT</h3>
					</div>
					<div class="contact-detail-text">
						Jl. Manggarai Utara VIII F2B No.8 RT.08 RW.01 <br>Tebet Jakarta Selatan<br> 12850
					</div>
				</div>
				
				<!-- === CONTACTS DETAILS ITEM === -->
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 contact-detail contact-detail-mark">
					<div class="contact-detail-icon">
						<i class="flaticon-telephone5"></i>
					</div>
					<div class="contact-detail-title">
						<h3>TELEPON | EMAIL</h3>
					</div>
					<div class="contact-detail-text">
						+6221 8290569<br>cs@cap-express.co.id
					</div>
				</div>
				
				<!-- === CONTACTS DETAILS ITEM === -->
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 contact-detail">
					<div class="contact-detail-icon">
						<i class="flaticon-clock96"></i>
					</div>
					<div class="contact-detail-title">
						<h3>JAM OPERASIONAL</h3>
					</div>
					<div class="contact-detail-text">
						Senin - Jum'at : 08.00 - 21.00<br>Sabtu : 09.00 - 14.00
					</div>
				</div>
			
			</div>
		</div>
	</div>
	<!-- =========================
		END CONTACTS DETAILS
	============================== -->
	
	
	<!-- =========================
		CONTACTS MAP
	============================== -->
    <div class="contact-map" id="contact-map">
	</div>
	<!-- =========================
		END CONTACTS MAP
	============================== -->
	
	<?php include 'main-motto.php';?>
	
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

	<!-- GOOGLE MAPS API -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAHDFaUVFTKqrrUtBXubJbrUxKKq-t8Fw&amp;callback=initMap" async defer></script>
	
</body>
</html>