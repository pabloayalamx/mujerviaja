<?php 
    include("class/paquetes.class.php");
    include("class/utilities.class.php");

    use PaquetesClass\Paquetes;
    use funcionesglobales\funciones;
    $info = new Paquetes();
    $fn = new funciones();


    $form["search"] = $_GET["search"];
    $precios = $info->keywordDestinationSearch($form);
    echo $precios;
?>