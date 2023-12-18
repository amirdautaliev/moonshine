<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\documents_forms;
use Illuminate\Http\Request;


class Documents_formsController extends Controller
{
    public function index(Request $request)
    {
       $result = documents_forms::paginate($request->get('per_page',15));
       return \App\Http\Resources\School\Documents_forms::collection($result);
      
    }
}
