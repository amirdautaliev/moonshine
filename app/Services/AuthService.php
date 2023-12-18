<?php


namespace App\Services;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Mail\SendCodeMail;
use App\Models\EmailCode;
use App\Models\User;
use App\Services\NCANode\Client;
use App\Services\NCANode\Xml;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    public function register(RegisterRequest $request) {
        if (!$this->checkCode($request->email_address, $request->code, 1))
            return response(['message' => 'Код введен неверно'], 422);

        return $this->respondWithToken(User::create($request->validated()));
    }

    public function login(LoginRequest $request) {
        $validated = $request->validated();
        $user = User::query()->where('login', $validated['login'])->first();

        if (!$user)
            return response("Пользователь не найден", 422);

        if (!Hash::check($validated['password'], $user->password))
            return response("Неверные данные", 422);

        return $this->respondWithToken($user);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response('Logged out');
    }

    public function getProfile() {
        return new UserResource(auth()->user());
    }

    private function respondWithToken(User $user)
    {
        return response([
            'user' => new UserResource($user),
            'access_token' => $user->createToken('stop-piramida')->plainTextToken
        ]);
    }

    public function sendCode($emailAddress, $type)
    {
        $code = rand(11111, 99999);
        $message = 'Сообщение успешно отправлено';
        try {
            Mail::to($emailAddress)->send(new SendCodeMail($code, $type));
            EmailCode::query()->create([
                'email_address' => $emailAddress,
                'code' => $code,
                'type' => $type
            ]);
        }
        catch (\Exception $exception) {
            $message = 'При отправке письма произошла ошибка, проверьте введенную почту';
        }
        return ['message' => $message];
    }

    private function checkCode($emailAddress, $code, $type)
    {
        return EmailCode::query()
            ->where('email_address', $emailAddress)
            ->where('code', $code)
            ->where('type', $type)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function resetPassword($emailAddress, $password)
    {
        $user = User::query()->where('email_address', $emailAddress)->first();
        if (!$user)
            return response(['message' => 'Почта не найдена'], 422);
        $user->update([
            'password' => $password
        ]);

        return new UserResource($user);
    }
    public function checkPasswordCode($emailAddress, $code)
    {
        if (!$this->checkCode($emailAddress, $code, 2))
            return response(['message' => 'Код введен неверно'], 422);

        return response(['message' => 'Код совпадает']);
    }

    public function edsLogin(string $xml)
    {
        $edsResponse = (new Xml(new Client()))->verify($xml); // получаем данные из ключа

        if ($edsResponse->certificate->keyUsage != 'AUTH')
            return response('Неверный ключ', 422);

        $edsUser = $edsResponse->certificate->subject;
        $bin = substr($edsUser->dn, strpos($edsUser->dn, 'OU=BIN') + 6, 12); // достаем БИН

        $user = User::query()->where('official_number', trim($bin))->first();
        if ($user)
            return $this->respondWithToken($user);

        return response('Школа с указанным БИН не зарегистрирована в системе. Пройдите регистрацию', 422);
    }
}
