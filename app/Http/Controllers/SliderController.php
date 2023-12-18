<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Http\Requests\CrudRequest;
use App\Http\Resources\CrudResource;
use App\Models\slider;

class SliderController extends Controller
{
    public function index(CrudRequest $request)
    {
      $slider = slider::paginate( $request->get("per_page",15));
      return CrudResource::collection($slider);
    }
}
