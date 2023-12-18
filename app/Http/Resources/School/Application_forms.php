<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Resources\Json\JsonResource;

class Application_forms extends JsonResource
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
            "title_kz" => $this->title_kz,
            "title_ru" => $this->title_ru,
            "title_en" => $this->title_en,
            "file"     => $this->file 
        ];
    }
}
