<?php 
    include("templates/language.php"); 
    include("class/allclass.php"); 

    $valoresHotel                = json_encode($_POST);
    $openpayLINK                 = $_POST["openpayLINK"];
    $_SESSION["reservaHotelera"] = $valoresHotel;

    
    //Guardamos la reserva en la plataforma:
    $reserva = $hotels->addReservaHotelera($_POST);
    $_SESSION["reservaGuardada"] = $reserva;

    // header('Location: '.$openpayLINK);    

?>
