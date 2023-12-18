<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email_address' => 'required|string|unique:users,email_address',
            'phone_number' => 'required|string',

            'code' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'login.unique' => 'Пользователь с данным логином уже зарегистрирован',
            'email.unique' => 'Пользователь с данной почтой уже зарегистрирован',
        ];
    }
}
