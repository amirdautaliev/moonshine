<?php

namespace App\Http\Resources\Investor;

use Illuminate\Http\Resources\Json\JsonResource;

class investor_slider_for_school extends JsonResource
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
            "text_kz" => $this->text_kz,
            "text_ru" => $this->text_ru,
            "text_en" => $this->text_en,
        ];
    }
}
