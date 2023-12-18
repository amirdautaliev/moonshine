<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'comment_type',
        'type',
        'comment'
    ];
    public const COMMENT_TYPES = [
        'declined' => 1,
        'school_rework' => 2,
        'executor_rework' => 3,
    ];
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
    public function getCommentTypeAttribute($value)
    {
        return array_search($value, self::COMMENT_TYPES);
    }
}
