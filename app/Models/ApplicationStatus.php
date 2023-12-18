<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    use HasFactory;
    const STATUSES = [
        'new' => 1,
        'agreement' => 2,
        'execution' => 3,
        'school_rework' => 4,
        'executor_rework' => 5,
        'accepted' => 6,
        'declined' => 7,
        'draft' => 8
    ];
}
