<?php 

namespace App\Helpers;

class Curl{
    public $url;
    public $headers;
    public function __construct($url, $headers = array()){
        $this->url = $url;
        $this->headers = $headers;
    }

    public function get($headers = array()){
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function post($params = array()){
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function put($params = array()){
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function delete(){
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}