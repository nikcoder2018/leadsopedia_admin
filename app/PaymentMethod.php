<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $connection = "mysql";
    protected $table = "payment_methods";

    protected $fillable = ['name','description'];
    
    public $timestamps = false;

    function details(){
        return $this->hasMany(PaymentMethodData::class, 'method_id', 'id');
    }

    function scopeGetData($query, $name, $key){
        if($query->where('name',$name)->exists()){
            $data = $query->with('details')->where('name',$name)->first();
            foreach($data->details as $d){
               if($d->name == $key){
                   return $d->value;
               } 
            }

            return '';
        } 
        else 
            return '';
    }

    function scopeGetStatusBadge($query, $status){
        switch($status){
            case 'created': 
                return 'badge-primary';
            break;
            case 'approved': 
                return 'badge-info';
            break;
            case 'completed':
                return 'badge-success';
            break; 
            case 'authorize': 
                return 'badge-warining';
            break;
            case 'voided': 
                return 'badge-danger';
            break;
            case 'pending': 
                return 'badge-secondary';
            break;
            default: 
                return '';
        }
    }
}
