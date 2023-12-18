<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'organization_id' => 'sometimes|required|integer|exists:users,id',
            'organization_fields.organization_name' => 'nullable|string',
            'organization_fields.official_number' => 'nullable|string',
            'organization_fields.official_address' => 'nullable|string',
            'organization_fields.postcode' => 'nullable|string',
            'organization_fields.email_address' => 'nullable|string',
            'organization_fields.phone_number' => 'nullable|string',
            'signatory_name' => 'nullable|string',
            'signatory_official_number' => 'nullable|string',
            'signatory_pdf' => 'nullable|file',
            'tuition_fee' => 'nullable|integer',
            'elementary_education' => 'boolean',
            'basic_secondary_education' => 'boolean',
            'basic_general_education' => 'boolean',
            'national_educational_db_registration' => 'nullable|string',
            'state_procurements_registration' => 'nullable|string',
            'boarding_school' => 'nullable|string',
            'student_contingent' => 'nullable|string',
            'students_data_table' => 'nullable|string',
            'predictive_contingent_data_table' => 'nullable|string',
            'boarding_school_students_data_table' => 'nullable|string',
            'boarding_school_predictive_contingent_data_table' => 'nullable|string',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'area_and_street' => 'nullable|string',
            'school_name' => 'nullable|string',
            'place_count' => 'nullable|integer',
            'exploitation_year' => 'nullable|string',
            'private_organization_place_count' => 'nullable|integer',
            'private_organization_exploitation_type' => 'nullable|string',
            'private_organization_exploitation_year' => 'nullable|string',
            'private_organization_government_order' => 'nullable|string',

            'boarding_school_region' => 'nullable|string',
            'boarding_school_city' => 'nullable|string',
            'boarding_school_area_and_street' => 'nullable|string',
            'boarding_school_place_count' => 'nullable|string',
            'boarding_school_exploitation_year' => 'nullable|string',
            'boarding_school_exploitation_type' => 'nullable|string',

//            'education_licence' => 'nullable|file',
//            'legal_entity_certificate' => 'nullable|file',
//            'bank_certificate' => 'nullable|file',
            'education_licence' => 'nullable',
            'legal_entity_certificate' => 'nullable',
            'bank_certificate' => 'nullable',
//            'preliminary_agreement' => 'nullable|file',
//            'immutability_agreement' => 'nullable|file',
//            'real_estate_certificate' => 'nullable|file',
            'preliminary_agreement' => 'nullable',
            'immutability_agreement' => 'nullable',
            'real_estate_certificate' => 'nullable',

            'integrated_education' => 'nullable|string',

            'target_value' => 'nullable|string',
            'encumbrance_date' => 'nullable|string',
            'cadastral_number' => 'nullable|string',

            'boarding_school_target_value' => 'nullable|string',
            'boarding_school_encumbrance_date' => 'nullable|string',
            'boarding_school_cadastral_number' => 'nullable|string',

            'status_id' => 'integer|exists:application_statuses,id',
        ];
    }
}
