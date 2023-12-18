<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\faq_school;
use Illuminate\Http\Request;

class Faq_schoolController extends Controller
{
    public function index(Request $request)
    {
       $result = faq_school::paginate($request->get('per_page',15));
       return \App\Http\Resources\School\Faq_schools::collection($result);
      
    }
}
