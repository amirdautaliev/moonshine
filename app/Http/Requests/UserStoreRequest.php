<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required|string|unique:users,login',
            'password' => 'required|string',
            'role_id' => 'required|integer|exists:roles,id',
            'organization_name' => 'required|string',
            'official_number' => 'required|string',
            'official_address' => 'required|string',
            'actual_address' => 'required|string',
            'ceo_fullname' => 'required|string',
            'ceo_official_number' => 'required|string',
            'email_address' => 'required|string|unique:users,email_address',
            'phone_number' => 'required|string',
            'postcode' => 'required|string',
        ];
    }
}
