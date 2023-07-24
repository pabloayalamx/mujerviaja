<?php 

include("templates/language.php"); 
include("class/allclass.php"); 

$valoresCivi = json_encode($_POST);
$openpayLINK = $_POST["openpayLINK"];
$_SESSION["reservaCivi"] = $valoresCivi;

$reserva = $tours->addReserva($_POST);
// header('Location: '.$openpayLINK);

?>