<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'school_name' => 'sometimes|required|string',
            'actual_address' => 'sometimes|required|string',
            'organization_id' => 'sometimes|required|integer|exists:users,id'
        ];
    }
}
