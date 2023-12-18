<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\Investor\investor_faq_for_schoolController;
use App\Http\Controllers\Investor\investor_important_documents_for_schoolController;
use App\Http\Controllers\Investor\investor_map_for_schoolController;
use App\Http\Controllers\Investor\investor_site_map_schoolController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OurResultsController;
use App\Http\Controllers\QuestionController;
<<<<<<< HEAD
use App\Http\Controllers\School\Application_documentController;
use App\Http\Controllers\School\Application_documents_of_building_or_reconstructions;
use App\Http\Controllers\School\Application_formController;
use App\Http\Controllers\School\Documents_formsController;
use App\Http\Controllers\School\Faq_schoolController;
use App\Http\Controllers\School\List_of_schoolController;
use App\Http\Controllers\School\Npa_of_schoolController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SliderController;
=======
>>>>>>> 7df38fcb95cd80854a00ca3df144cb8ed188a7e3
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\School\Documents_formsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('guest')->group(function () {
    Route::post('token', [AuthController::class,'login']);
});
//example
Route::post('/test', function (\Illuminate\Http\Request $request, \App\Services\NCANode\Xml $xml) {
    dd($xml->verify($request->input('xml')));
});


Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/eds-login', [AuthController::class, 'edsLogin']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/send-password-code', [AuthController::class, 'sendPasswordCode']);
    Route::post('/send-register-code', [AuthController::class, 'sendRegisterCode']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
    });

    Route::put('/user/update-password', [UserController::class, 'updatePassword']);
    Route::apiResource('/user', UserController::class);

    Route::apiResource('/school', SchoolController::class);

    Route::prefix('/application')->group(function () {
        Route::prefix('{department}')->group(function () {
            Route::get('get-executors', [ApplicationController::class, 'getExecutors']);
            Route::get('get-main-executors', [ApplicationController::class, 'getMainExecutors']);
            Route::post('{application}/set-executors', [ApplicationController::class, 'setExecutors']);
        });
        Route::get('{application}/get-pdf', [ApplicationController::class, 'getPdf']);
        Route::post('/preview-pdf', [ApplicationController::class, 'previewPdf']);

        Route::post('{application}/decline', [ApplicationController::class, 'decline']);
        Route::post('{application}/approve-decline', [ApplicationController::class, 'approveDecline']);
        Route::get('{application}/get-decline-pdf', [ApplicationController::class, 'getDeclinePdf']);
        Route::post('{application}/preview-decline-pdf', [ApplicationController::class, 'previewDeclinePdf']);
        Route::post('{application}/accept', [ApplicationController::class, 'accept']);
        Route::get('{application}/get-accept-pdf', [ApplicationController::class, 'getAcceptPdf']);
        Route::post('{application}/school-rework', [ApplicationController::class, 'schoolRework']);
        Route::post('{application}/approve-school-rework', [ApplicationController::class, 'approveSchoolRework']);
        Route::get('{application}/get-school-rework-pdf', [ApplicationController::class, 'getSchoolReworkPdf']);
        Route::post('{application}/preview-school-rework-pdf', [ApplicationController::class, 'previewSchoolReworkPdf']);
        Route::post('{application}/executor-rework', [ApplicationController::class, 'executorRework']);
        Route::post('eds-sign', [ApplicationController::class, 'edsSign']);
        Route::post('school-eds-sign', [ApplicationController::class, 'schoolEdsSign']);

<<<<<<< HEAD
    });       
        Route::apiResource('/application', ApplicationController::class);

        Route::apiResources([
            'slider'    => SliderController::class,
            'news'      => NewsController::class,
            'result'    => OurResultsController::class,
            'about'     => AboutController::class,
            'question'  => QuestionController::class,
            'treatment' => TreatmentController::class,
            'document'  => Documents_formsController::class,
            'application_document'    => Application_documentController::class,
            'application_of_building' => Application_documents_of_building_or_reconstructions::class,
            'application_form'   => Application_formController::class,
            'faq_school'         => Faq_schoolController::class,
            'list_of_school'     => List_of_schoolController::class,
            'npa_of_school'      => Npa_of_schoolController::class,
            'investor_faq'       => investor_faq_for_schoolController::class,
            'investor_important' => investor_important_documents_for_schoolController::class,
            'investor_map'       => investor_map_for_schoolController::class,
            'investor_site_map'  => investor_site_map_schoolController::class
            
        ]);
=======
    });
    Route::apiResource('/application', ApplicationController::class);
    Route::apiResources([
        'crud'      => CrudController::class,
        'news'      => NewsController::class,
        'result'    => OurResultsController::class,
        'about'     => AboutController::class,
        'question'  => QuestionController::class,
        'treatment' => TreatmentController::class,
        'document'  => Documents_formsController::class
    ]);
>>>>>>> 7df38fcb95cd80854a00ca3df144cb8ed188a7e3
});
