<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormsFieldController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestResumeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MessengerController;
use App\Models\Tariff;


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

Route::get('/', function () {
    
    $tariffs = Tariff::all();

    return view('welcome', compact('tariffs'));
});

/**Resume */
Route::get('/resume/{company}/{id}', [FormController::class, 'publicCreate'])->name('resume.public.create');
Route::post('/resume/save', [FormController::class, 'publicStore']);
Route::post('/resume/photo', [FileController::class, 'publicUploadPhoto'])->name('resume.public.file.upload');

/**Tests */
Route::get('/public/{company}/{code}', [ResumeController::class, 'showPublic'])->name('resume.public.show');
Route::get('/tests/info/{company}/{code}', [TestController::class, 'showTestInfo'])->name('test.public.info');
Route::get('/tests/proccess/{company}/{code}', [TestController::class, 'publicShow'])->name('test.public.show');
Route::post('/tests/prepare', [TestController::class, 'prepareTest'])->name('test.public.prepare');
Route::post('/tests/question/show', [TestController::class, 'publicShow']);
Route::post('/tests/finish', [TestController::class, 'finish'])->name('tests.finish');

/**Messangers */
Route::post('/messengers/telegram/subscribe', [MessengerController::class, 'subscribeTelegram']);
Route::post('/messengers/viber/webhook', [MessengerController::class, 'viberWebhook']);
Route::get('/messengers/viber/setup', [MessengerController::class, 'setupViber']);

/**Auth */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
    
    Route::get('/mng/resume/show', [ResumeController::class, 'index'])->name('resume.list');
    Route::get('/mng/resume/canban', [ResumeController::class, 'indexCanban'])->name('resume.list.canban');
    Route::get('/mng/resume/show/{id}', [ResumeController::class, 'show'])->name('resume.detail');
    Route::get('/mng/resume/delete/{id}', [ResumeController::class, 'delete'])->name('resume.delete');
    Route::get('/mng/resume/export/{id}', [ResumeController::class, 'exportPDF'])->name('resume.export.pdf');
    Route::post('/mng/resume/status-change', [ResumeController::class, 'changeStatus'])->name('resume.status.change');
    Route::post('/mng/resume/points-change', [ResumeController::class, 'changePoints'])->name('resume.points.change');


    Route::get('/mng/forms/show', [FormController::class, 'index'])->name('forms.list');
    Route::get('/mng/forms/show/{id}', [FormController::class, 'show'])->name('forms.detail');
    Route::get('/mng/forms/delete/{id}', [FormController::class, 'delete'])->name('forms.delete');
    Route::get('/mng/forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::post('/mng/forms/store', [FormController::class, 'store'])->name('forms.store');
    Route::get('/mng/forms/edit/{id}', [FormController::class, 'edit'])->name('forms.edit');
    
    Route::get('/mng/fields/delete/{id}', [FormsFieldController::class, 'delete'])->name('forms.field.delete');

    Route::get('/mng/interviews/show', [InterviewController::class, 'index'])->name('interviews.list');
    Route::get('/mng/interviews/show/{id}', [InterviewController::class, 'show'])->name('interviews.detail');
    Route::get('/mng/interviews/create', [InterviewController::class, 'create'])->name('interviews.create');
    Route::post('/mng/interviews/store', [InterviewController::class, 'store'])->name('interviews.store');
    Route::get('/mng/interviews/delete/{id}', [InterviewController::class, 'delete'])->name('interviews.delete');
    Route::post('/mng/interviews/ajax/create', [InterviewController::class, 'createAjax'])->name('interviews.create.ajax');
    

    Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/delete/{id}', [CommentController::class, 'delete'])->name('comments.delete');
    Route::get('/mng/tariff', [TariffController::class, 'showUser'])->name('tariff.user.show');

    Route::get('/mng/tests/show', [TestController::class, 'index'])->name('tests.list');
    Route::get('/mng/tests/show/{id}', [TestController::class, 'show'])->name('tests.detail');
    Route::get('/mng/tests/create', [TestController::class, 'create'])->name('tests.create');
    Route::get('/mng/tests/edit/{id}', [TestController::class, 'edit'])->name('tests.edit');
    Route::post('/mng/tests/store', [TestController::class, 'store'])->name('tests.store');
    Route::post('/mng/tests/update', [TestController::class, 'store'])->name('tests.update');
    Route::get('/mng/tests/delete/{id}', [TestController::class, 'delete'])->name('tests.delete');
    Route::post('/mng/tests/getlist', [TestController::class, 'getList'])->name('tests.getlist');
    Route::post('/mng/tests/assign', [TestController::class, 'assign'])->name('tests.assign');
    

    Route::get('/mng/questions/show', [QuestionController::class, 'index'])->name('questions.list');
    Route::get('/mng/questions/show/{id}', [QuestionController::class, 'show'])->name('questions.detail');
    Route::get('/mng/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/mng/questions/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/mng/questions/edit/{id}', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::get('/mng/questions/delete/{id}', [QuestionController::class, 'delete'])->name('questions.delete');

    Route::get('/mng/tests-assign/delete/{id}', [TestResumeController::class, 'delete'])->name('test.assign.delete');

});




