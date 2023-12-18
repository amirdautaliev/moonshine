<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCode extends Model
{
    use HasFactory;

    protected $fillable = ['email_address', 'code', 'type'];

    protected $types = [
        1 => 'confirm_email',
        2 => 'reset_password'
    ];
}
