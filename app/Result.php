<?php

namespace App;
use App\Lead;
use Jenssegers\Mongodb\Eloquent\Model;

class Result extends Model
{
    protected $connection = "mongodb";
    protected $collection = "results";

    protected $primaryKey = "_id";
    protected $fillable = ['user_id','keyword','city', 'type'];

    public function getLeadsAttribute(){
        $leads_ids = array_map(function($data){
            return $data['_id'];
        },$this->data);

        return Lead::wherein('_id', $leads_ids)->get();
    }
}
