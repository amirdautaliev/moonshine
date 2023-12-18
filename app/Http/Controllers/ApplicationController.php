<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ApplicationRepository;
use App\Http\Requests\ApplicationCommentStoreRequest;
use App\Http\Requests\ApplicationStoreRequest;
use App\Http\Requests\ApplicationUpdateRequest;
use App\Http\Requests\EdsRequest;
use App\Http\Requests\SchoolEdsRequest;
use App\Http\Requests\SchoolReworkApplicationRequest;
use App\Http\Requests\SetExecutorsRequest;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\UserResource;
use App\Models\Application;
use App\Models\ApplicationComment;
use App\Models\ApplicationDecline;
use App\Models\ApplicationSchoolRework;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    private $repository;

    public function __construct(ApplicationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return ApplicationResource::collection($this->repository->index($request));
    }

    public function show(Application $application)
    {
        return new ApplicationResource($this->repository->show($application));
    }

    public function store(ApplicationStoreRequest $request)
    {
        return new ApplicationResource($this->repository->store($request->validated()));
    }

    public function update(ApplicationUpdateRequest $request, Application $application)
    {
        return new ApplicationResource($this->repository->update($request->validated(), $application));
    }

    public function delete(Application $application)
    {
        return $this->repository->delete($application);
    }
    public function setExecutors(SetExecutorsRequest $request, string $department, Application $application)
    {
        return new ApplicationResource($this->repository->setExecutors($request->executor_id, $request->main_executor_id, $department, $application));
    }
    public function getExecutors(string $department)
    {
        return UserResource::collection($this->repository->getExecutors($department));
    }
    public function getMainExecutors(string $department)
    {
        return UserResource::collection($this->repository->getMainExecutors($department));
    }
    public function getPdf(Application $application)
    {
        return $this->repository->getPdf($application);
    }
    public function previewPdf(ApplicationStoreRequest $request)
    {
        $application = new Application();
        $application->fill($request->validated());
        return $this->repository->getPdf($application);
    }
    public function decline(ApplicationCommentStoreRequest $request, Application $application)
    {
        return new ApplicationResource($this->repository->declineOrSchoolRework($request->validated(), $application, 'declined'));
    }
    public function approveDecline(Application $application)
    {
        return new ApplicationResource($this->repository->approveDeclineOrSchoolRework($application, 'declined'));
    }
    public function getDeclinePdf(Application $application)
    {
        return $this->repository->getDeclinePdf($application);
    }
    public function previewDeclinePdf(Application $application, ApplicationCommentStoreRequest $request)
    {
        $comment = new ApplicationComment();
        $comment->fill($request->validated());
        return $this->repository->previewDeclinePdf($application, $comment);
    }
    public function accept(Application $application)
    {
        return new ApplicationResource($this->repository->accept($application));
    }
    public function getAcceptPdf(Application $application)
    {
        return $this->repository->getAcceptPdf($application);
    }
    public function schoolRework(ApplicationCommentStoreRequest $request, Application $application)
    {
        return new ApplicationResource($this->repository->declineOrSchoolRework($request->validated(), $application, 'school_rework'));
    }
    public function approveSchoolRework(Application $application)
    {
        return new ApplicationResource($this->repository->approveDeclineOrSchoolRework($application, 'school_rework'));
    }
    public function getSchoolReworkPdf(Application $application)
    {
        return $this->repository->getSchoolReworkPdf($application);
    }
    public function previewSchoolReworkPdf(Application $application, ApplicationCommentStoreRequest $request)
    {
        $comment = new ApplicationComment();
        $comment->fill($request->validated());
        return $this->repository->previewSchoolReworkPdf($application, $comment);
    }
    public function executorRework(ApplicationCommentStoreRequest $request, Application $application)
    {
        return new ApplicationResource($this->repository->executorRework($request->validated(), $application));
    }

    public function edsSign(EdsRequest $request)
    {
        return $this->repository->edsSign($request->xml);
    }
    public function schoolEdsSign(SchoolEdsRequest $request)
    {
        return $this->repository->schoolEdsSign($request->signatory_official_number, $request->official_number, $request->xml);
    }
}
