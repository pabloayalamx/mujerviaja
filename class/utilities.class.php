<?php

namespace funcionesglobales;

class funciones
{

    public function tarifaPublicaAgencias($tarifa){
        $precio = $tarifa / .95;
        return $precio;
    }    

    public function tarifaNetaAgenciasTours($tarifa){
        //Precio que bookingtrap le da a las agencias
        $precio = $tarifa / .99;
        return $precio;
    }     

    public function tarifaPublicaAgenciasTours($tarifa, $markup){
        //Tarifa que le dara la agencia al cliente final
        $tarifaAgencia = $this->tarifaNetaAgenciasTours($tarifa);
        $precio = $tarifaAgencia / (1- ($markup/100) );
        return number_format($precio, 2, '.', ',');
    }

    public function tarifaPublicaAgenciasToursSinFormato($tarifa, $markup){
        //Tarifa que le dara la agencia al cliente final
        $tarifaAgencia = $this->tarifaNetaAgenciasTours($tarifa);
        $precio = $tarifaAgencia / (1- ($markup/100) );
        return number_format($precio, 2, '.', '');
    }    

    public function precioMinimo($precios){
        $sgl = min(array_column($precios, 'adulto_sencilla'));
        $dbl = min(array_column($precios, 'adulto_doble'));
        $tpl = min(array_column($precios, 'adulto_triple'));
        $cpl = min(array_column($precios, 'adulto_cuadruple'));

        if($sgl > 0){
            $form["sgl"] = $sgl;
        }else{
            $form["sgl"] = 99999999999;
        }

        if($dbl > 0){
            $form["dbl"] = $dbl;
        }else{
            $form["dbl"] = 99999999998;
        }
        
        if($tpl > 0){
            $form["tpl"] = $tpl;
        }else{
            $form["tpl"] = 99999999997;
        }
        
        if($cpl > 0){
            $form["cpl"] = $cpl;
        }else{
            $form["cpl"] = 99999999996;
        }      

        $minimo = min($form);        
        
        return $minimo;
    }

    //Sirve para los TOURS PROPIOS
    public function precio($precioBase, $monedaPrecio, $monedaSeleccionada, $monedaDefault, $monedas){
        if($monedaPrecio == $monedaSeleccionada){
            $precioReal = $precioBase;
        }else{
            //Obtiene el tipo de cambio de la moneda del tour respecto al precio base
            $keyPrecio        = array_search($monedaPrecio, array_column($monedas["data"], 'iso')); 
            $tipoCambioPrecio = $monedas["data"][$keyPrecio]["tipo_cambio"]; 
            $precioReal = $precioBase * $tipoCambioPrecio;

            if($monedaPrecio == $monedaDefault){
                $keyPrecio        = array_search($monedaSeleccionada, array_column($monedas["data"], 'iso')); 
                $tipoCambioPrecio = $monedas["data"][$keyPrecio]["tipo_cambio"];    

                $precioReal = $precioBase / $tipoCambioPrecio;
            }

            if($monedaPrecio != $monedaDefault){
                //Convertimos el precio a la moneda default
                $keyPrecio        = array_search($monedaPrecio, array_column($monedas["data"], 'iso')); 
                $tipoCambioPrecio = $monedas["data"][$keyPrecio]["tipo_cambio"];  
                $precioMonedaDefault = $precioBase * $tipoCambioPrecio;

                $keyPrecioMonedaSeleccionada        = array_search($monedaSeleccionada, array_column($monedas["data"], 'iso')); 
                $tipoCambioPrecioMonedaSeleccionada = $monedas["data"][$keyPrecioMonedaSeleccionada]["tipo_cambio"];   
                
                $precioReal = $precioMonedaDefault / $tipoCambioPrecioMonedaSeleccionada;
            }
        }

        $form["preciosimple"]  = number_format($precioReal, 2, '.', '');
        $form["precioformato"] = number_format($precioReal, 2, '.', ',');
        $form["iso"]           = $monedaSeleccionada;
        
        return $form;
    }

    public function stringToUrl($string)
    {
        //Rememplazamos caracteres especiales latinos 
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ', ' ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n', '-');
        $cadena = str_replace($find, $repl, $string);

        return $this->minusculas($cadena);
    }

    public function reemplaza_espacios($string){
        $string         = $this->minusculas($string);
        $searchString   = " ";
        $replaceString  = "-";         
        $outputString   = str_replace($searchString, $replaceString, $string);         

        return $outputString;
    }    

