<?php 

namespace App\Helpers;

class HubspotContactList{
    public $api_key;
    public $url = 'https://api.hubapi.com/contacts/v1';

    public function __construct($api_key){
        $this->api_key = $api_key;
    }

    public function take($count){
        $url = $this->url.'/lists?count='.$count.'&hapikey='.$this->api_key;
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
        $url = $this->url.'/lists/'.$id.'?hapikey='.$this->api_key;
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

    public function getByBatch($ids){

        $params  = join('&',array_map(function($value){
            return "listId=".$value;
        },$ids));

        if(empty($ids))
            die('List Ids required for this method.');

        $url = $this->url.'/lists/batch?'.$params.'&hapikey='.$this->api_key;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    public function getStaticLists($count){
        $url = $this->url.'/lists/static?count='.$count.'&hapikey='.$this->api_key;
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

    public function getDynamicLists($count){
        $url = $this->url.'/lists/dynamic?count='.$count.'&hapikey='.$this->api_key;
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

    public function getContacts($id, $count=null,$offset=null,$property=null,$mode=null,$formsubmode=null,$membership=false){
        $url = $this->url.'/lists/'.$id.'/contacts/all?hapikey='.$this->api_key;
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
    
    public function getRecentContacts($id, $count=null,$offset=null,$property=null,$mode=null,$formsubmode=null,$membership=false){
        $url = $this->url.'/lists/'.$id.'/contacts/recent?hapikey='.$this->api_key;
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

    public function add($name){
        $url = $this->url.'/lists?hapikey='.$this->api_key;
        $params = (object) array(
            'name' => $name
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

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function update($id, $params){ // TODO not yet working
        $url = $this->url.'/lists/'.$id.'?hapikey='.$this->api_key;
        
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

    public function delete($id){
        $url = $this->url.'/lists/'.$id.'?hapikey='.$this->api_key;
        
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

    
    public function addContacts($id, $vids, $emails){
        $url = $this->url.'/lists/'.$id.'/add?hapikey='.$this->api_key;

        $params = (object) [
            "vids" => $vids,
            "emails" => $emails
        ];

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

    public function removeContacts($id, $vids){
        $url = $this->url.'/lists/'.$id.'/remove?hapikey='.$this->api_key;

        $params = (object) [
            "vids" => $vids
        ];

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

}