<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chairman_blog extends Model
{
    use HasFactory;



    public function TreatmentCategory(): BelongsTo
    {
        return $this->belongsTo(TreatmentCategory::class);
    }

}
