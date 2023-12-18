<?php

namespace App\Http\Controllers;

use App\Http\Resources\OurResultsResource;
use App\Models\Result;
use Illuminate\Http\Request;

class OurResultsController extends Controller
{
    public  function index()
    {
        $results = Result::paginate(15);
        return  OurResultsResource::collection($results);
    }
}
