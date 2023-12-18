<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\application_documents_of_building_or_reconstruction;
use Illuminate\Http\Request;

class Application_documents_of_building_or_reconstructions extends Controller
{
    public function index(Request $request)
    {
        $result = application_documents_of_building_or_reconstruction::paginate($request->get('per_page',15));
        return \App\Http\Resources\School\Application_documents_of_building_or_reconstructions::collection($result);
      
    }
}
