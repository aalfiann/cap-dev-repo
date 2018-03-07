<!-- =========================
		 SCRIPTS   
	============================== -->	
	
	<!-- JQUERY -->
	<script src="js/jquery-1.11.3.min.js"></script>
	
	<!-- BOOTSTRAP -->
	<script src="js/bootstrap.min.js"></script>
	
	<!-- SMOOTH SCROLLING  -->
	<script src="js/smoothscroll.min.js"></script>
	
	<!-- STELLAR.JS FOR PARALLAX -->
	<script src="js/jquery.stellar.min.js"></script>
	
	<!-- SLIDER PRO  -->
	<script src="assets/slider-pro/js/jquery.sliderPro.min.js"></script>
	
	<!-- SCROLLSPY -->
	<script src="js/scrollspy.min.js"></script>
	
	<!-- WOW PLAGIN -->
	<script src="js/wow.min.js"></script>
	
	<!-- CAROUSEL -->
	<script src="assets/owl-carousel/owl.carousel.min.js"></script>
	
	<!-- VERTICAL ACCORDEON MENU -->
	<script src="js/metisMenu.min.js"></script>
	
	<!-- CUSTOM SCRIPT -->
	<script src="js/theme.js"></script>

	<!--Google Analytics-->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo Core::getInstance()->googleanalytics?>', 'auto');
		ga('send', 'pageview');
	</script>