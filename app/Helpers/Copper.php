<?php 

namespace App\Helpers;

use App\Helpers\Curl;
class Copper{
    public $api_key;
    public $email;
    public $headers;
    public $url = 'https://api.prosperworks.com/developer_api/v1';

    public function __construct($api_key, $email){
        $this->api_key = $api_key;
        $this->email = $email;

        $this->headers = array(
            "X-PW-AccessToken: ".$this->api_key,
            "X-PW-Application: developer_api",
            "X-PW-UserEmail: ".$this->email,
            "Content-Type: application/json",
        );
    }

    public function account(){
        $url = $this->url.'/account';
        $curl = new Curl($url,$this->headers);
        $response = $curl->get();

        //decode the json response
        return json_decode($response, true);
    }

    public function getUserById($id){
        $url = $this->url.'/users/'.$id;
        $curl = new Curl($url,$this->headers);
        $response = $curl->get();
        
        //decode the json response
        return json_decode($response, true);
    }

    public function getUsersList($page_number, $page_size){
        $params = (object) array(
            'page_number' => $page_number,
            'page_size' => $page_size
        );

        $url = $this->url.'/users/search';
        $curl = new Curl($url, $this->headers);
        $response = $curl->post($params);

        //decode the json response
        return json_decode($response, true);
    }

    public function fetchLeadById($id){
        $url = $this->url.'/leads/'.$id;
        $curl = new Curl($url,$this->headers);
        $response = $curl->get();
        
        //decode the json response
        return json_decode($response, true);
    }

    public function newLead($params){
        $url = $this->url.'/leads';
        $curl = new Curl($url, $this->headers);
        $response = $curl->post($params);

        //decode the json response
        return json_decode($response, true);
    }

    public function updateLead($id, $params){
        $url = $this->url.'/leads/'.$id;
        $curl = new Curl($url, $this->headers);
        $response = $curl->put($params);

        //decode the json response
        return json_decode($response, true);
    }

    public function deleteLead($id){
        $url = $this->url.'/leads/'.$id;
        $curl = new Curl($url, $this->headers);
        $response = $curl->delete($params);

        //decode the json response
        return json_decode($response, true);
    }

    public function upsertLead($params){
        $url = $this->url.'/leads/upsert';
        $curl = new Curl($url, $this->headers);
        $response = $curl->put($params);

        //decode the json response
        return json_decode($response, true);
    }

    //TODO Not completed, Work on other APIs
}