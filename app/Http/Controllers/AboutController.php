<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Http\Resources\AboutResource;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::paginate(15);
        return AboutResource::collection($abouts);
    }
}
