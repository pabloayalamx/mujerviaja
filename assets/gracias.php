<?php 
    session_start();    

    require '../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    $nombre   = filter_input(INPUT_POST, "name_contact", FILTER_DEFAULT);
    $apellido = filter_input(INPUT_POST, "lastname_contact", FILTER_DEFAULT);
    $email    = filter_input(INPUT_POST, "email_contact", FILTER_DEFAULT);
    $telefono = filter_input(INPUT_POST, "phone_contact", FILTER_DEFAULT);

    $carpeta = "logos/";
    $nombre_archivo = $carpeta.uniqid('logo_').$_FILES['archivo']['name'];
    $tipo_archivo = $_FILES['archivo']['type'];
    $tamano_archivo = $_FILES['archivo']['size'];
        
    //compruebo si las características del archivo son las que deseo
    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) || strpos($tipo_archivo, "webp") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "png") && ($tamano_archivo < 100000))) {
           echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
    }else{
           if (move_uploaded_file($_FILES['archivo']['tmp_name'],  $nombre_archivo)){
                //   echo "El archivo ha sido cargado correctamente.";
                  $_SESSION['logotipo'] = $nombre_archivo;
           }else{
                //   echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
           }
    }   

    $bodyMail = '
    <h4>Nuevo prospecto recibido</h4>
    <br>
    <br>
    <b>Nombre: </b>'.$nombre.' '.$apellido.'<br>
    <b>Email: </b>'.$email.'<br>
    <b>Telefono: </b>'.$telefono.'<br>
    <b>Logo: </b>https://demo1.bookingtrap.com/assets/'.$nombre_archivo.'<br>';    
    
    
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = false;
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.smtp2go.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'bookingtrap.com';                     //SMTP username
        $mail->Password   = 'NJ3YvJVJvNKZ83ih';                               //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = "tls";
        $mail->CharSet = 'UTF-8';
    
        //Recipients
        $mail->setFrom('notificaciones@bookingtrap.com', 'Notificaciones BookingTrap LandingPage');
        $mail->addAddress('pablo.ayala@bookingtrap.com');   
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Nuevo prospecto landing';
        $mail->Body    = $bodyMail;
        $mail->AltBody = 'ALT del cuerpo del correo';    
        $mail->send();
        echo "OK";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    header('Location: https://demo1.bookingtrap.com');

?>