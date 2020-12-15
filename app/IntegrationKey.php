<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrationKey extends Model
{
    protected $table = "integrations_keys";
    protected $fillable = ['integration_id','key','name','description','required'];

    public $timestamps = false;

    function integration(){
        return $this->belongsTo(Integration::class);
    }
    
}
