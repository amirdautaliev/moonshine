<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code'];
    public $timestamps = false;

    const ROLES = [
        'school' => 1,
        'super_admin' => 2,

        'apd_director' => 3,
        'apd_specialist' => 4,
        'apd_main_specialist' => 5,

        'dbf_director' => 6,
        'dbf_specialist' => 7,
        'dbf_main_specialist' => 8,
    ];
}
