<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SchoolRepository;
use App\Http\Requests\SchoolStoreRequest;
use App\Http\Requests\SchoolUpdateRequest;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private $repository;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->repository = $schoolRepository;
    }

    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    public function show(School $school)
    {
        return $this->repository->show($school);
    }

    public function store(SchoolStoreRequest $request)
    {
        return $this->repository->store($request->validated());
    }

    public function update(SchoolUpdateRequest $request, School $school)
    {
        return $this->repository->update($request->validated(), $school);
    }

    public function destroy(School $school)
    {
        return $this->repository->delete($school);
    }
}
