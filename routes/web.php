<?php

use App\Http\Controllers\User\UserResumeController;
use App\Http\Controllers\User\UserTestController;
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
Route::get('/resume/{company}/{id}', [UserResumeController::class, 'create'])->name('resume.public.create');
Route::post('/resume/save', [UserResumeController::class, 'store']);
Route::post('/resume/photo', [FileController::class, 'publicUploadPhoto'])->name('resume.public.file.upload');


/**Tests */
Route::get('/resume/info/{company}/{code}', [UserResumeController::class, 'show'])->name('resume.public.show');
Route::prefix('/tests')->group(function () {
    Route::get('info/{company}/{code}', [UserTestController::class, 'showTestInfo'])->name('test.public.info');
    Route::get('proccess/{company}/{code}', [UserTestController::class, 'show'])->name('test.public.show');
    Route::post('prepare', [UserTestController::class, 'prepareTest'])->name('test.public.prepare');
    Route::post('question/show', [UserTestController::class, 'show']);
    Route::post('question/show/{questionNumber}', [UserTestController::class, 'showQuestion']);
    Route::post('finish', [UserTestController::class, 'finish'])->name('tests.finish');
});
/**Messangers */
Route::post('/messengers/telegram/subscribe', [MessengerController::class, 'subscribeTelegram']);
Route::post('/messengers/viber/webhook', [MessengerController::class, 'viberWebhook']);
Route::get('/messengers/viber/setup', [MessengerController::class, 'setupViber']);

/**Auth */
Route::middleware(['auth:sanctum', 'verified'])->prefix('/mng')->group(function () {

    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

    Route::get('resume/show', [ResumeController::class, 'index'])->name('resume.list');
    Route::get('resume/canban', [ResumeController::class, 'indexCanban'])->name('resume.list.canban');
    Route::get('resume/show/{id}', [ResumeController::class, 'show'])->name('resume.detail');
    Route::get('resume/delete/{id}', [ResumeController::class, 'delete'])->name('resume.delete');
    Route::get('resume/export/{id}', [ResumeController::class, 'exportPDF'])->name('resume.export.pdf');
    Route::post('resume/status-change', [ResumeController::class, 'changeStatus'])->name('resume.status.change');
    Route::post('resume/points-change', [ResumeController::class, 'changePoints'])->name('resume.points.change');


    Route::get('forms/show', [FormController::class, 'index'])->name('forms.list');
    Route::get('forms/show/{id}', [FormController::class, 'show'])->name('forms.detail');
    Route::get('forms/delete/{id}', [FormController::class, 'delete'])->name('forms.delete');
    Route::get('forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::post('forms/store', [FormController::class, 'store'])->name('forms.store');
    Route::get('forms/edit/{id}', [FormController::class, 'edit'])->name('forms.edit');

    Route::get('fields/delete/{id}', [FormsFieldController::class, 'delete'])->name('forms.field.delete');

    Route::get('interviews/show', [InterviewController::class, 'index'])->name('interviews.list');
    Route::get('interviews/show/{id}', [InterviewController::class, 'show'])->name('interviews.detail');
    Route::get('interviews/create', [InterviewController::class, 'create'])->name('interviews.create');
    Route::post('interviews/store', [InterviewController::class, 'store'])->name('interviews.store');
    Route::get('interviews/delete/{id}', [InterviewController::class, 'delete'])->name('interviews.delete');
    Route::post('interviews/ajax/create', [InterviewController::class, 'createAjax'])->name('interviews.create.ajax');


    Route::post('comments/store', [CommentController::class, 'store'])->name('comments.store');
    Route::get('comments/delete/{id}', [CommentController::class, 'delete'])->name('comments.delete');
    Route::get('tariff', [TariffController::class, 'showUser'])->name('tariff.user.show');

    Route::get('tests/show', [TestController::class, 'index'])->name('tests.list');
    Route::get('tests/show/{id}', [TestController::class, 'show'])->name('tests.detail');
    Route::get('tests/create', [TestController::class, 'create'])->name('tests.create');
    Route::get('tests/edit/{id}', [TestController::class, 'edit'])->name('tests.edit');
    Route::post('tests/store', [TestController::class, 'store'])->name('tests.store');
    Route::post('tests/update', [TestController::class, 'store'])->name('tests.update');
    Route::get('tests/delete/{id}', [TestController::class, 'delete'])->name('tests.delete');

    Route::post('tests/getlist', [TestController::class, 'getList'])->name('tests.getlist');
    Route::post('tests/assign', [TestController::class, 'assign'])->name('tests.assign');


    Route::get('questions/show', [QuestionController::class, 'index'])->name('questions.list');
    Route::get('questions/show/{id}', [QuestionController::class, 'show'])->name('questions.detail');
    Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('questions/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('questions/edit/{id}', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::get('questions/delete/{id}', [QuestionController::class, 'delete'])->name('questions.delete');

    Route::get('tests-assign/delete/{id}', [TestResumeController::class, 'delete'])->name('test.assign.delete');

});




