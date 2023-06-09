<?php

if(!$_POST) exit;

// Email verification, do not edit.
function isEmail($email_booking ) {
	return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_booking ));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
$adults        = $_POST['adultos'];
$senior        = $_POST['menores'];
$student       = $_POST['infantes'];
$total         = $_POST['total'];
$tour_name     = $_POST['tour_name'];

if(isset($_POST['fecha_viaje_input'])){
	$date_pick     = $_POST['fecha_viaje_input'];
}else{
	$date_pick     = $_POST['fecha_viaje'];
}

if(trim($adults) == 0) {
	echo '<div class="error_message">Selecciona al menos 1 adulto.</div>';
	exit();
} else if(trim($senior ) == '') {
	echo '<div class="error_message">Enter senior number.</div>';
	exit();
} else if(trim($student ) == '') {
	echo '<div class="error_message">Enter student number.</div>';
	exit();
} else if(trim($date_pick ) == '') {
	echo '<div class="error_message">Selecciona una fecha.</div>';
	exit();
}else {
	echo "<div id='success_page' style='padding:10px 20px 30px 20px; text-align:center; font-size:14px;'>";
	echo "<div style='font-size:60px; font-weight:normal;color:#acd373;'><i class='icon_set_1_icon-76'></i></div>";
	echo "<strong >DATOS CORRECTOS!</strong><br>";
	echo "Redireccionando....";
	echo "</div>";
}

