<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoAssignmentPair extends Model
{
    use HasFactory;
    protected $fillable = [
        'executor_id',
        'main_executor_id',
        'department',
    ];
}
