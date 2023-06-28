    <?php 
        require 'vendor/autoload.php';
        include("class/allclass.php");  

        //Variables del sitio web
        $cc_email_reservas_uno = $myWebSite["cc_email_reservas_uno"];
        $cc_email_reservas_dos = $myWebSite["cc_email_reservas_dos"];
            
        //Información del titular
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $telefono = $_POST["telefono"];
        $sexoTitular = $_POST["sexoTitular"];
        $dianacTitular = $_POST["dianacTitular"];
        $mesnacTitular = $_POST["mesnacTitular"];
        $yearTitular = $_POST["yearTitular"];
        $fnacTitular = $yearTitular."-".$mesnacTitular."-".$dianacTitular;
        $email = $_POST["email"];
        $nombretour = $_POST["nombretour"];
        $fechaviaje = $_POST["fechaviaje"];

        //openpay
        $idopenpay=$_POST["openpayID"];
        $openpayLINK=$_POST["openpayLINK"];

        //Información general del viaje
        $idtour = $_POST["idtour"];
        $cadultos = $_POST["cadultos"];
        $cmenores = $_POST["cmenores"];
        $cinfantes = $_POST["cinfantes"];
        $padulto = $_POST["padulto"];
        $pmenor = $_POST["pmenor"];
        $pinfante = $_POST["pinfante"];
        $gtotal = $_POST["gtotal"];
        $tipohabitacion = $_POST["tipohabitacion"];
        $hoteleria = $_POST["hoteleria"];

        //Aplica solo para circuitos:
        $id_temporada = isset($_POST["id_temporada"]) ? $_POST["id_temporada"] : '';
        $nombre_temporada = isset($_POST["nombre_temporada"]) ? $_POST["nombre_temporada"] : '';
        $id_clase_servicio = isset($_POST["id_clase_servicio"]) ? $_POST["id_clase_servicio"] : '';
        $nombre_servicio = isset($_POST["nombre_servicio"]) ? $_POST["nombre_servicio"] : '';
        $fecha_inicio = isset($_POST["fecha_inicio"]) ? $_POST["fecha_inicio"] : '';
        $fecha_fin = isset($_POST["fecha_fin"]) ? $_POST["fecha_fin"] : '';
        $id_paquete_fecha = isset($_POST["id_paquete_fecha"]) ? $_POST["id_paquete_fecha"] : '';
        $id_temporada_costo = isset($_POST["id_temporada_costo"]) ? $_POST["id_temporada_costo"] : '';      
        
        // Acompañantes adultos
        $nombreAcompa = isset($_POST["nombreAcompa"]) ? $_POST["nombreAcompa"] : '';
        $apellidoAcompa = isset($_POST["apellidoAcompa"]) ? $_POST["apellidoAcompa"] : '';;
        $dianacAcompa = isset($_POST["dianacAcompa"]) ? $_POST["dianacAcompa"] : '';;
        $mesnacAcompa = isset($_POST["mesnacAcompa"]) ? $_POST["mesnacAcompa"] : '';;
        $yearnacAcompa = isset($_POST["yearnacAcompa"]) ? $_POST["yearnacAcompa"] : '';;
        $sexoAcompa = isset($_POST["sexoAcompa"]) ? $_POST["sexoAcompa"] : '';;
        $parentescoAcompa = 'Otro';
        
        //Menores
        $nombreMenor = isset($_POST["nombreMenor"]) ? $_POST["nombreMenor"] : '';
        $apellidoMenor = isset($_POST["apellidoMenor"]) ? $_POST["apellidoMenor"] : '';
        $dianacMenor = isset($_POST["dianacMenor"]) ? $_POST["dianacMenor"] : '';
        $mesnacMenor = isset($_POST["mesnacMenor"]) ? $_POST["mesnacMenor"] : '';
        $yearnacMenor = isset($_POST["yearnacMenor"]) ? $_POST["yearnacMenor"] : '';
        $sexoMenor = isset($_POST["sexoMenor"]) ? $_POST["sexoMenor"] : '';

        //Recibimos informacion de promocion para tours de 1 dia
        $tipo_descuento_frm = $_POST["tipo_descuento_frm"];
        $valor_promocion_frm = $_POST["valor_promocion_frm"];
        $descuento_frm = $_POST["descuento_frm"];
        $idpromo_frm = $_POST["idpromo_frm"];
        $idexpromo_frm = $_POST["idexpromo_frm"];
        $aplicapromo = $_POST["aplicapromo"];         

        $parentescoMenor = 'Otro';

        $tadultos = $cadultos * $padulto;
        $tmenores = $cmenores * $pmenor;
        $tinfantes = $cinfantes * $pinfante;    

        //construyendo variables para la API de reservacion
        $formReserva["id_fecha"] = $id_paquete_fecha;
        $formReserva["id_promocion"] = $idpromo_frm;
        if($id_paquete_fecha > 0){
            $formReserva["fecha_inicio"] = $fecha_inicio;
            $formReserva["fecha_fin"] = $fecha_fin;
        }else{
            $formReserva["fecha_inicio"] = $fechaviaje;
            $formReserva["fecha_fin"] = $fechaviaje;        
        }
        $formReserva["id_paquete"] = $idtour;
        $formReserva["tipohabitacion"] = $tipohabitacion;

        $formReserva["idpromo_frm"] = $idpromo_frm;
        $formReserva["aplica_promo"] = $aplicapromo;
        $formReserva["idexpromo"] = $idexpromo_frm;
        $formReserva["tipo_descuento"] = $tipo_descuento_frm;
        $formReserva["valor_promocion"] = $valor_promocion_frm;
        $formReserva["descuento"] = $descuento_frm;    

        $formReserva["id_temporada"] = $id_temporada;
        $formReserva["nombre_temporada"] = $nombre_temporada;
        $formReserva["id_clase_servicio"] = $id_clase_servicio;
        $formReserva["id_paquete_fecha"] = $id_paquete_fecha;
        $formReserva["id_temporada_costo"] = $id_temporada_costo;    

        $formReserva["cantidad_adultos"] = $cadultos;
        $formReserva["cantidad_menores"] = $cmenores;
        $formReserva["cantidad_infantes"] = $cinfantes;

        $formReserva["precio_adultos"] = $padulto;
        $formReserva["precio_menores"] = $pmenor;
        $formReserva["precio_infantes"] = $pinfante;
        $formReserva["precio_total"] = $gtotal;

        $formReserva["id_afiliado"] = $afiliado;
        $formReserva["id_forma_pago"] = 9;
        $formReserva["id_moneda"] = 2;
        $formReserva["pagado"] = 0;
        $formReserva["hoteleria"] = $hoteleria;

        $formReserva["tit_nombre"] = $nombre;
        $formReserva["tit_apellido"] = $apellido;
        $formReserva["tit_telefono"] = $telefono;
        $formReserva["tit_email"] = $email;
        $formReserva["tit_fec_nac"] = $fnacTitular;
        $formReserva["idopenpay"] = $idopenpay;

        $nombreImagen = "https://franquicia.mujerviaja.com/img/logo.png";
        $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
   
    

    //Acompañantes adultos 
    if(is_array($nombreAcompa)){
        if(count($nombreAcompa) > 0){
            $acompa = 1;
            for($i=0; $i<count($nombreAcompa); $i++){
                $fnac = $yearnacAcompa[$i]."/".$mesnacAcompa[$i]."/".$dianacAcompa[$i];
                $acompa++;

                $acompaAdulto[$i]["nombre"] = $nombreAcompa[$i];
                $acompaAdulto[$i]["apellido"] = $apellidoAcompa[$i];
                $acompaAdulto[$i]["fecha_nacimiento"] = $fnac;
            }
        }
        $formReserva["paxesAdultos"] = $acompaAdulto;
    }else{
        $formReserva["paxesAdultos"] = 0;
    } 
    
    
    
    if(is_array($nombreMenor)){
        if(count($nombreMenor) > 0){
       
            $acompa = 1;
            for($i=0; $i<count($nombreMenor); $i++){
                $fnac_menor = $yearnacMenor[$i]."/".$mesnacMenor[$i]."/".$dianacMenor[$i];
                $acompa++;
                $acompaMenor[$i]["nombre"] = $nombreMenor[$i];
                $acompaMenor[$i]["apellido"] = $apellidoMenor[$i];
                $acompaMenor[$i]["fecha_nacimiento"] = $fnac_menor;                
            }
        }
        $formReserva["paxesMenores"] = $acompaMenor;
    }else{
        $formReserva["paxesMenores"] = 0;
    }   

    $reservacion = $tours->addReservation($formReserva);               
        
    if($aplicapromo == 1){
        if($descuento_frm == 1){
            //Porcentaje
            $subtotal = $gtotal;
            $gtotal = $subtotal - ($subtotal * ($valor_promocion_frm/100));
            $descuento = $subtotal - $gtotal;
        }else{
            //Monto
            $subtotal = $gtotal;
            $gtotal = $subtotal - $valor_promocion_frm;
            $descuento = $subtotal - $gtotal;
        }         

    }else{

    }
    
    header('Location: '.$openpayLINK);
?>    