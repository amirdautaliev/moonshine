<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources
 * @mixin User
 */
class UserResource extends JsonResource
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
            'id' => $this->id,
            'login' => $this->login,
            'role' => $this->role,
            'organization_name' => $this->organization_name,
            'official_number' => $this->official_number,
            'official_address' => $this->official_address,
            'actual_address' => $this->actual_address,
            'ceo_fullname' => $this->ceo_fullname,
            'ceo_official_number' => $this->ceo_official_number,
            'email_address' => $this->email_address,
            'phone_number' => $this->phone_number,
            'postcode' => $this->postcode,
            'created_at' => $this->created_at
        ];
    }
}
