<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrationGroup extends Model
{
    protected $connection = "mysql";
    protected $table = "integrations_groups";
    protected $fillable = ['name'];
}
