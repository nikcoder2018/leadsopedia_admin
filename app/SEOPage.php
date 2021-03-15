<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SEOPage extends Model
{
    protected $table = 'seo_pages';
    protected $fillable = ['path', 'title', 'description', 'keywords'];
}
