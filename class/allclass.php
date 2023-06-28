<?php 
    session_start();
    include_once(dirname(__FILE__, 2)."/class/paquetes.class.php");
    include_once(dirname(__FILE__, 2)."/class/utilities.class.php");

    use PaquetesClass\Paquetes;
    use funcionesglobales\funciones;    

    $tours = new Paquetes();
    $fn = new funciones(); 
    
    //Monedas
    $monedas       = $tours->monedas();
    $monedaDefault = $monedas["data"]["0"]["iso"];
    $tipoCambio    = $monedas["data"]["0"]["tipo_cambio"];

    if(isset($_SESSION["moneda"])){
        $monedaSeleccionada = $_SESSION["moneda"];
    }else{
        $monedaSeleccionada = $monedas["data"]["0"]["iso"];
    }

    //Verificando afiliado
    if(isset($_GET["affiliate"])){
        if(isset($_SESSION["afiliadoSession"])){
            $afiliado           = $_SESSION["idafiliado"];
            $nombreAfiliado     = $_SESSION["nombreafiliado"];
            $emailAfiliado      = $_SESSION["emailafiliado"];            

            $direccionAfiliado  = $_SESSION["direccion_comercial"];
            $pais_comercial     = $_SESSION["pais_comercial"];
            $estado_comercial   = $_SESSION["estado_comercial"];
            $ciudad_comercial   = $_SESSION["ciudad_comercial"];
            $telefono_oficina   = $_SESSION["telefono_oficina"];            
            $telefono_celular   = $_SESSION["telefono_celular"];            
            $img_afiliado       = $_SESSION["img_afiliado"];

            $telefono_celular_codigo_pais  = $_SESSION["telefono_celular_codigo_pais"];
            $telefono_oficina_codigo_pais  = $_SESSION["telefono_oficina_codigo_pais"];
        }else{
            $codigoAfiliado    = $_GET["affiliate"];  
            $apiAfiliado       = $tours->getAffiliate($codigoAfiliado);
            $afiliado          = $apiAfiliado["0"]["id"];
            $nombreAfiliado    = $apiAfiliado["0"]["nombre_comercial"];
            $emailAfiliado     = $apiAfiliado["0"]["email"];

            $direccionAfiliado = $apiAfiliado["0"]["direccion_comercial"];
            $pais_comercial    = $apiAfiliado["0"]["pais_comercial"];
            $estado_comercial  = $apiAfiliado["0"]["estado_comercial"];
            $ciudad_comercial  = $apiAfiliado["0"]["ciudad_comercial"];
            $telefono_oficina  = $apiAfiliado["0"]["telefono_oficina"];
            $telefono_celular  = $apiAfiliado["0"]["telefono_celular"];
            $img_afiliado      = $apiAfiliado["0"]["img_afiliado"];

            $telefono_celular_codigo_pais      = $apiAfiliado["0"]["telefono_celular_codigo_pais"];
            $telefono_oficina_codigo_pais      = $apiAfiliado["0"]["telefono_oficina_codigo_pais"];

            $_SESSION["idafiliado"]          = $afiliado;
            $_SESSION["nombreafiliado"]      = $nombreAfiliado;
            $_SESSION["emailafiliado"]       = $emailAfiliado;
            $_SESSION["afiliadoSession"]     = true;              
            
            $_SESSION["direccion_comercial"] = $direccionAfiliado;
            $_SESSION["pais_comercial"]      = $pais_comercial;
            $_SESSION["estado_comercial"]    = $estado_comercial;
            $_SESSION["ciudad_comercial"]    = $ciudad_comercial;
            $_SESSION["telefono_oficina"]    = $telefono_oficina;            
            $_SESSION["telefono_celular"]    = $telefono_celular;            
            $_SESSION["img_afiliado"]        = $img_afiliado;  
            
            $_SESSION["telefono_celular_codigo_pais"] = $telefono_celular_codigo_pais;
            $_SESSION["telefono_oficina_codigo_pais"] = $telefono_oficina_codigo_pais;            
        }        
    }else{
        if(isset($_SESSION["afiliadoSession"])){
            $afiliado = $_SESSION["idafiliado"];
            $nombreAfiliado = $_SESSION["nombreafiliado"];
            $emailAfiliado = $_SESSION["emailafiliado"];

            $direccionAfiliado  = $_SESSION["direccion_comercial"];
            $pais_comercial     = $_SESSION["pais_comercial"];
            $estado_comercial   = $_SESSION["estado_comercial"];
            $ciudad_comercial   = $_SESSION["ciudad_comercial"];
            $telefono_oficina   = $_SESSION["telefono_oficina"];            
            $telefono_celular   = $_SESSION["telefono_celular"];            
            $img_afiliado       = $_SESSION["img_afiliado"];

            $telefono_celular_codigo_pais  = $_SESSION["telefono_celular_codigo_pais"];
            $telefono_oficina_codigo_pais  = $_SESSION["telefono_oficina_codigo_pais"];            
        }else{
            $afiliado = 0;
            $nombreAfiliado = '';
            $emailAfiliado = '';

            $direccionAfiliado  = '';
            $pais_comercial     = '';
            $estado_comercial   = '';
            $ciudad_comercial   = '';
            $telefono_oficina   = '';            
            $telefono_celular   = '';            
            $img_afiliado       = '';

            $telefono_celular_codigo_pais  = '';
            $telefono_oficina_codigo_pais  = '';             
        }
    }   

    if($afiliado == 0 && $_SERVER["REQUEST_URI"] != '/direcciones_in'){
        header('Location: direcciones_in');
    }
    
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

    function array_search_values( $m_needle, $a_haystack, $b_strict = false){
        return array_intersect_key( $a_haystack, array_flip( array_keys( $a_haystack, $m_needle, $b_strict)));
    }      
?>
