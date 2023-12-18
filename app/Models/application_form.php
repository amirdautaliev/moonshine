<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application_form extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'title_kz',
        'title_ru',
        'title_en',
        'file'
    ];
}
