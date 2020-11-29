<?php 

namespace App\Helpers;

class HubspotContact{
    public $api_key;
    public $url = 'https://api.hubapi.com/contacts/v1';

    public function __construct($api_key){
        $this->api_key = $api_key;
    }

    public function create($properties){
        $params = (object) array('properties'=>$properties);

        $url = $this->url.'/contact?hapikey='.$this->api_key;

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
            "Content-Type: application/json",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function createOrUpdate($email, $properties){
        $params = (object) array('properties'=>$properties);

        $url = $this->url.'/contact/createOrUpdate/email/'.$email.'/?hapikey='.$this->api_key;

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
            "Content-Type: application/json",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function createOrUpdateBatch($params){
        $url = $this->url.'/contact/batch/?hapikey='.$this->api_key;

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
            "Content-Type: application/json",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    public function all(){
        $url = $this->url.'/lists/all/contacts/all?hapikey='.$this->api_key;
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

    public function recentModified(){
        $url = $this->url.'/lists/recently_updated/contacts/recent?hapikey='.$this->api_key;
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

    public function recentAdded(){
        $url = $this->url.'/lists/all/contacts/recent?hapikey='.$this->api_key;
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

    public function getById($id){
        $url = $this->url.'/contact/vid/'.$id.'/profile?hapikey='.$this->api_key;
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

    public function getByEmail($email){
        $url = $this->url.'/contact/email/'.$email.'/profile?hapikey='.$this->api_key;
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

    public function update($id, $properties){
        $params = (object) array('properties'=>$properties);

        $url = $this->url.'/contact/vid/'.$id.'/profile?hapikey='.$this->api_key;

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
            "Content-Type: application/json",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    public function updateByEmail($email, $properties){
        $params = (object) array('properties'=>$properties);

        $url = $this->url.'/contact/email/'.$email.'/profile?hapikey='.$this->api_key;

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
            "Content-Type: application/json",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return true;
    }
    
    public function delete($id){
        $url = $this->url.'/contact/vid/'.$id.'?hapikey='.$this->api_key;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

}