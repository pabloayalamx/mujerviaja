<?php

namespace funcionesglobales;

class funciones
{
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

    function recortar_cadena($texto, $limite=100){
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
}
