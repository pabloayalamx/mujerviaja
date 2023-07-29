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
    
    print_r($respuesta);

    // $reservafinal = $hotels->requestReservation($formRate);

?>
