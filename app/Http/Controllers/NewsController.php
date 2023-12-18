<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Resources\NewsResource;





class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(15);
        return NewsResource::collection($news);
    }
}
    