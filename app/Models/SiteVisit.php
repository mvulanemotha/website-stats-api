<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    use HasFactory;

    protected $table = 'site_visit';
    protected $fillable = ['ip' , 'page' , 'location' , 'date'];
}
