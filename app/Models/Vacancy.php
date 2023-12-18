<?php

namespace App\Models;

use App\Enums\VacancyStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'post',
        'from',
        'to',
        'file'
    ];

    protected $casts = [
        'status'=> VacancyStatus::class
    ];
}
