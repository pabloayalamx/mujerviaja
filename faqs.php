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
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/faqs.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>FAQs</h1>
				<p>"Las preguntas más frecuentes de nuestros clientes"</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">

			<div class="main_title">
				<h2>"<span>Cuando se quiere saber una cosa, </span> lo mejor que se puede hacer es preguntarla"</h2>
				<p><span>Georges Duhamel</span> (1884-1966) Escritor francés.</p>
			</div>

			<div id="bg_profile">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">¿Somos una empresa confiable?<i class="indicator icon_minus_alt2 pull-right"></i></a>
                                  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in">
									<div class="panel-body">
										Desafortunadamente existen muchas agencias que se dedican a estafar a la gente. Para identificar un sitio web engañoso basta con preguntar si la agencia tiene SECTUR,
										si esta afiliada a alguna organización como la Asociación Mexicana de Agencia de Viajes, la CANACO Servytur u otra, si el sitio web es un sitio en el que se puede 
										pagar en línea con tarjeta es menos probable que tenga un problema. Nosotros somos parte de la AMAV, CANACO, estamos registrados ante SECTUR y tenemos un portal con todas 
										medidas de seguridad para que compres con confianza en línea.
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">¿Dónde estan ubicados?<i class="indicator icon_plus_alt2 pull-right"></i></a>
                                  </h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse">
									<div class="panel-body">
										Estamos ubicados en la ciudad de Cancún Q.Roo en la Av. Miguel Hidalgo Num 346 SM71 MZ5 LT26
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">¿Puedo cancelar una compra que hice?<i class="indicator icon_plus_alt2 pull-right"></i></a>
                                  </h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse">
									<div class="panel-body">
										Desde luego que sí, te recomendamos visitar nuestros términos y condiciones que hablan acerca de las cancelaciones. Para mas información da clic en el siguiente enlace:
										<a href="terminos-condiciones">Ver términos y condiciones</a>	
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end col -->
				</div>
				<!-- End row -->

				<hr>

				<div class="row text-center">
					<div class="col-md-6">
						<div class="box_style_3">
							<i class="icon_set_1_icon-17"></i>
							<h3>Atención a clientes</h3>
							<p>Si quieres escribirnos solo da clic en el botón.</p>
							<a href="contacto" class="btn_1">Create a Ticket</a>
						</div>
					</div>
					<!-- end col -->

					<div class="col-md-6">
						<div class="box_style_3">
							<i class="icon_set_1_icon-90"></i>
							<h3>Call center</h3>
							<p>Si tienes dudas, llámanos. Estamos para tenderte.</p>
							 <a href="tel:+<?php echo $myWebSite["telefono"]; ?>" class="btn_1">Call Now</a>
						</div>
					</div>
					<!-- end col -->
				</div>
				<!-- end row -->
			</div>
			<!-- End bg_profile -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div class="container margin_60">
		<div class="banner">
			<h3>¿Estás listo para tener la mejor aventura? Conoce nuestros tours, reserva con tiempo y paga poco a poco.</h3>
			<a href="experiencias" class="btn_1 white">Ver experiencias ahora</a>
		</div>
		<!-- end banner -->
	</div>
	<!-- end container -->

	<footer><?php include("templates/footer.php"); ?></footer>
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

</body>

</html>