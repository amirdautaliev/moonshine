<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\npa_school;
use Illuminate\Http\Request;

class Npa_of_schoolController extends Controller
{
    public function index(Request $request)
    {
       $result= npa_school::paginate($request->get('per_page',15));
       return \App\Http\Resources\School\Npa_schools::collection($result);
      
    }
}
