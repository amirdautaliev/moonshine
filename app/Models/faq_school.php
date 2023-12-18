<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faq_school extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        "question_kz",
        "answer_kz",
        "question_ru",
        "answer_ru",
        "question_en",
        "answer_en",
    ];
}
