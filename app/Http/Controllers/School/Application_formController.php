<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\application_form;
use Illuminate\Http\Request;

class Application_formController extends Controller
{
    public function index(Request $request)
    {
        $result = Application_form::paginate($request->get('per_page',15));
        return \App\Http\Resources\School\Application_forms::collection($result);
      
    }
}
