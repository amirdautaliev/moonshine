<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\Questions\StoreRequest;


class QuestionController extends Controller
{
    public function store(StoreRequest $request)
    {
         $question  = Question::create($request->validated());
         return new QuestionResource($question);
    }
}