    public function removeCorchetes($string){
        $caracteres = array("[", "]");
        $resultado = str_replace($caracteres, "", $string);  
        return $resultado;      
    }

    public function removeTime($string, $buscar){
        $resultado = str_replace($buscar, "", $string);
        return $resultado;      
    }    

    public function minusculas($cadena)
    {
        $res = mb_strtolower($cadena);
        return $res;
    }

    public function precioMinimoLista($precios){
        $temporal1 = array_map('intval', $precios);
        $temporal2 = array_diff($temporal1, array(0));
        $arrayFinal = empty($temporal2) ? $temporal1 : $temporal2;
        return min($arrayFinal);
    }

    public function letraCapital($string){
        $string = $this->minusculas($string);
        $string = ucfirst($string);
        return $string;
    }
    

    public function baseMeta()
    {
        $url = $_SERVER['HTTP_HOST'];
        $path = $url == 'localhost' ? 'http://localhost/mujerviaja/' : 'https://franquicia.mujerviaja.com/';

        return $path;
    }

    public function moneda($numero)
    {
        return number_format($numero, 2, ".", ",");
    }

    public function fechaAbreviada($fecha){
        //YYYY-MM-DD
        $fechas = explode('-', $fecha);
        $y = $fechas[0];
        $m = $fechas[1];
        $d = $fechas[2];

        $mes = $this->fnMes($m);
        return $d."/".$mes["abre"]."/".$y;
    }

    private function fnMes($mes)
    {
        $month = [];
        switch ($mes) {
            case "01":
                $month["abre"] = 'Ene';
                $month["comp"] = 'Enero';
                break;
            case "02":
                $month["abre"] = 'Feb';
                $month["comp"] = 'Febrero';
                break;
            case "03":
                $month["abre"] = 'Mar';
                $month["comp"] = 'Marzo';
                break;
            case "04":
                $month["abre"] = 'Abr';
                $month["comp"] = 'Abril';
                break;
            case "05":
                $month["abre"] = 'May';
                $month["comp"] = 'Mayo';
                break;
            case "06":
                $month["abre"] = 'Junio';
                $month["comp"] = 'Julio';
                break;
            case "07":
                $month["abre"] = 'Jul';
                $month["comp"] = 'Julio';
                break;
            case "08":
                $month["abre"] = 'Ago';
                $month["comp"] = 'Agosto';
                break;
            case "09":
                $month["abre"] = 'Sep';
                $month["comp"] = 'Septiembre';
                break;
            case "10":
                $month["abre"] = 'Oct';
                $month["comp"] = 'Octubre';
                break;
            case "11":
                $month["abre"] = 'Nov';
                $month["comp"] = 'Noviembre';
                break;
            case "12":
                $month["abre"] = 'Dic';
                $month["comp"] = 'Diciembre';
                break;
        }
        return $month;
    }

    public function recortar_cadena($texto, $limite=100){
        $texto = trim($texto);
        $texto = strip_tags($texto);
        $tamano = strlen($texto);
        $resultado = '';
        if($tamano <= $limite){
          return $texto;
        }else{
        $texto = substr($texto, 0, $limite);
        $palabras = explode(' ', $texto);
        $resultado = implode(' ', $palabras);
        $resultado .= '...';
      }
        return $resultado;
      }  

      public function datePickerFormat($fecha){
        //Convierte yyyy-mm-dd a mm-dd-yy
        $array = explode("-", $fecha);
        $dia   = $array[2];
        $mes   = $array[1];
        $year  = $array[0];        
        $nuevo = $mes."-".$dia."-".$year;

        return $nuevo;

    }  
    
    public function restaFechas($fecha, $dias){
        $date_now = $fecha;
        $date_past = strtotime('-'.$dias.' day', strtotime($date_now));
        $date_past = date('Y-m-d', $date_past);
        return $date_past;
    }

    public function sumaFechas($fecha, $dias){
        $date_now = $fecha;
        $date_past = strtotime('+'.$dias.' day', strtotime($date_now));
        $date_past = date('Y-m-d', $date_past);
        return $date_past;
    }   
    
    public function fechaYearOut($fecha){
        //YYYY-MM-DD
        $fechas = explode('-', $fecha);
        $y = $fechas[0];
        $m = $fechas[1];
        $d = $fechas[2];

        $mes = $this->fnMes($m);
        return $d."/".$mes["comp"];        
    }
    
}
