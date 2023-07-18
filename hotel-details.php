<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 	
?>   
<head>
    <base href="<?php echo $fn->baseMeta(); ?>">
    <title>NOMBRE DEL HOTEL</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include("templates/head.php"); ?>
    
	<!-- SPECIFIC CSS -->
	<!-- <link href="css/date_time_picker.css" rel="stylesheet"> -->
	<link href="css/timeline.css" rel="stylesheet">
    
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?php echo $actividad->photos->header[0]->paths->original; ?>" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>NOMBRE DEL HOTEL</h1>
				<p>"NOMBRE DEL HOTEL" te espera para pasar las mejores vacaciones</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-8">

					<div class="owl-carousel owl-theme carousel_detail add_bottom_15">
						<div class="item"><img src="" alt="" height="422px"></div>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
						<!-- <li><a href="#tab_4" data-toggle="tab">Video</a></li> -->
                        <!-- <li><a href="#tab_2" data-toggle="tab">Reviews</a></li>
						<li><a href="#tab_3" data-toggle="tab">Map</a></li> -->
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab_1">
							<p>Descripcion del hotel</p>
							<div class="row">
								<div class="col-12">
                                    <h5 class="second_title tituloIncluyes col-sm-4">Incluye:</h5>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>Lo que incluye</h4>
										</div>
									</div>
								</div>
								<!-- End col -->

								<div class="col-12">
                                	<h5 class="second_title tituloIncluyes col-sm-4">No incluye:</h5>
									<div class="feature-box add_padding_bottom_5">
										<div class="feature-box-icon">
											<i class="icon-cancel-4 text-danger"></i>
										</div>
										<div class="feature-box-info">
											<h4>Lo que no incluye</h4>
										</div>
									</div>
								</div>						
                               
								<!-- End col -->
							</div>
							<!-- End row -->
						</div>
						<!-- End tab_1 -->

						<div class="tab-pane fade" id="tab_2">
							<div id="summary_review">
								<div class="review_score"><span>8,9</span>
								</div>
								<div class="review_score_2">
									<h4>Fabulous  <span>(Based on 34 reviews)</span></h4>
									<p>
										Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.
									</p>
								</div>
							</div>
							<!-- End review summary -->

							<div class="reviews-container">

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Admin – April 03, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Ahsan – April 01, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Sara – March 31, 2016:
										</div>
										<div class="rev-text">
											<p>
												Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

							</div>
							<!-- End review-container -->

							<hr>
						</div>
						<!-- End tab_2 -->


						<div class="tab-pane fade" id="tab_4">
                            <!-- youtube -->
						</div>
						<!-- End tab 4 -->                        
					</div>
					<!-- End tabs -->
				</div>
				<!-- End Col -->

				<aside class="col-md-4">
					<div class="box_style_1">
						<div class="price">
                            <small>Desde</small>
                            <strong>$ 125<small> MXN </small></strong>
							
							<br>
                            <small>por persona</small>
						</div>
						<small>*Selecciona una fecha para ver el precio vigente</small>
					</div>
					<div class="box_style_2">
						<h3>Reserva tu hotel<span>Confirmación inmediata</span></h3>
						<form method="post" action="datos-compra-civi" autocomplete="off">
							<input type="hidden" name="idactividad" value="">
							<input type="hidden" name="nombreActividad" value="">
							<input type="hidden" name="markup" value="">
							<input type="hidden" name="currency" value="">                
							<input type="hidden" name="imagen" value="">
							<input type="hidden" name="precioTotal" id="precioTotal" value="">	

							<div class="form-group">
								<label>Tipo de actividad</label>
								<select class="form-control" name="categoria" id="categoria" onchange="muestraPrecios(value)" required>
									<option value="0" disabled selected>Selecciona una opción</option>
								</select>
							</div>							
						
							<div class="form-group">
								<label>Fecha</label>
								<input type="text" name="fecha" id="fecha" class="form-control" required>	
							</div>		
							
							<div class="form-group">
								<label>Total a pagar</label>
								<input type="text" readonly class="form-control" id="total">
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn_full">Reserva ahora</button>
								<!-- <input type="submit" form="check_avail" value="Reserva ahora" class="btn_full" id="submit-booking"> -->
							</div> 							
						</form>
						<hr>
						<a href="tel:<?php echo $myWebSite["telefono"]; ?>" class="btn_outline"> ó contáctanos</a>
						<a href="tel:<?php echo $myWebSite["telefono"]; ?>" id="phone_2"><i class="icon_set_1_icon-91"></i><?php echo $myWebSite["telefono"]; ?></a>
					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div>
	</div>

	<br><br><br>
	<!-- End container -->

    <!-- Footer -->
    <footer><?php include("templates/footer.php"); ?></footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
    <?php include("templates/js.php") ?>

	<!-- SPECIFIC SCRIPTS -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

	<script src="js/sidebar_carousel_detail_page_func.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script>
	<script src="js/infobox.js"></script>

    <script></script>
</body>
</html>