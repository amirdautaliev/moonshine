<?php


namespace App\Http\Repositories;


use App\Models\School;
use Illuminate\Http\Request;

class SchoolRepository
{
    public function index(Request $request)
    {
        return School::query()->where('organization_id', auth()->id())->paginate(20);
    }

    public function show(School $school)
    {
        return $school;
    }

    public function store(array $data)
    {
        return School::query()->create($data);
    }

    public function update(array $data, School $school)
    {
        $school->update($data);
        return $school;
    }

    public function delete(School $school)
    {
        $school->delete();
        return response('Запись успешно удалена');
    }
}
