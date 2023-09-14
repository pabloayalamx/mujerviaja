<!DOCTYPE html>
<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    include_once('vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function isEmail($email_contact ) {
        return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_contact ));
    }

    if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
    $name_contact        = $_POST['name_contact'];
    $lastname_contact    = $_POST['lastname_contact'];
    $email_contact       = $_POST['email_contact'];
    $phone_contact       = $_POST['phone_contact'];
    $message_contact     = $_POST['message_contact'];
    $verify_contact      = $_POST['verify_contact'];
    $email_afiliado      = $_POST["email_afiliado"];
    $nombre_afiliado     = $_POST["nombre_afiliado"]; 

    /* ISAAC: CODIGO NUEVO PARA SUBIR DATOS A LA PLATAFORMA */    
    $id_usuario_asignado = $_POST["id_usuario_asignado"];    

    //Enviar datos a la API
    $frmContact = $tours->agregarContacto($_POST);
    // TERMINA CODIGO NUEVO
    
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
        <h4>Se ha generado un nuevo prospecto: </h4>
        <p>
            <b>Nombre: </b>'.$name_contact. ' '.$lastname_contact.'<br>
            <b>Correo: </b>'.$email_contact.'<br>
            <b>Teléfono: </b>'.$phone_contact.'<br>
            <b>Comentarios: </b>'.$message_contact.'<br>';

            if($nombre_afiliado != ''){
                $bodyMail .='<b>Afiliado: </b>'.$nombre_afiliado.'<br>';
            }		

    $bodyMail .= '</p>
        <br><br>
        <h5>Éxito!</h5>
    </body>    
    </html>         
    ';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = false;
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.ionos.mx';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'notificaciones@bookingtech.mx';                     //SMTP username
        $mail->Password   = ' #NotificacionesBTrap2023!';                               //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = "tls";
        $mail->CharSet = 'UTF-8';

        //Recipients
        $mail->setFrom('notificaciones@bookingtech.mx', 'Notificaciones Viaja Mujer');
        $mail->addAddress($myWebSite["email_form"]);     //Add a recipient
        if($myWebSite["cc_email_form"] != ''){
            $mail->addAddress($myWebSite["cc_email_form"]);  
        }  
        if($email_afiliado != ''){
            $mail->addAddress($email_afiliado);  
        }       

        $mail->addReplyTo($email_contact, $name_contact.' '.$lastname_contact);

        $mail->isHTML(true);   
        $mail->Subject = 'Nuevo prospecto generado desde el sitio web';
        $mail->Body    = $bodyMail;
        $mail->AltBody = 'ALT del cuerpo del correo';    
        $mail->send();
        } catch (Exception $e) {
            echo "Error";
        }      
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
						<h3>Gracias por contactarnos</h3>
						<p>En breve una representante de Mujer Viaja te contactará</p>
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