<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class documents_forms extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'image',
        'text_kz',
        'text_ru',
        'text_en',
        'link_kz',
        'link_ru',
        'file_kz',
        'file_ru'
    ];
}