<?php 

namespace App\Helpers;

class ZeroBounce{
    public $api_key;
    public $url = 'https://api.zerobounce.net/v2';

    public function __construct($api_key){
        $this->api_key = $api_key;
    }

    public function getCredits(){
        $url = $this->url.'/getcredits?api_key='.$this->api_key;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    public function getAPIUsage($start, $end){
        $url = $this->url.'/getapiusage?api_key='.$this->api_key.'&start_date='.$start.'&end_date='.$end;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        
        $response = curl_exec($ch);
        curl_close($ch);

        //decode the json response
        return json_decode($response, true);
    }

    public function validate($email, $ip){
        $url = $this->url.'/validate?api_key='.$this->api_key.'&email='.urlencode($email).'&ip_address='.urlencode($ip);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        
        $response = curl_exec($ch);
        curl_close($ch);

        //decode the json response
        return json_decode($response, true);
    }

    public function batchValidate($emails){
        $url = "https://bulkapi.zerobounce.net/v2/validatebatch";
        $params = (object) array(
            'api_key' => $this->api_key,
            'email_batch' => $emails
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "x-token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImhlbnJ5QHplcm9ib3VuY2UubmV0IiwiZXhwIjoxNTk1NzEzNTI1fQ.nzOT-bJ8_tvnrNy3t1DeIDNMXxS-YEvlCbZye-9vpr4",
                "Content-Type: application/json",
                "Cookie: __cfduid=db977bdba3d06a8c9c19b45a92d6221b41572452483"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}