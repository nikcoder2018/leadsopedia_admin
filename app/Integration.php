<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $connection = "mysql";
    protected $table = "integrations";
    protected $fillable = ['name','app_key','description','image','status','group_id','scope'];

    function attributes_default(){
        return $this->hasMany(IntegrationDataDefault::class, 'integration_id', 'id');
    }
    function keys(){
        return $this->hasMany(IntegrationKey::class, 'integration_id', 'id');
    }
    function group(){
        return $this->hasOne(IntegrationGroup::class, 'id', 'group_id');
    }
}
