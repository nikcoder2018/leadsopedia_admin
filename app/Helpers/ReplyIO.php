<?php 

namespace App\Helpers;

class ReplyIO{
    public $api_key;
    public $urlV1 = 'https://api.reply.io/v1';
    public $urlV2 = 'https://api.reply.io/v2';

    public function __construct($api_key){
        $this->api_key = $api_key;
    }

    function getCampaignByName($name){
        $url = $this->urlV1.'/campaigns?name='.$name;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getCampaignById($id){
        $url = $this->urlV1.'/campaigns?id='.$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getAllSchedules(){
        $url = $this->urlV2.'/schedules';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getDefaultSchedules(){
        $url = $this->urlV2.'/schedules/default';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getCampaigns(){
        $url = $this->urlV1.'/campaigns';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getContacts(){
        $url = $this->urlV1.'/people';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getContactById($id){
        $url = $this->urlV1.'/people?id='.$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getContactByEmail($email){
        $url = $this->urlV1.'/people?email='.$email;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getTemplateById($id){
        $url = $this->urlV1.'/templates?id='.$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getTemplates(){
        $url = $this->urlV1.'/templates';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getContactStat($email){
        $url = $this->urlV1.'/stats/person?=email'.$email;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function getEmailAccounts(){
        $url = $this->urlV1.'/emailAccounts';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, env('CURL_SSL', FALSE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "x-api-key: ".$this->api_key,
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        //decode the json response
        return json_decode($response, true);
    }

    function createCampaign(){
        //TODO Create Campaign Code Here
    }


}