<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    $valoresHotel                = json_decode($_SESSION["reservaHotelera"]);
    $reservaBD                   = $_SESSION["reservaGuardada"];

    $formRate["partner_order_id"] = $reservaBD["controlinterno"];
    $formRate["language"]  = "ES";
    $formRate["user_ip"]   = $_SERVER['REMOTE_ADDR'];
    $formRate["book_hash"] = $reservaBD["book_hash"];
    $formRate["reservaBD"] = $reservaBD["id"];
    $formRate["nombre"]    = $valoresHotel->nombre;
    $formRate["apellido"]  = $valoresHotel->apellido;

    $idoperacion = $_GET["id"];
    $data["transaccion"] = $idoperacion;
    $respuesta = $tours->getStatusPay($data);   
    
    $estatus                   = $respuesta["estatus"];
    $formRate["autorizacion"]  = $respuesta["autorizacion"];
    $formRate["montopagado"]   = $respuesta["monto"];

    if($estatus === 'completed'){
        $reservafinal = $hotels->requestReservation($formRate);
    }
       
?>
<head>
    <base href="<?php echo $fn->baseMeta(); ?>">
    <title>Reservación en línea</title>
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
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/pagoenlinea.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>
                    <?php echo $estatus === 'completed' ? 'SU PAGO SE HA REALIZADO CON ÉXITO' : 'SU PAGO NO PUDO SER PROCESADO'; ?>
                </h1>
				<p><?php echo $estatus === 'completed' ? 'Felicidades! Prepárate para una experiencia inolvidable' : 'Comunícate con nostros para encontrar una solución'; ?></p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
            <div class="main_title">
                <?php if($estatus === 'completed'){ ?>
                    <h2>"<span>Felicidades!, </span> revisa tu correo"</h2>
                    <p>Te hemos enviado por correo todos los detalles de tu reservación, revisa tu <strong>SPAM</strong>.</p>
                <?php }else{ ?>
                    <h2>"Su pago fue rechazado"</h2>
                    <p>Motivo: <?php echo $mensaje; ?>.</p>                    
                <?php } ?>
			</div>
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->
    <!-- End container -->

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