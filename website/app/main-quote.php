<!-- ===================================
		SECTION ABOUT US AND GET QUOTE
	======================================== -->
	<section class="def-section about-quote">
		<div class="section-bg-left"></div>
		<div class="section-bg-right"></div>
		<div class="container">
			<div class="row">
				
				<!-- === ABOUT US === -->	
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 home-about">
						
						<!-- === TITLE GROUP === -->	
						<div class="title-group">
							<h2>TENTANG KAMI</h2>
							<div class="subtitle with-square"><?php echo Core::getInstance()->title?> - Courier and Cargo</div>
						</div>
						
						<!-- === ABOUT US TEXT === -->	
						<p>
						<?php echo Core::getInstance()->title?> (PT. Cipta Amanah Persada) memberikan pelayanan pengiriman kurir dengan Sistem Pelayanan Kurir 24 jam sesuai keinginan Anda.
						</p>
						
						<div class="home-about-video">
							<!-- === PLAY VIDEO BUTTON === -->	
							<div class="play-video" id="play-video">
								<div class="my-btn my-btn-primary">
									<div class="my-btn-bg-top"></div>
									<div class="my-btn-bg-bottom"></div>
									<div class="my-btn-text">
										<i class="fa fa-play"></i>
									</div>
								</div>
							</div>
							<!-- === STOP VIDEO BUTTON === -->	
							<div class="stop-video" id="stop-video">
								<div class="my-btn my-btn-primary">
									<div class="my-btn-bg-top"></div>
									<div class="my-btn-bg-bottom"></div>
									<div class="my-btn-text">
										<i class="fa fa-pause"></i>
									</div>
								</div>
							</div>
							
							<!-- === VIDEO === -->	
							<video id="aboutvideo" loop="loop" preload="auto">
								<source src="media/video/trucks.mp4" />
								<source src="media/video/trucks.webm" type="video/webm" />
							</video>
							
							<!-- === READ MORE BUTTON === -->	
							<a href="tentang-kami.php"><div class="home-about-button">
								<div class="my-btn my-btn-primary">
									<div class="my-btn-bg-top"></div>
									<div class="my-btn-bg-bottom"></div>
									<div class="my-btn-text">
										SELENGKAPNYA
									</div>
								</div>
							</div></a>

						</div>
				</div>
				
				<!-- === GET QUOTE === -->	
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 get-quote">
						
						<!-- === TITLE GROUP === -->
						<div class="title-group">
							<h2>BOOKING CARGO</h2>
							<div class="subtitle with-square">Pesan jadwal pengiriman</div>
						</div>
						
						<!-- === GET QUOTE TEXT === -->
						<p>
							Anda dapat memesan lebih awal jadwal pengiriman cargo dengan mengisi form di bawah ini.
						</p>
						
						<!-- === GET QUOTE FORM=== -->
						<div class="get-quote-form">
						<div class="send-result"></div>
							<form name="gq-form" id="gq-form" method="POST" action="javascript:void(null);" onsubmit="sendmail_1();">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 get-quote-form-left">
									<!-- === GET QUOTE FORM ITEM === -->
									<div class="form-item">
										<input type="text" name="gq-location" id="gq-location" placeholder="KOTA ASAL" />
									</div>
									<!-- === GET QUOTE FORM ITEM === -->
									<div class="form-item">
										<input type="text" name="gq-person" id="gq-person" placeholder="PERSONAL/CARGO" />
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 get-quote-form-right">
									<!-- === GET QUOTE FORM ITEM === -->
									<div class="form-item">
										<input type="text" name="gq-destination" id="gq-destination" placeholder="TUJUAN" />
									</div>
									<!-- === GET QUOTE FORM ITEM === -->
									<div class="form-item">
										<input type="text" name="gq-contact" id="gq-contact" placeholder="E-MAIL" />
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 get-quote-form-bottom">
									<!-- === GET QUOTE FORM ITEM === -->
									<div class="form-item">
										<textarea name="gq-text" id="gq-text" placeholder="PESAN ANDA"></textarea>
									</div>
									<!-- === GET QUOTE FORM BUTTON === -->
									<div class="get-quote-form-button">
										<button id="gq-submit"><span class="my-btn my-btn-grey">
											<span class="my-btn-bg-top"></span>
											<span class="my-btn-bg-bottom"></span>
											<span class="my-btn-text">
												BOOKING
											</span>
										</span></button>
									</div>
								</div>
							</form>
						</div>
				</div>

			</div>
		</div>
	</section>
	 <!-- ===================================
		END SECTION ABOUT US AND GET QUOTE
	======================================== -->