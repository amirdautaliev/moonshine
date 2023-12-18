<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class investor_map_for_school extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'investor_region_id',
        'need',
        'entered_objects'
    ];



    public function subject(): BelongsTo
    {
        return $this->belongsTo(investor_region::class);
    }


}
