<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_of_school extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'text_kz',
        'text_ru',
        'text_en',
        'file'
    ];
}
