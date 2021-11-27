<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UserController;
use App\Models\CompanyModal;
use App\Models\ExtraModal;
use Illuminate\Http\Request;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('extra/{extraName}', function ($extraName) {
    $data = ExtraModal::where([
        ['status', '>', 0],
        ['name', '=', $extraName]
    ])->get();
    $value = $data[0];
    return $value;
})->name('extra.value');

//Login 

Route::get('/', [LoginController::class, 'index'])->name('login.view');
Route::post('login/credential/check', [LoginController::class, 'checkLogin'])->name('login.check.credential');

Route::get('logout', [LoginController::class, 'logout'])->name('logout.view');

//Admin
Route::get('admin-management', [AdminController::class, 'index'])->name('admin.view');
Route::post('admin-management/add', [AdminController::class, 'addAdmin'])->name('admin.save');
Route::get('admin-management/details/{id}', [AdminController::class, 'detailsOfAdmin'])->name('admin.details');
Route::put('admin-management/update', [AdminController::class, 'updateAdmin'])->name('admin.update');
Route::put('admin-management/delete', [AdminController::class, 'deleteAdmin'])->name('admin.delete');

//Company
Route::get('company-management', [CompanyController::class, 'index'])->name('company.view');
Route::post('company-management/add', [CompanyController::class, 'addCompany'])->name('company.save');
Route::get('company-management/details/{id}', [CompanyController::class, 'detailsOfCompany'])->name('company.details');
Route::put('company-management/update', [CompanyController::class, 'updateCompany'])->name('company.update');
Route::put('company-management/delete', [CompanyController::class, 'deleteCompany'])->name('company.delete');

//User
Route::get('user-management', [UserController::class, 'index'])->name('user.view');
Route::post('user-management/add', [UserController::class, 'addUser'])->name('user.save');
Route::get('user-management/details/{id}', [UserController::class, 'detailsOfUser'])->name('user.details');
Route::put('user-management/update', [UserController::class, 'updateUser'])->name('user.update');
Route::put('user-management/delete', [UserController::class, 'deleteUser'])->name('user.delete');
//Extra
Route::get('extra-management', [ExtraController::class, 'index'])->name('extra.view');
Route::post('extra-management/add', [ExtraController::class, 'addExtra'])->name('extra.save');
Route::get('extra-management/details/{id}', [ExtraController::class, 'detailsOfExtra'])->name('extra.details');
Route::put('extra-management/update', [ExtraController::class, 'updateExtra'])->name('extra.update');
Route::put('extra-management/delete', [ExtraController::class, 'deleteExtra'])->name('extra.delete');


Route::get('project-management/{companyId?}', [ProjectController::class, 'index'])->name('project.view');
Route::get('companywise-project-management', [ProjectController::class, 'companyWiseManagement'])->name('project.companywise.view');
Route::post('project-management/add', [ProjectController::class, 'addProject'])->name('project.save');
Route::post('project-management-status/update', [ProjectController::class, 'updateStatus'])->name('projectstatus.update');
Route::get('/project-management/details/{id}', [ProjectController::class, 'detailsOfProject'])->name('project.details');
Route::put('project-management/update/', [ProjectController::class, 'updateProject'])->name('project.update');
Route::put('project-management/delete', [ProjectController::class, 'deleteProject'])->name('project.delete');


Route::get('project-management/project/view/{id}',[ProjectController::class,'projectDetails'])->name('project.details.view');

Route::post('project-management/project/front-view',[ProjectController::class,'projectShow'])->name('project.to.show');


Route::post('phase/compare-milestone', [ProjectController::class, 'compareMilstoneValue'])->name('phase.compare.milestone');
Route::post('phase/add', [ProjectController::class, 'addPhase'])->name('phase.save');
Route::put('phase/delete', [ProjectController::class, 'deletePhase'])->name('phase.delete');

Route::post('phase-details/add', [ProjectController::class, 'addPhaseDetails'])->name('phase.details.save');
Route::put('phase-details/delete', [ProjectController::class, 'deletePhaseDetails'])->name('phase.details.delete');

//Route::put('payment-details/calculate-payment', [ProjectController::class, 'calculatePayment'])->name('payment.calculate');
 Route::post('payment-details/add', [ProjectController::class, 'addPaymentDetails'])->name('payment.save');
 Route::put('payment-details/delete', [ProjectController::class, 'deletePayment'])->name('payment.delete');


 Route::get('file-management', [FileController::class, 'index'])->name('file.show');
 Route::get('file-management/edit/{id}/{name}', [FileController::class, 'editFile'])->name('file.edit');
 Route::post('file-management/replace', [FileController::class, 'replaceFile'])->name('file.replace');
 Route::put('file-management/delete', [FileController::class, 'deleteFile'])->name('file.delete');

 Route::post('file-management/add', [FileController::class, 'addPhaseDetailsFile'])->name('phase.details.file.save');
 Route::get('file-management/phase-details/view-file/{projectId?}', [FileController::class, 'viewFiles'])->name('phase.details.file.view');
 //timeline
 
 Route::get('timeline/show', [TimelineController::class, 'index'])->name('timeline.view');

 //event
 Route::get('event', [EventController::class, 'index'])->name('event.view');
 Route::post('event/add', [EventController::class, 'addEvent'])->name('event.save');
 Route::get('event/details/{id}', [EventController::class, 'detailsOfEvent'])->name('event.details');
 Route::put('event/update', [EventController::class, 'updateEvent'])->name('event.update');
 Route::put('event/delete', [EventController::class, 'deleteEvent'])->name('event.delete');
