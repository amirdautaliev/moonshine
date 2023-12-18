<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'sometimes|required|string|unique:users,login,' . $this->user->id,
            'role_id' => 'sometimes|required|integer|exists:roles,id',
            'organization_name' => 'sometimes|required|string',
            'official_number' => 'sometimes|required|string',
            'official_address' => 'sometimes|required|string',
            'actual_address' => 'sometimes|required|string',
            'ceo_fullname' => 'sometimes|required|string',
            'ceo_official_number' => 'sometimes|required|string',
            'email_address' => 'sometimes|required|string|unique:users,email_address,' . $this->user->id,
            'phone_number' => 'sometimes|required|string',
            'postcode' => 'sometimes|required|string',
        ];
    }
}
