<?php

namespace App\Http\Resources\Investor;

use Illuminate\Http\Resources\Json\JsonResource;

class investor_important_documents_for_school extends JsonResource
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
            "link_kz"      => $this->link_kz,
            "link_ru"      => $this->link_ru,
            "link_en"      => $this->link_en,
            "bank_file_kz" => $this->bank_file_kz,
            "bank_file_ru" => $this->bank_file_kz,
            "bank_file_en" => $this->bank_file_kz,
            "npa_file"     => $this->npa_file
        ];
    }
}
