<?php


namespace App\Http\Repositories;


use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    public function index(Request $request)
    {
        return User::query()->paginate(20);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function store(array $data)
    {
        return User::query()->create($data);
    }

    public function update(array $data, User $user)
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
        return response('Запись успешно удалена');
    }

    public function updatePassword(array $data)
    {
        if ($data['user_id'])
            $user = User::query()->findOrFail($data['user_id']);
        else
            $user = auth()->user();

        $user->update(['password' => $data['password']]);

        return response('Пароль успешно изменен');
    }
}
