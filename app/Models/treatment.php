<?php

namespace App\Models;

use App\Models\TreatmentCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class treatment extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'treatment_category_id',
        'description',
        'first_name',
        'middle_name',
        'last_name',
        'status'
    ];


    public function TreatmentCategory(): BelongsTo
    {
        return $this->belongsTo(TreatmentCategory::class);
    }

}
