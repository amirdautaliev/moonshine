<?php

namespace App\Http\Controllers;

use App\Http\Requests\EdsRequest;
use App\Http\Requests\SchoolEdsRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
    public function register(RegisterRequest $request) {
        return $this->service->register($request);
    }

    public function login(LoginRequest $request) {
        return $this->service->login($request);
    }

    public function logout() {
        return $this->service->logout();
    }

    public function profile() {
        return $this->service->getProfile();
    }

    public function sendPasswordCode(Request $request)
    {
        $request->validate([
            'email_address' => 'required|string|exists:users,email_address'
        ]);
        return $this->service->sendCode($request->email_address, 2);
    }

    public function sendRegisterCode(Request $request)
    {
        $request->validate([
            'email_address' => 'required|string|unique:users,email_address'
        ]);
        return $this->service->sendCode($request->email_address, 1);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email_address' => 'required|string|exists:users,email_address',
            'password' => 'required|string'
        ]);
        return $this->service->resetPassword($request->email_address, $request->password);
    }
    public function checkPasswordCode(Request $request)
    {
        $request->validate([
            'email_address' => 'required|string|exists:users,email_address',
            'code' => 'required|integer',
        ]);

        return $this->service->checkPasswordCode($request->email_address, $request->code);
    }

    public function edsLogin(EdsRequest $request)
    {
        return $this->service->edsLogin($request->xml);
    }
}
