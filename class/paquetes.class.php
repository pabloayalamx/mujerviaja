<?php 
namespace PaquetesClass;
include_once(dirname(__FILE__, 2).'/vendor/autoload.php');

use HTTP_Request2;

class Paquetes
{
    public $token;
    public $cookie;

    public function __construct()
    {
        //Token mujer viaja
        $this->token = "Bearer 7|KGlBtMybUvRNvuOHH4OSlBRWaP12fJqD4oXONKZg";                
        $this->cookie = "XSRF-TOKEN=eyJpdiI6IjgrZXI1amFCcCtRV0t4dGRuUjlGeVE9PSIsInZhbHVlIjoiVXgrVnFPSmtUQ1lsd3ltMG9GWEdYUUNDYkdHWG9UMy9JTUQ1QnU3Tlk4eVl5N21hQTNMSnlVNVlEcVFDWldFNjVqVXAraGt3K1dsT0RXUDNMeGk4YjNJZGhyRUhJcVFNaHQwaDh6OUdBV0ppRnRhQWMrbk9lajB3aVJtcklBbGciLCJtYWMiOiIzYWJmNTliNDlkNzhiZDhkYzMwYTRhMGM0Y2IxN2QwOTg3YWEwNThmZjEyZGZjOThlMjg0YzgwNWUxZmUzNDVhIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Ii85QXpxVGViU3FtdG9lTTFwR1B6eGc9PSIsInZhbHVlIjoiWWFHdUdNY0FvcjJ1Q3F5OGN4ZEw1QWlpSmJXS2diTXhScHBsODRwYVlMZm4vREIzUUJQemtYUGp3OGUyQlZCUnFiclVzMVV4WTJkMkRHKzhaSU5WZmJCRXRlSmpCK252K2YrV2FscWZQdVk2dktJN2JSWjV6MGVWQWVtNFFnOVciLCJtYWMiOiJhMWJlN2ZmZTVmMjE3NDRiMzc2ZDRkMGM4NDRjZmYyZWIyOTg1MWMyNGZjMmE4NDliZDk5MWU1YTQwZGZkZWNkIiwidGFnIjoiIn0%3D";  
    }

    public function getPrices($tour, $dias, $fecha){
        $url = $_SERVER['HTTP_HOST'];
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/prices' : 'https://app.bookingtrap.com/api/prices';
        $path = $path."?tour=".$tour."&dias=".$dias."&fecha=".$fecha;
        
        $request = new HTTP_Request2();
        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token
        ));   
        
        try {
            $response = $request->send();            
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }         
    }

    public function getAffiliate($afiliado){
        $url = $_SERVER['HTTP_HOST'];
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/affiliate' : 'https://app.bookingtrap.com/api/affiliate';
        $path = $path."?id=".$afiliado;
        
        $request = new HTTP_Request2();
        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token
        ));   
        
        try {
            $response = $request->send();            
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }         
    }    

    public function getList($tour = 0){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/tours' : 'https://app.bookingtrap.com/api/tours';
        
        $request = new HTTP_Request2();
        $path = $tour > 0 ? $path.'?tour='.$tour : $path;

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token
        ));   
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }          
    }

    public function myWebSite(){
        $url = $_SERVER['HTTP_HOST'];        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/mywebsite' : 'https://app.bookingtrap.com/api/mywebsite';        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }          
    }

    public function homeTours(){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/toursHome' : 'https://app.bookingtrap.com/api/toursHome';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }          
    }  

    public function toursOthers($data){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/toursOthers' : 'https://app.bookingtrap.com/api/toursOthers';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   

        $request->setBody(json_encode($data));
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }         
    }

    public function updateReservation($data){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/updateReservation' : 'https://app.bookingtrap.com/api/updateReservation';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_POST);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   

        $request->setBody(json_encode($data));
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }        
    }

    public function getStatusPay($data){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/getStatusPay' : 'https://app.bookingtrap.com/api/getStatusPay';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   

        $request->setBody(json_encode($data));
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }  
    }

    public function linkPayGenerator($data){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/linkPayGenerator' : 'https://app.bookingtrap.com/api/linkPayGenerator';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   

        $request->setBody(json_encode($data));
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }        
    }

    public function relatedTours($categories){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/relatedTours' : 'https://app.bookingtrap.com/api/relatedTours';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   

        $request->setBody(json_encode($categories));
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }  
    }
    
    
    public function distintivos(){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/apiDistinctives' : 'https://app.bookingtrap.com/api/apiDistinctives';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }          
    } 
    
    public function slider(){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/apiSlider' : 'https://app.bookingtrap.com/api/apiSlider';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }          
    }     

    public function galeria(){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/apiGallery' : 'https://app.bookingtrap.com/api/apiGallery';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_GET);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token,
            'Cookie' => $this->cookie
        ));   
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }          
    }    
    
    
    public function addReservation($reservacion){
        $url = $_SERVER['HTTP_HOST'];
        
        $path = $url=='localhost' ? 'http://localhost/bookingtrapcrm/api/reservations/add' : 'https://app.bookingtrap.com/api/reservations/add';
        
        $request = new HTTP_Request2();

        $request->setUrl($path);
        $request->setMethod(HTTP_Request2::METHOD_POST);

        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'Authorization' => $this->token,
            'Content-Type' => 'application/json'
        ));   

        $request->setBody(json_encode($reservacion));
        
        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                $respuesta =  (array) json_decode($response->getBody(), true);  
                return $respuesta;                 
            }else {
                echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
            }
        }
        catch(HTTP_Request2_Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }          
    }       
  
}

?>