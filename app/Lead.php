<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Lead extends Model
{
    protected $connection = "mongodb";
    protected $collection = "leads";
    protected $fillable = ['first_name','last_name','title','company_name','email','phone','website','address','city','state','country', 'linkedin','facebook','messenger','instagram','twitter','google_search','google_map','category'];
}

