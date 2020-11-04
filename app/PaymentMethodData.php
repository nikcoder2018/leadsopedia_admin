<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodData extends Model
{
    protected $connection = "mysql";
    protected $table = "payment_methods_data";

    protected $fillable = ['method_id','name','value','visibility'];
    
    public $timestamps = false;

    function gateway(){
        return $this->belongsTo(PaymentMethod::class, 'id', 'method_id');
    }
}
