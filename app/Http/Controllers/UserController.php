<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function index(Request $request)
    {
        return UserResource::collection($this->repository->index($request));
    }

    public function show(User $user)
    {
        return new UserResource($this->repository->show($user));
    }

    public function store(UserStoreRequest $request)
    {
        return new UserResource($this->repository->store($request->validated()));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        return new UserResource($this->repository->update($request->validated(), $user));
    }

    public function delete(User $user)
    {
        return $this->repository->delete($user);
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        return $this->repository->updatePassword($request->validated());
    }
}
