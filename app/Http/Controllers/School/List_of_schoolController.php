<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\list_of_school;
use Illuminate\Http\Request;

class List_of_schoolController extends Controller
{
    public function index(Request $request)
    {
       $result = List_of_school::paginate($request->get('per_page',15));
       return \App\Http\Resources\School\List_of_schools::collection($result);
      
    }
}
