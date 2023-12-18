<?php

namespace App\Http\Resources;

use App\Models\Crud;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CrudResource
 * @package App\Http\Resources
 * @mixin Crud
 */
class CrudResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
        'id'       => $this->id,
        'text_kz'  => $this->text_kz,
        'text_ru'  => $this->text_ru,
        'text_en'  => $this->text_en,
        'link'     => $this->link,
        'image'    => $this->image
        ];
    }
}
