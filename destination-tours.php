<?php 
    include("class/paquetes.class.php");
    include("class/utilities.class.php");

    use PaquetesClass\Paquetes;
    use funcionesglobales\funciones;
    $info = new Paquetes();
    $fn = new funciones();

    $form["search"] = $_GET["search"];
    $form["sandbox"] = true;
    $destinosJson = $info->civitatisSearch($form);    
    $resultado = json_decode($destinosJson);   

    $destinos = $resultado->destinos->results;
    if(count($destinos) > 0){        
        foreach($destinos as $i => $destino){
            if($destino->text != 'Destinos'){
                $formList[$i]["icono"] = 'fa-map-marker-alt';
                $formList[$i]["text"]  = $destino->text;
                $formList[$i]["id"]    = $destino->id;
            }            
        }

        $acumulado = $i;
    }else{
        $acumulado = 0;
    }

    $actividades = $resultado->tours->results;
    if(count($actividades) > 0){        
        foreach($actividades as $a => $actividad){
            if($actividad->text != 'Actividades'){
                $indice = $acumulado + $a;
                $formList[$indice]["icono"] = 'fa-hiking';
                $formList[$indice]["text"]  = $actividad->text;
                $formList[$indice]["id"]    = $actividad->id;                
            }            
        }
    }    

    $grandote = [];
    foreach ($formList as $lista){
        array_push($grandote, $lista);
    }

    $results = [
        "results" => $grandote
    ];

    echo json_encode($results);

?>