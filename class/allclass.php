<?php 
    session_start();
    include("class/paquetes.class.php");
    include("class/utilities.class.php");

    if(isset($_SESSION["logotipo"])){
        $logotipo = $_SESSION["logotipo"];
    }else{
        $logotipo = '';
    }
    
    

    use PaquetesClass\Paquetes;
    use funcionesglobales\funciones;    

    $tours = new Paquetes();
    $fn = new funciones();
    
    if(isset($_GET["delete"])){
        $delete = $_GET["delete"];
        if($delete == 1){
            session_destroy();
        }        
    }

    if(isset($_SESSION["apiconection"])){
        //Website definida
        $myWebSiteB = $_SESSION["mywebsite"];
    }else{
        //Website no definida
        $myWebSiteB = $tours->myWebSite();
        $_SESSION["mywebsite"] = $myWebSiteB;
        $_SESSION["apiconection"] = true;
    }    
    $myWebSite = $myWebSiteB[0];


    //Verificando afiliado
    if(isset($_GET["affiliate"])){
        if(isset($_SESSION["afiliadoSession"])){
            $afiliado = $_SESSION["idafiliado"];
            $nombreAfiliado = $_SESSION["nombreafiliado"];
            $emailAfiliado = $_SESSION["emailafiliado"];            
        }else{
            $codigoAfiliado =  $_GET["affiliate"];  

            $apiAfiliado = $tours->getAffiliate($codigoAfiliado);
            $afiliado = $apiAfiliado["0"]["id"];
            $nombreAfiliado = $apiAfiliado["0"]["nombre_comercial"];
            $emailAfiliado = $apiAfiliado["0"]["email"];

            $_SESSION["idafiliado"] = $afiliado;
            $_SESSION["nombreafiliado"] = $nombreAfiliado;
            $_SESSION["emailafiliado"] = $emailAfiliado;
            $_SESSION["afiliadoSession"] = true;            
        }        
    }else{
        if(isset($_SESSION["afiliadoSession"])){
            $afiliado = $_SESSION["idafiliado"];
            $nombreAfiliado = $_SESSION["nombreafiliado"];
            $emailAfiliado = $_SESSION["emailafiliado"];
        }else{
            $afiliado = 0;
            $nombreAfiliado = '';
            $emailAfiliado = '';
        }
    }   

    function array_search_values( $m_needle, $a_haystack, $b_strict = false){
        return array_intersect_key( $a_haystack, array_flip( array_keys( $a_haystack, $m_needle, $b_strict)));
    }      
?>
