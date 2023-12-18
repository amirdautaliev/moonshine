<?php


namespace App\Http\Repositories;


use App\Models\Application;
use App\Models\ApplicationComment;
use App\Models\ApplicationDecline;
use App\Models\ApplicationSchoolRework;
use App\Models\ApplicationStatus;
use App\Models\Role;
use App\Models\User;
use App\Services\NCANode\Client;
use App\Services\NCANode\Xml;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class ApplicationRepository
{
    public function index(Request $request)
    {
        $data = Application::query();
        if (auth()->user()->role_id == Role::ROLES['school'])
            $data->where('organization_id', auth()->id());
        else if (auth()->user()->role_id == Role::ROLES['apd_specialist'])
            $data->where('current_executor_id', auth()->id());
        else if (auth()->user()->role_id == Role::ROLES['apd_main_specialist'])
            $data->where('current_executor_id', auth()->id());
        else if (auth()->user()->role_id == Role::ROLES['dbf_specialist'])
            $data->where('dbf_current_executor_id', auth()->id());
        else if (auth()->user()->role_id == Role::ROLES['dbf_main_specialist'])
            $data->where('dbf_current_executor_id', auth()->id());

        if ($request->has('date'))
            $data->whereDate('created_at', $request->date);
        if ($request->has('status_id'))
            $data->where('status_id', $request->status_id);
        if ($request->has('type')) // main/additional
            $data->where('type', Application::TYPES[$request->type]);
        if ($request->has('current_executor_id'))
            $data->where(function ($query) use ($request) {
                $query->where('current_executor_id', $request->current_executor_id)
                    ->orWhere('dbf_current_executor_id', $request->current_executor_id);
            });

        return $data->orderBy('id', 'desc')->paginate(20);
    }

    public function show(Application $application)
    {
        return $application;
    }

    public function store(array $data)
    {
        $organizationFields = $data['organization_fields'];
        User::query()->find($data['organization_id'])->update($organizationFields);
        return Application::query()->create(array_merge($data, [
            'type' => 2,
            'organization_name' => $organizationFields['organization_name'],
            'official_number' => $organizationFields['official_number'],
            'official_address' => $organizationFields['official_address'],
            'postcode' => $organizationFields['postcode'],
            'email_address' => $organizationFields['email_address'],
            'phone_number' => $organizationFields['phone_number'],
            'dbf_status_id' => $data['status_id']
        ])); // доп перечень, TODO: переделать получение типа заявки
    }

    public function update(array $data, Application $application)
    {
        $application->update($data);
        ApplicationComment::query()->where('application_id', $application->id)->delete();
        return $application;
    }

    public function delete(Application $application)
    {
        $application->delete();
        return response('Запись успешно удалена');
    }

    public function setExecutors(int $executorId, ?int $mainExecutorId, string $department, Application $application)
    {
        if ($department == 'apd') {
            $application->update([
                'executor_id' => $executorId,
                'main_executor_id' => $mainExecutorId,
                'current_executor_id' => $executorId,
                'status_id' => ApplicationStatus::STATUSES['execution']
            ]);
        }
        else if ($department == 'dbf') {
            $application->update([
                'dbf_executor_id' => $executorId,
                'dbf_main_executor_id' => $mainExecutorId,
                'dbf_current_executor_id' => $executorId,
                'dbf_status_id' => ApplicationStatus::STATUSES['execution']
            ]);
        }
        return $application;
    }
    public function getExecutors(string $department)
    {
        return User::query()->where('role_id', Role::ROLES[$department . '_specialist'])->get();
    }
    public function getMainExecutors(string $department)
    {
        return User::query()->where('role_id', Role::ROLES[$department . '_main_specialist'])->get();
    }
    public function getPdf(Application $application)
    {
        $pdf = Pdf::loadView('application', [
            'application' => $application,
            'organization' => $application->organization
        ]);
        return $pdf->download();
    }
    public function getDeclinePdf(Application $application)
    {
        $pdf = Pdf::loadView('application-decline', [
            'application' => $application,
            'comment' => $application->comments()->orderBy('id', 'desc')->first(),
        ]);
        return $pdf->download();
    }
    public function previewDeclinePdf(Application $application, ApplicationComment $comment)
    {
        $pdf = Pdf::loadView('application-decline', [
            'application' => $application,
            'comment' => $comment,
        ]);
        return $pdf->download();
    }
    public function getAcceptPdf(Application $application)
    {
        if ($application->status_id != ApplicationStatus::STATUSES['accepted'])
            return response('Заявление не принято');

        $pdf = Pdf::loadView('application-accept', [
            'application' => $application,
        ]);
        return $pdf->download();
    }
    public function declineOrSchoolRework(array $data, Application $application, string $type)
    {
        $roleId = auth()->user()->role_id;
        if ($roleId == Role::ROLES['apd_main_specialist']
            || ($roleId == Role::ROLES['apd_specialist'] && $application->approved)) { // если заявка подтверждена, значит спец отправляет ее обратно директору в виде письма
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['agreement'],
                'current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id
            ]);
        }
        else if ($roleId == Role::ROLES['dbf_main_specialist']
            || ($roleId == Role::ROLES['dbf_specialist'] && $application->approved)) { // если заявка подтверждена, значит спец отправляет ее обратно директору в виде письма
            $application->update([
                'dbf_status_id' => ApplicationStatus::STATUSES['agreement'],
                'dbf_current_executor_id' => User::query()->where('role_id', Role::ROLES['dbf_director'])->first()->id
            ]);
        }
        else if ($roleId == Role::ROLES['apd_specialist']) {
            if ($application->main_executor_id) {
                $application->update([
                    'status_id' => ApplicationStatus::STATUSES['execution'],
                    'current_executor_id' => $application->main_executor_id
                ]);
            }
            else {
                $application->update([
                    'status_id' => ApplicationStatus::STATUSES['agreement'],
                    'current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id
                ]);
            }
        }
        else if ($roleId == Role::ROLES['dbf_specialist']) {
            if ($application->main_executor_id) {
                $application->update([
                    'dbf_status_id' => ApplicationStatus::STATUSES['execution'],
                    'dbf_current_executor_id' => $application->dbf_main_executor_id
                ]);
            }
            else {
                $application->update([
                    'dbf_status_id' => ApplicationStatus::STATUSES['agreement'],
                    'dbf_current_executor_id' => User::query()->where('role_id', Role::ROLES['dbf_director'])->first()->id
                ]);
            }
        }
        ApplicationComment::query()->create(array_merge($data, [
            'application_id' => $application->id,
            'comment_type' => ApplicationComment::COMMENT_TYPES[$type]
        ]));
        return $application;
    }

    public function approveDeclineOrSchoolRework(Application $application, string $status)
    {
        $roleId = auth()->user()->role_id;
        if ($roleId == Role::ROLES['apd_director']) {
            if ($application->approved) {
                $application->update([
                    'current_executor_id' => null,
                    'status_id' => ApplicationStatus::STATUSES[$status],
                    'approved' => null,
                    'reworked' => $status == 'school_rework' ? true : null
                ]);
            }
            else {
                $application->update([
                    'current_executor_id' => $application->executor_id,
                    'status_id' => ApplicationStatus::STATUSES['execution'],
                    'approved' => true
                ]);
            }
        }
        else if ($roleId == Role::ROLES['dbf_director']) {
            if ($application->approved) {
                $application->update([
                    'current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id,
                    'status_id' => ApplicationStatus::STATUSES['agreement'],
                ]);
            }
            else {
                $application->update([
                    'dbf_current_executor_id' => $application->dbf_executor_id,
                    'dbf_status_id' => ApplicationStatus::STATUSES['execution'],
                    'approved' => true
                ]);
            }
        }
        return $application;
    }
    public function getSchoolReworkPdf(Application $application)
    {
        $pdf = Pdf::loadView('application-rework', [
            'application' => $application,
            'comment' => $application->comments()->orderBy('id', 'desc')->first(),
        ]);
        return $pdf->download();
    }
    public function previewSchoolReworkPdf(Application $application, ApplicationComment $comment)
    {
        $pdf = Pdf::loadView('application-rework', [
            'application' => $application,
            'comment' => $comment,
        ]);
        return $pdf->download();
    }
    public function edsSign(string $xml)
    {
//        $edsResponse = (new Xml(new Client()))->verify($xml); // получаем данные из ключа
//
//        if ($edsResponse->certificate->keyUsage != 'SIGN')
//            return response('Неверный ключ', 422);
//
//        $edsUser = $edsResponse->certificate->subject;
//        if (auth()->user()->official_number != trim($edsUser->iin)) // если ИИНы не совпадают
//            return response('Ошибка авторизации(не совпадает ИИН)', 422);

        return response('Подписание прошло успешно');
    }
    public function schoolEdsSign(string $signatoryOfficialNumber, string $officialNumber, string $xml)
    {
//        $edsResponse = (new Xml(new Client()))->verify($xml); // получаем данные из ключа
//
//        if ($edsResponse->certificate->keyUsage != 'SIGN')
//            return response('Неверный ключ', 422);
//
//        $edsUser = $edsResponse->certificate->subject;
//        $bin = substr($edsUser->dn, strpos($edsUser->dn, 'OU=BIN') + 6, 12); // достаем БИН
//
//        if ($signatoryOfficialNumber != trim($edsUser->iin)) // если ИИНы не совпадают
//            return response('Ошибка авторизации(не совпадает ИИН)', 422);
//
//        if ($officialNumber != trim($bin)) // если БИНы не совпадают
//            return response('Ошибка авторизации(не совпадает БИН)', 422);

        return response('Подписание прошло успешно');
    }
    public function executorRework(array $data, Application $application)
    {
        $roleId = auth()->user()->role_id;
        if ($roleId == Role::ROLES['apd_director']) {
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['executor_rework'],
                'current_executor_id' => $application->main_executor_id,
            ]);
        }
        else if ($roleId == Role::ROLES['apd_main_specialist']) {
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['executor_rework'],
                'current_executor_id' => $application->executor_id,
            ]);
        }
        ApplicationComment::query()->create(array_merge($data, [
            'application_id' => $application->id,
            'comment_type' => ApplicationComment::COMMENT_TYPES['executor_rework']
        ]));
        return $application;
    }
    public function accept(Application $application) {
        $roleId = auth()->user()->role_id;
        if ($roleId == Role::ROLES['apd_specialist']) // заявка у спеца -> передаем главному
        {
            if ($application->main_executor_id) {
                $application->update([
                    'current_executor_id' => $application->main_executor_id
                ]);
            }
            else { // если глав спеца нет, передаем директору
                $application->update([
                    'current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id,
                    'status_id' => ApplicationStatus::STATUSES['agreement']
                ]);
            }
        }
        else if ($roleId == Role::ROLES['apd_main_specialist']) // заявка у гл. спеца -> передаем директору
        {
            $application->update([
                'current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id,
                'status_id' => ApplicationStatus::STATUSES['agreement']
            ]);
        }
        else if ($roleId == Role::ROLES['dbf_specialist']) // заявка у спеца -> передаем главному
        {
            if ($application->main_executor_id) {
                $application->update([
                    'dbf_current_executor_id' => $application->dbf_main_executor_id
                ]);
            }
            else { // если глав спеца нет, передаем директору
                $application->update([
                    'dbf_current_executor_id' => User::query()->where('role_id', Role::ROLES['dbf_director'])->first()->id,
                    'dbf_status_id' => ApplicationStatus::STATUSES['agreement']
                ]);
            }
        }
        else if ($roleId == Role::ROLES['dbf_main_specialist']) // заявка у гл. спеца -> передаем директору
        {
            $application->update([
                'dbf_current_executor_id' => User::query()->where('role_id', Role::ROLES['dbf_director'])->first()->id,
                'dbf_status_id' => ApplicationStatus::STATUSES['agreement']
            ]);
        }
        else if ($roleId == Role::ROLES['dbf_director']) // заявка у дбф дира -> передаем директору апд
        {
            $application->update([
                'dbf_current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id,
                'status_id' => ApplicationStatus::STATUSES['agreement']
            ]);
        }
        else // если согласовывает директор
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['accepted'],
                'current_executor_id' => null,
            ]);
        return $application;
    }

    #region LEGACY METHODS
    public function schoolRework(array $data, Application $application)
    {
        $roleId = auth()->user()->role_id;
        if ($roleId == Role::ROLES['apd_main_specialist']
            || ($roleId == Role::ROLES['apd_specialist'] && $application->approved)) { // если заявка подтверждена, значит спец отправляет ее обратно директору в виде письма
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['agreement'],
                'current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id
            ]);
        }
        else if ($roleId == Role::ROLES['apd_specialist']) {
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['execution'],
                'current_executor_id' => $application->main_executor_id
            ]);
        }
        ApplicationComment::query()->create(array_merge($data, [
            'application_id' => $application->id,
            'comment_type' => ApplicationComment::COMMENT_TYPES['school_rework']
        ]));
        return $application;
    }
    public function approveSchoolRework(Application $application) {
        if ($application->approved) {
            $application->update([
                'current_executor_id' => null,
                'status_id' => ApplicationStatus::STATUSES['school_rework'],
                'reworked' => true,
                'approved' => null
            ]);
        }
        else {
            $application->update([
                'current_executor_id' => $application->executor_ids[0],
                'status_id' => ApplicationStatus::STATUSES['execution'],
                'approved' => true
            ]);
        }
        return $application;
    }
    public function decline(array $data, Application $application)
    {
        $roleId = auth()->user()->role_id;
        if ($roleId == Role::ROLES['apd_main_specialist']
            || ($roleId == Role::ROLES['apd_specialist'] && $application->approved)) { // если заявка подтверждена, значит спец отправляет ее обратно директору в виде письма
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['agreement'],
                'current_executor_id' => User::query()->where('role_id', Role::ROLES['apd_director'])->first()->id
            ]);
        }
        else if ($roleId == Role::ROLES['apd_specialist']) {
            $application->update([
                'status_id' => ApplicationStatus::STATUSES['execution'],
                'current_executor_id' => $application->main_executor_id
            ]);
        }
        ApplicationComment::query()->create(array_merge($data, [
            'application_id' => $application->id,
            'comment_type' => ApplicationComment::COMMENT_TYPES['declined']
        ]));
        return $application;
    }
    public function approveDecline(Application $application)
    {
        if ($application->approved) {
            $application->update([
                'current_executor_id' => null,
                'status_id' => ApplicationStatus::STATUSES['declined'],
            ]);
        }
        else {
            $application->update([
                'current_executor_id' => $application->executor_ids[0],
                'status_id' => ApplicationStatus::STATUSES['execution'],
                'approved' => true
            ]);
        }
        return $application;
    }
    #endregion
}
