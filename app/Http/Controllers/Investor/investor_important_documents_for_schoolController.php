<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\investor_important_documents_for_school;
use Illuminate\Http\Request;

class investor_important_documents_for_schoolController extends Controller
{
    public function index(Request $request)
    {
        $result = investor_important_documents_for_school::paginate($request->get('per_page',15));
        return \App\Http\Resources\Investor\investor_important_documents_for_school::collection($result);
      
    }
}
