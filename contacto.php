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
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/contacto.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Contáctanos</h1>
				<p>"Estamos para asesorarte y resolver todas tus dudas"</p>
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
						<?php if($afiliado > 0){ ?>
							<p>
								<span class="tituloContacto">Nombre: </span><br>
								<?php echo $nombreAfiliado; ?><br><br>

								<span class="tituloContacto">Email: </span><br>
								<a href="mailto:<?php echo $emailAfiliado; ?>" class="linkcontacto"><?php echo $emailAfiliado; ?></a><br><br>	
								
								<span class="tituloContacto">Teléfono: </span><br>
								<a href="tel:<?php echo $telefono_oficina_codigo_pais.$telefono_oficina; ?>" class="linkcontacto"><?php echo "(".$telefono_oficina_codigo_pais.") ".$telefono_oficina; ?></a><br><br>

								<?php if($img_afiliado != ''){ ?>
									<img src="https://app.bookingtrap.com/public/storage/<?php echo $img_afiliado; ?>" alt="<?php echo $nombreAfiliado; ?>" class="img-responsive">
								<?php } ?>
							</p>
						<?php }else{ ?>
								<span class="tituloContacto">Email: </span><br>
								<a href="mailto:<?php echo $myWebSite["email_publico"]; ?>"><?php echo $myWebSite["email_publico"]; ?></a><br><br>	
								
								<span class="tituloContacto">Teléfono: </span><br>
								<?php echo $myWebSite["telefono"]; ?><br><br>	
						<?php } ?>
						</p>
					</div>
				</aside>
				<!--End aside -->

				<div class="col-md-9">
					<div id="paso1">
						<h3>Contáctanos</h3>
						<p>Completa el formulario y nos pondremos en contacto contigo lo más pronto posible</p>
						<div>
							<form method="post" action="gracias-email" id="contactform">
								<input type="hidden" name="email_afiliado" id="email_afiliado" value="<?php echo $afiliado > 0 ? $emailAfiliado : ''; ?>">
								<input type="hidden" name="nombre_afiliado" id="nombre_afiliado" value="<?php echo $afiliado > 0 ? $nombreAfiliado : ''; ?>">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Nombre</label>
											<input type="text" required class="form-control styled" id="name_contact" name="name_contact" placeholder="Nombre">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Apellido</label>
											<input type="text" required class="form-control styled" id="lastname_contact" name="lastname_contact" placeholder="Apellido">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Email:</label>
											<input type="email" required id="email_contact" name="email_contact" class="form-control styled" placeholder="Escribe tu email">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Teléfono:</label>
											<input type="number" required id="phone_contact" name="phone_contact" class="form-control styled" placeholder="10 dígitos">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Comentarios:</label>
											<textarea rows="5" id="message_contact" name="message_contact" class="form-control styled" style="height:100px;" placeholder="Escribe tus comentarios"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>¿Eres humano? 3 + 1 =</label>
											<input type="text" id="verify_contact" name="verify_contact" required class=" form-control styled" placeholder="Escribe el resultado">
										</div>
										<p>
											<input form="contactform" type="submit" value="Enviar" class="btn_1" id="submit-contact">
											<div id="message-contact"></div>
										</p>
									</div>
								</div>
							</form>
						</div>
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

	<!-- SPECIFIC SCRIPTS -->
	<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/mapmarker.jquery.js"></script>
	<script type="text/javascript" src="js/mapmarker_func.jquery.js"></script> -->

</body>

</html>