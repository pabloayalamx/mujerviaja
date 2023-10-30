<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 
?>   

<head>
    <title>Términos y condiciones - Mujer Viaja</title>    
    <meta name="description" content="Nuestros términos y condiciones están diseñados para garantizar una experiencia segura para todas nuestras viajeras. Queremos que tu aventura sea inolvidable. Te invitamos a revisar y aceptar nuestros términos antes de embarcarte en esta emocionante travesía con nosotras." />
<meta name="keywords" content="mujerviaja, mujer viaja,términos y condiciones, política, seguridad, igualdad, acuerdo, normas, responsabilidades, turismo, viajes para mujeres, protección del usuario, condiciones legales" />
    <?php include("templates/head.php"); ?>
</head>

<body>

    <?php include("templates/preloader.php") ?>
	<!-- End Preload -->

	<!-- Header================================================== -->
    <div id="header_1"><?php include("templates/header.php"); ?></div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/superterminos.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Términos y condiciones</h1>
				<p>"Todo claro, para que pases unas vacaciones increíbles"</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<!-- <div class="main_title">
				<h2>"<span>Love</span> travel and discover"</h2>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div> -->

			<div id="bg_profile">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
                        <?php echo $myWebSite["politicas"]; ?>  
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
							<a href="contacto" class="btn_1">Contáctanos</a>
						</div>
					</div>
					<!-- end col -->

					<div class="col-md-6">
						<div class="box_style_3">
							<i class="icon_set_1_icon-90"></i>
							<h3>Call center</h3>
							<p>Si tienes dudas, llámanos. Estamos para tenderte.</p>
							<a href="tel:<?php echo $myWebSite["telefono"]; ?>" class="btn_1">Llamar ahora</a>
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
			<a href="tours" class="btn_1 white">Ver tours ahora</a>
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
