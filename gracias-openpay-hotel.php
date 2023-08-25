<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    include_once('vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;    

    $valoresHotel                = json_decode($_SESSION["reservaHotelera"]);
    $reservaBD                   = $_SESSION["reservaGuardada"];

    $formRate["partner_order_id"] = $reservaBD["controlinterno"];
    $formRate["language"]  = "ES";
    $formRate["user_ip"]   = $_SERVER['REMOTE_ADDR'];
    $formRate["book_hash"] = $reservaBD["book_hash"];
    $formRate["reservaBD"] = $reservaBD["id"];
    $formRate["nombre"]    = $valoresHotel->nombre;
    $formRate["apellido"]  = $valoresHotel->apellido;
    $emailCliente = $valoresHotel->email;

    $idoperacion = $_GET["id"];
    $data["transaccion"] = $idoperacion;
    $respuesta = $tours->getStatusPay($data);   
    
    $estatus                   = $respuesta["estatus"];
    $formRate["autorizacion"]  = $respuesta["autorizacion"];
    $formRate["montopagado"]   = $respuesta["monto"];

    $mail = new PHPMailer(true);
    if($estatus === 'completed'){
        $reservafinal = $hotels->requestReservation($formRate);   

        $pdf      = $reservafinal["pdf"];
        $bodyMail = $reservafinal["bodyMail"];          
        
        try {
            //Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'bookingtech.mx';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'notificaciones@bookingtech.mx';                     //SMTP username
            $mail->Password   = 'Fe!fg8949';                               //SMTP password
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPSecure = "tls";
            $mail->CharSet = 'UTF-8';
    
            //Recipients
            if($myWebSite["cc_email_reservas_uno"] != ''){
                $mail->setFrom($myWebSite["cc_email_reservas_uno"], 'Mujer Viaja');
            }else{
                $mail->setFrom('notificaciones@bookingtech.mx', 'Mujer Viaja');
            }            
    
            //Correo del cliente
            $mail->addAddress($emailCliente); 
    
            //Enviar copia al correo 2 de reservas?
            if($myWebSite["cc_email_reservas_dos"] != ''){
                 $mail->addAddress('pabloayaladeveloper@gmail.com');  
                // $mail->addAddress($myWebSite["cc_email_reservas_dos"]);  
            }  
    
            //Enviar correo al afiliado?
            if($emailAfiliado != ''){
                // $mail->addAddress($emailAfiliado);  
                $mail->addAddress('pabloayaladev@gmail.com');  
            }       
    
            $mail->AddAttachment($pdf); 
            $mail->addReplyTo($myWebSite["cc_email_reservas_uno"], "Mujer Viaja");  //Poner nombre de la agencia de viajes 
            $mail->isHTML(true);   
            $mail->Subject = 'Su reservación se ha realizado con éxito';
            $mail->Body    = $bodyMail;
            $mail->AltBody = 'ALT del cuerpo del correo';    
            $mail->send();
            } catch (Exception $e) {
                echo "Error";
            }          
    }else{
        try {
            //Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'bookingtech.mx';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'notificaciones@bookingtech.mx';                     //SMTP username
            $mail->Password   = 'Fe!fg8949';                               //SMTP password
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPSecure = "tls";
            $mail->CharSet = 'UTF-8';

            $bodyMail = '
            <!DOCTYPE html>
            <html lang="es">            
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Gracias por escribirnos</title>
            </head>
            <body> 
                <h4>Un cliente ha intentado realizar una reservación pero su pago no fue aceptado</h4>
                <p>
                    <b>Nombre: </b>'.$valoresHotel->nombre. ' '.$valoresHotel->apellido.'<br> Revise en su plataforma bookingTech para más detalle.';
        
                    if($nombre_afiliado != ''){
                        $bodyMail .='<b>Afiliado: </b>'.$nombre_afiliado.'<br>';
                    }		
        
            $bodyMail .= '</p>
                <br><br>
                <h5>Éxito!</h5>
            </body>    
            </html>         
            ';
    
            //Recipients
            $mail->setFrom('notificaciones@bookingtech.mx', 'Mujer Viaja');            
    
            //Correos de la agencia para notificarle el error:
            if($myWebSite["cc_email_reservas_uno"] != ''){
                // $mail->addAddress($myWebSite["cc_email_reservas_uno"]);  
                $mail->addAddress('pabloayaladev@gmail.com');  
            }  
    
            //Enviar copia al correo 2 de reservas?
            if($myWebSite["cc_email_reservas_dos"] != ''){
                // $mail->addAddress($myWebSite["cc_email_reservas_dos"]);                  
            }            
    
            //Enviar correo al afiliado?
            if($emailAfiliado != ''){
                $mail->addAddress($emailAfiliado);  
                $mail->addAddress('pabloayaladeveloper@gmail.com');  
            }       
    
            $mail->addReplyTo($myWebSite["cc_email_reservas_uno"], "Mujer Viaja");  //Poner nombre de la agencia de viajes 
            $mail->isHTML(true);   
            $mail->Subject = 'Su reservación se ha realizado con éxito';
            $mail->Body    = $bodyMail;
            $mail->AltBody = 'ALT del cuerpo del correo';    
            $mail->send();
            } catch (Exception $e) {
                echo "Error";
            }          
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