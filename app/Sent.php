<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sent extends Model
{
    protected $fillable = ['to', 'subject', 'message'];
}
