<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investor_region extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'region_name_ru',
        'region_name_ru',
        'region_name_en',
    ];

}
