<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifiedEmail extends Model
{
    protected $connection = "mongodb";
    protected $collection = "verified_emails";
    protected $fillable = ['user_id','email_address', 'status', 'credits'];
}
