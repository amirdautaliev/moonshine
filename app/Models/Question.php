<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name',
        'phone',
        'query',
        'subject_id',
        'status'
    ];
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}       
