<?php
echo "error";
// include_once(dirname(__FILE__, 2).'/vendor/autoload.php');
// include_once(dirname(__FILE__, 2)."/class/allclass.php");

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// if(!$_POST) exit;

// function isEmail($email_contact ) {
// 	return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_contact ));
// }

// if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
// $name_contact        = $_POST['name_contact'];
// $lastname_contact    = $_POST['lastname_contact'];
// $email_contact       = $_POST['email_contact'];
// $phone_contact       = $_POST['phone_contact'];
// $message_contact     = $_POST['message_contact'];
// $verify_contact      = $_POST['verify_contact'];
// $email_afiliado      = $_POST["email_afiliado"];
// $nombre_afiliado     = $_POST["nombre_afiliado"];

// if(trim($name_contact) == '') {
// 	echo '<div class="error_message">Escribe tu nombre.</div>';
// 	exit();
// } else if(trim($lastname_contact ) == '') {
// 	echo '<div class="error_message">Escribe tu apellido.</div>';
// 	exit();
// } else if(trim($email_contact) == '') {
// 	echo '<div class="error_message">Escribe un email válido.</div>';
// 	exit();
// } else if(!isEmail($email_contact)) {
// 	echo '<div class="error_message">You have enter an invalid e-mail address, try again.</div>';
// 	exit();
// 	} else if(trim($phone_contact) == '') {
// 	echo '<div class="error_message">Escribe un número de teléfono válido.</div>';
// 	exit();
// } else if(!is_numeric($phone_contact)) {
// 	echo '<div class="error_message">Escribe un número de teléfono válido.</div>';
// 	exit();
// } else if(trim($message_contact) == '') {
// 	echo '<div class="error_message">Please enter your message.</div>';
// 	exit();
// } else if(!isset($verify_contact) || trim($verify_contact) == '') {
// 	echo '<div class="error_message"> Escribe una respuesta válida.</div>';
// 	exit();
// } else if(trim($verify_contact) != '4') {
// 	echo '<div class="error_message">La respuesta es incorrecta.</div>';
// 	exit();
// }

// $bodyMail = '
// <!DOCTYPE html>
// <html lang="es">            
// <head>
// 	<meta charset="UTF-8">
// 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
// 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
// 	<title>Gracias por escribirnos</title>
// </head>
// <body> 
// 	<h4>Se ha generado un nuevo prospecto: </h4>
// 	<p>
// 		<b>Nombre: </b>'.$name_contact. ' '.$lastname_contact.'<br>
// 		<b>Correo: </b>'.$email_contact.'<br>
// 		<b>Teléfono: </b>'.$phone_contact.'<br>
// 		<b>Comentarios: </b>'.$message_contact.'<br>';

// 		if($email_afiliado != ''){
// 			$bodyMail .='<b>Afiliado: </b>'.$nombre_afiliado.'<br>';
// 		}		

// $bodyMail .= '</p>
// 	<br><br>
// 	<h5>Éxito!</h5>
// </body>    
// </html>         
// ';

// $mail = new PHPMailer(true);
// try {
// 	//Server settings
// 	$mail->SMTPDebug = false;
// 	$mail->isSMTP();                                            //Send using SMTP
// 	$mail->Host       = 'mail.smtp2go.com';                     //Set the SMTP server to send through
// 	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
// 	$mail->Username   = 'bookingtrap.com';                     //SMTP username
// 	$mail->Password   = 'NJ3YvJVJvNKZ83ih';                               //SMTP password
// 	$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
// 	$mail->SMTPSecure = "tls";
// 	$mail->CharSet = 'UTF-8';

// 	//Recipients
// 	$mail->setFrom('notificaciones@bookingtrap.com', 'Notificaciones Viaja Mujer');
// 	$mail->addAddress($myWebSite["email_form"]);     //Add a recipient
// 	if($myWebSite["cc_email_form"] != ''){
// 		$mail->addAddress($myWebSite["cc_email_form"]);  
// 	}  
// 	if($email_afiliado != ''){
// 		$mail->addAddress($email_afiliado);  
// 	}       

// 	$mail->addReplyTo($email_contact, $name_contact.' '.$lastname_contact);

// 	$mail->isHTML(true);   
// 	$mail->Subject = 'Nuevo prospecto generado desde el sitio web';
// 	$mail->Body    = $bodyMail;
// 	$mail->AltBody = 'ALT del cuerpo del correo';    
// 	$mail->send();

// 	echo "<div id='success_page' style='padding:25px 0'>";
// 	echo "<strong >Email enviado.</strong><br>";
// 	echo "Gracias <strong>$name_contact</strong>,<br> su mensaje ha sido enviado. En breve le contactaremos.";
// 	echo "</div>";	
// 	} catch (Exception $e) {
// 		echo "Error";
// 	}  
