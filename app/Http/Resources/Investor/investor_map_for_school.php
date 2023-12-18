<?php

namespace App\Http\Resources\Investor;

use Illuminate\Http\Resources\Json\JsonResource;

class investor_map_for_school extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return 
        [
        "investor_region_id" => $this->investor_region_id,
        "need"               => $this->need,
        "entered_objects"    => $this->entered_objects,
        ];
    }
}
