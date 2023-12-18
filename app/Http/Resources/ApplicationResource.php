<?php

namespace App\Http\Resources;

use App\Models\Application;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ApplicationResource
 * @package App\Http\Resources
 * @mixin Application
 */
class ApplicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'organization' => new UserResource($this->organization),
            'organization_fields' => [
                'organization_name' => $this->organization_name,
                'official_number' => $this->official_number,
                'official_address' => $this->official_address,
                'postcode' => $this->postcode,
                'email_address' => $this->email_address,
                'phone_number' => $this->phone_number,
            ],
            'signatory_name' => $this->signatory_name,
            'signatory_official_number' => $this->signatory_official_number,
            'signatory_pdf' => $this->signatory_pdf,
            'tuition_fee' => $this->tuition_fee,
            'elementary_education' => $this->elementary_education,
            'basic_secondary_education' => $this->basic_secondary_education,
            'basic_general_education' => $this->basic_general_education,
            'national_educational_db_registration' => $this->national_educational_db_registration,
            'state_procurements_registration' => $this->state_procurements_registration,
            'boarding_school' => $this->boarding_school,
            'student_contingent' => $this->student_contingent,
            'students_data_table' => $this->students_data_table,
            'predictive_contingent_data_table' => $this->predictive_contingent_data_table,
            'boarding_school_students_data_table' => $this->boarding_school_students_data_table,
            'boarding_school_predictive_contingent_data_table' => $this->boarding_school_predictive_contingent_data_table,
            'region' => $this->region,
            'city' => $this->city,
            'area_and_street' => $this->area_and_street,
            'school_name' => $this->school_name,
            'place_count' => $this->place_count,
            'exploitation_year' => $this->exploitation_year,
            'private_organization_place_count' => $this->private_organization_place_count,
            'private_organization_exploitation_type' => $this->private_organization_exploitation_type,
            'private_organization_exploitation_year' => $this->private_organization_exploitation_year,
            'private_organization_government_order' => $this->private_organization_government_order,
            'boarding_school_region' => $this->boarding_school_region,
            'boarding_school_city' => $this->boarding_school_city,
            'boarding_school_area_and_street' => $this->boarding_school_area_and_street,
            'boarding_school_place_count' => $this->boarding_school_place_count,
            'boarding_school_exploitation_year' => $this->boarding_school_exploitation_year,
            'boarding_school_exploitation_type' => $this->boarding_school_exploitation_type,
            'education_licence' => $this->education_licence,
            'legal_entity_certificate' => $this->legal_entity_certificate,
            'bank_certificate' => $this->bank_certificate,
            'preliminary_agreement' => $this->preliminary_agreement,
            'immutability_agreement' => $this->immutability_agreement,
            'real_estate_certificate' => $this->real_estate_certificate,
            'status' => $this->status,
            'executor_id' => $this->executor_id,
            'main_executor_id' => $this->main_executor_id,
            'current_executor' => $this->currentExecutor,
            'integrated_education' => $this->integrated_education,
            'target_value' => $this->target_value,
            'encumbrance_date' => $this->encumbrance_date,
            'cadastral_number' => $this->cadastral_number,
            'boarding_school_target_value' => $this->boarding_school_target_value,
            'boarding_school_encumbrance_date' => $this->boarding_school_encumbrance_date,
            'boarding_school_cadastral_number' => $this->boarding_school_cadastral_number,
            'type' => $this->type,
            'review_period' => $this->created_at->addDays(15)->format('d.m.Y'),
            'current_state' => $this->current_state,
            'comment' => $this->comments()->orderBy('id', 'desc')->first(), // получаем самый актуальный комментарий
            'created_at' => $this->created_at->format('d.m.Y H:i'),
            'displayed_status' => $this->getDisplayedStatus('apd'),
            'approved' => $this->approved,
            'reworked' => $this->reworked,

            'dbf_status' => $this->dbfStatus,
            'dbf_executor_id' => $this->dbf_executor_id,
            'dbf_main_executor_id' => $this->dbf_main_executor_id,
            'dbf_current_executor' => $this->dbfCurrentExecutor,
            'dbf_displayed_status' => $this->getDisplayedStatus('dbf'),
        ];
    }
}
