<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\application_documents;
use Illuminate\Http\Request;

class Application_documentController extends Controller
{
    public function index(Request $request)
    {
        $result = application_documents::paginate($request->get('per_page',15));
        return \App\Http\Resources\School\Application_documents::collection($result);
      
    }

}
