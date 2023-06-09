<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   

<head>
    <title>Demo 1 | BookingTrap</title>    
    <meta name="description" content="">
    <meta name="keywords" content="">	
    <?php include("templates/head.php"); ?>
</head>

<body>

    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1">
    <header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="tel:<?php echo $myWebSite["telefono"]; ?>" id="phone_top">
                    998 1403214</a>
                    <span id="opening"><?php echo nl2br($myWebSite["horario_atencion"]); ?></span>
                </div>
                <div class="col-md-6 col-sm-6 hidden-xs">

                </div>
            </div>
            <!-- End row -->
        </div>
        <!-- End container-->
    </div>
    <!-- End top line-->

    <div class="container">
        <div class="row">
                <h2 class="text-center">¿Estás listo para tener un sitio web profesional?</h2>
        </div>
    </div>
    <!-- container -->
</header>
<!-- End Header -->        
    </div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/contacto.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>BIENVENID@</h1>
				<p>"Sube el logo de tu agencia y ve como se vería tu sitio web programado por nosotros"</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>
		<div class="container">
			<div class="row">

				<aside class="col-md-3">
					<div class="box_style_2">
						<h4 class="nomargin_top">Información de contacto</h4>
						<p>
							Si decides que quieres vender en línea envianos un whatsapp al número:
							<br>
                                <a href="https://wa.link/3wgse1" target="_blank">998 140 32 14</a> 
							<br>
							<a href="mailto:quierovendermas@bookigntrap.com">quierovendermas@bookigntrap.com</a>
						</p>
					</div>
				</aside>
				<!--End aside -->

				<div class="col-md-9">
					<h3>Sube tu logo y visualiza en tiempo real como se vería tu sitio web</h3>
					<p class="text-danger">Recuerda: toda la información que verás en el demo es meramente para pruebas.</p>
					<div>
						<div id="message-contact"></div>
						<form method="post" action="assets/gracias.php" id="contactformB" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Nombre</label>
										<input type="text" class="form-control styled" id="name_contact" name="name_contact" placeholder="Nombre" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Apellido</label>
										<input type="text" class="form-control styled" id="lastname_contact" name="lastname_contact" placeholder="Apellido" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Email:</label>
										<input type="email" id="email_contact" name="email_contact" class="form-control styled" placeholder="Escribe tu email" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Teléfono:</label>
										<input type="number" id="phone_contact" name="phone_contact" class="form-control styled" placeholder="10 dígitos" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Logotipo:</label>
										<input type="file" name="archivo" id="archivo" class="form-control styled" placeholder="Haz clic para seleccionar tu logo">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<p>
										<input type="submit" value="Enviar" class="btn_1" id="submit-contact">
									</p>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- End col lg 9 -->
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<!-- <div id="map_contact"></div> -->
	<!-- end map-->


	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_close"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form>
	</div>
	<!-- End Search Menu -->

	<!-- COMMON SCRIPTS -->
	<?php include("templates/js.php") ?>

	<!-- SPECIFIC SCRIPTS -->
	<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/mapmarker.jquery.js"></script>
	<script type="text/javascript" src="js/mapmarker_func.jquery.js"></script> -->

</body>

</html>