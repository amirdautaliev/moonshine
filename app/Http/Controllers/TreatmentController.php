<?php

namespace App\Http\Controllers;

use App\Http\Requests\Treatments\StoreRequest;
use App\Models\treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function store(StoreRequest $request)
    {
       treatment::create($request->validated());

    }
}