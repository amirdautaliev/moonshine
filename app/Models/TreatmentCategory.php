<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentCategory extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'title_kz',
        'title_ru',
        'title_en'

    ];
}
