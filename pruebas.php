<?php

use PaquetesClass\Paquetes;

include("class/paquetes.class.php");
$fn = new Paquetes();

$categoriasArray=[];
$categorias[0]["id"] = "40";
$categorias[1]["id"] = "41";
$categorias[2]["id"] = "42";
$categorias[3]["id"] = "43";


foreach($categorias as $i => $categoria){
    $categoriasArray[$i] = $categoria["id"];
}
$categorias_txt = implode(",", $categoriasArray);
$toursrelacionados = $fn->relatedTours($categorias_txt);


print_r($toursrelacionados);




?>