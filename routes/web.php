<?php

use App\Http\Controllers\Moonshine\StoreController;
use App\MoonShine\Resources\TreatmentResource;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (\App\Services\NCANode\Info $info) {

    return view('welcome');
});


Route::post('/test', function (\Illuminate\Http\Request $request, \App\Services\NCANode\Xml $xml) {
    dd($xml->verify($request->input('xml')));
<<<<<<< HEAD
});
=======
});
Route::get('/example', StoreController::class)->name('moonshine.store');
>>>>>>> 7df38fcb95cd80854a00ca3df144cb8ed188a7e3
