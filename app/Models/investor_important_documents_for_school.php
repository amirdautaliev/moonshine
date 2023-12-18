<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investor_important_documents_for_school extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'link_kz',
        'link_ru',
        'link_en',
        'bank_file_kz',
        'bank_file_ru',
        'bank_file_en',
        'npa_file'

    ];
}
