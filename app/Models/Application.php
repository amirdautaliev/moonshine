<?php

namespace App\Models;

use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id',
        'organization_name',
        'official_number',
        'official_address',
        'postcode',
        'signatory_name',
        'signatory_official_number',
        'email_address',
        'phone_number',
        'signatory_pdf',
        'tuition_fee',
        'elementary_education',
        'basic_secondary_education',
        'basic_general_education',
        'national_educational_db_registration',
        'state_procurements_registration',
        'boarding_school',
        'student_contingent',
        'students_data_table',
        'predictive_contingent_data_table',
        'boarding_school_students_data_table',
        'boarding_school_predictive_contingent_data_table',
        'region',
        'city',
        'area_and_street',
        'school_name',
        'place_count',
        'exploitation_year',
        'private_organization_place_count',
        'private_organization_exploitation_type',
        'private_organization_exploitation_year',
        'private_organization_government_order',
        'boarding_school_region',
        'boarding_school_city',
        'boarding_school_area_and_street',
        'boarding_school_place_count',
        'boarding_school_exploitation_year',
        'boarding_school_exploitation_type',
        'education_licence',
        'legal_entity_certificate',
        'bank_certificate',
        'preliminary_agreement',
        'immutability_agreement',
        'real_estate_certificate',
        'status_id',
        'type',

        'executor_id',
        'main_executor_id',
        'current_executor_id',

        'dbf_executor_id',
        'dbf_main_executor_id',
        'dbf_current_executor_id',
        'dbf_status_id',


        'integrated_education',
        'target_value',
        'encumbrance_date',
        'cadastral_number',

        'boarding_school_target_value',
        'boarding_school_encumbrance_date',
        'boarding_school_cadastral_number',

        'approved',
        'reworked',
    ];

    const TYPES = [
        'main' => 1,
        'additional' => 2
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class);
    }
    public function dbfStatus(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class);
    }
    public function decline(): HasOne
    {
        return $this->hasOne(ApplicationDecline::class);
    }
    public function schoolRework(): HasOne
    {
        return $this->hasOne(ApplicationSchoolRework::class);
    }
    public function currentExecutor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function dbfCurrentExecutor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setSignatoryPdfAttribute($value)
    {
        $this->attributes['signatory_pdf'] = FileService::processFile($value, 'signatories');
    }
    public function setEducationLicenceAttribute($value)
    {
        $this->attributes['education_licence'] = FileService::processFile($value, 'education-licences');
    }
    public function setLegalEntityCertificateAttribute($value)
    {
        $this->attributes['legal_entity_certificate'] = FileService::processFile($value, 'legal-entity-certificates');
    }
    public function setBankCertificateAttribute($value)
    {
        $this->attributes['bank_certificate'] = FileService::processFile($value, 'bank-certificates');
    }
    public function setPreliminaryAgreementAttribute($value)
    {
        $this->attributes['preliminary_agreement'] = FileService::processFile($value, 'preliminary-agreements');
    }
    public function setImmutabilityAgreementAttribute($value)
    {
        $this->attributes['immutability_agreement'] = FileService::processFile($value, 'immutability-agreement');
    }
    public function setRealEstateCertificateAttribute($value)
    {
        $this->attributes['real_estate_certificate'] = FileService::processFile($value, 'real-estate-certificates');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(ApplicationComment::class);
    }
    public function getDisplayedStatus($department)
    {
        $status = $this->status_id;
        if ($department == 'dbf')
            $status = $this->dbf_status_id;

        $schoolStatuses = [
             'Отправлена' => ApplicationStatus::STATUSES['new'],
             'Принята' => ApplicationStatus::STATUSES['accepted'],
             'На доработку' => ApplicationStatus::STATUSES['school_rework'],
             'Отклонена' => ApplicationStatus::STATUSES['declined'],
        ];
        $innerStatuses = [
             'Новая' => ApplicationStatus::STATUSES['new'],
             'На исполнении' => ApplicationStatus::STATUSES['execution'],
             'На согласовании' => ApplicationStatus::STATUSES['agreement'],
             'Принята' => ApplicationStatus::STATUSES['accepted'],
             'Отклонена' => ApplicationStatus::STATUSES['declined'],
             'На доработке у школы' => ApplicationStatus::STATUSES['school_rework'],
             'На доработке у исполнителя' => ApplicationStatus::STATUSES['executor_rework'],
        ];

        if(auth()->user()->role_id == Role::ROLES['school'])
            return array_search($status, $schoolStatuses) == false
                ? 'Отправлена' // default displayed status for schools
                : array_search($status, $schoolStatuses);

        if(auth()->user()->role_id != Role::ROLES['school'] && $this->reworked && $status == ApplicationStatus::STATUSES['new'])
            return 'Новая (после доработки)';


        return array_search($status, $innerStatuses);
    }
}
