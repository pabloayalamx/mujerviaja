<?php 
    session_start();
    $monedaSeleccionada = $_SESSION["moneda"];
    include("class/paquetes.class.php");
    include("class/utilities.class.php");

    use PaquetesClass\Paquetes;
    use funcionesglobales\funciones;
    $info = new Paquetes();
    $fn = new funciones();

    $nombre      = $_GET["nombre"];
    $apellido    = $_GET["apellido"];
    $telefono    = $_GET["telefono"];
    $descripcion = $_GET["descripcion"];
    $total       = $_GET["total"];
    $email       = $_GET["email"];

    $formData["nombre"]      = $nombre;
    $formData["apellido"]    = $apellido;
    $formData["currency"]    = $monedaSeleccionada;
    $formData["telefono"]    = $telefono;
    $formData["descripcion"] = $descripcion;
    $formData["total"]       = $total;
    $formData["email"]       = $email; 
    $formData["domain"]      = "https://franquicia.mujerviaja.com";
    $formData["gracias"]     = "gracias-openpay";

    $respuesta = $info->linkPayGenerator($formData);
    echo json_encode($respuesta);

    
?>