<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $connection = "mysql";
    protected $table = "settings";
    
    function scopeGetValue($query, $name){
        if($query->where('name',$name)->exists())
            return $query->where('name',$name)->first()->value != null ? $query->where('name',$name)->first()->value : '';
        else 
            return '';
    }

    function scopeGetStatusClass($query, $status){
        switch($status){
            case 'approved': 
                return 'badge badge-success';
            break;
            case 'completed': 
                return 'badge badge-success';
            break;
            case 'succeeded': 
                return 'badge badge-success';
            break;
            case 'created':
                return 'badge badge-secondary';
            break;
            case 'requires_payment_method':
                return 'badge badge-secondary';
            break;
            case 'denied':
                return 'badge badge-warning';
            break;
            case 'expired':
                return 'badge badge-danger';
            break;
            case 'failed':
                return 'badge badge-danger';
            break;
            case 'pending':
                return 'badge badge-warning';
            break;
            case 'refunded': 
                return 'badge badge-info';
            break;
            case 'reversed':
                return 'badge badge-secondary';
            break;
            case 'processed':
                return 'badge badge-primary';
            break;
            case 'voided':
                return 'badge badge-secondary';
            break;
            default:
                return '';
        }
    }
    public $timestamps = false;
}
