<?php 
session_start();
$moneda = $_GET["moneda"];
$_SESSION["moneda"] = $moneda;


?>