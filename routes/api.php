<?php

use App\Http\Controllers\CompanyAPIController;
use App\Http\Controllers\ExtraAPIController;
use App\Http\Controllers\FileAPIController;
use App\Http\Controllers\ProjectAPIController;
use App\Http\Controllers\UserAPIController;
use App\Models\CompanyModal;
use App\Models\ExtraModal;
use App\Http\Controllers\AdminAPIController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('extra/{extraName}', function ($extraName) {
    $data = ExtraModal::where([
        ['status', '>', 0],
        ['name', '=', $extraName]
    ])->get();
    $value = $data[0];
    return $value;
})->name('extra.value');


Route::get('admin-management', [AdminAPIController::class, 'index'])->name('api.admin.view');
Route::post('admin-management/add', [AdminAPIController::class, 'addAdmin'])->name('api.admin.save');
Route::get('admin-management/details/{id}', [AdminAPIController::class, 'detailsOfAdmin'])->name('api.admin.details');
Route::put('admin-management/update', [AdminAPIController::class, 'updateAdmin'])->name('api.admin.update');
Route::put('admin-management/delete', [AdminAPIController::class, 'deleteAdmin'])->name('api.admin.delete');


//Company
Route::get('company-management', [CompanyAPIController::class, 'index'])->name('company.view');
Route::post('company-management/add', [CompanyAPIController::class, 'addCompany'])->name('company.save');
Route::get('company-management/details/{id}', [CompanyAPIController::class, 'detailsOfCompany'])->name('company.details');
Route::put('company-management/update', [CompanyAPIController::class, 'updateCompany'])->name('company.update');
Route::put('company-management/delete', [CompanyAPIController::class, 'deleteCompany'])->name('company.delete');

//User
Route::get('user-management', [UserAPIController::class, 'index'])->name('user.view');
Route::post('user-management/add', [UserAPIController::class, 'addUser'])->name('user.save');
Route::get('user-management/details/{id}', [UserAPIController::class, 'detailsOfUser'])->name('user.details');
Route::put('user-management/update', [UserAPIController::class, 'updateUser'])->name('user.update');
Route::put('user-management/delete', [UserAPIController::class, 'deleteUser'])->name('user.delete');
//Extra
Route::get('extra-management', [ExtraAPIController::class, 'index'])->name('extra.view');
Route::post('extra-management/add', [ExtraAPIController::class, 'addExtra'])->name('extra.save');
Route::get('extra-management/details/{id}', [ExtraAPIController::class, 'detailsOfExtra'])->name('extra.details');
Route::put('extra-management/update', [ExtraAPIController::class, 'updateExtra'])->name('extra.update');
Route::put('extra-management/delete', [ExtraAPIController::class, 'deleteExtra'])->name('extra.delete');


Route::get('project-management/{companyId?}', [ProjectAPIController::class, 'index'])->name('project.view');
Route::get('companywise-project-management', [ProjectAPIController::class, 'companyWiseManagement'])->name('project.companywise.view');
Route::post('project-management/add', [ProjectAPIController::class, 'addProject'])->name('project.save');
Route::post('project-management-status/update', [ProjectAPIController::class, 'updateStatus'])->name('projectstatus.update');
Route::get('/project-management/details/{id}', [ProjectAPIController::class, 'detailsOfProject'])->name('project.details');
Route::put('project-management/update/', [ProjectAPIController::class, 'updateProject'])->name('project.update');
Route::put('project-management/delete', [ProjectAPIController::class, 'deleteProject'])->name('project.delete');


Route::get('project-management/project/view/{id}',[ProjectAPIController::class,'projectDetails'])->name('project.details.view');

Route::post('project-management/project/front-view',[ProjectAPIController::class,'projectShow'])->name('project.to.show');


Route::post('phase/compare-milestone', [ProjectAPIController::class, 'compareMilstoneValue'])->name('phase.compare.milestone');
Route::post('phase/add', [ProjectAPIController::class, 'addPhase'])->name('phase.save');
Route::put('phase/delete', [ProjectAPIController::class, 'deletePhase'])->name('phase.delete');

Route::post('phase-details/add', [ProjectAPIController::class, 'addPhaseDetails'])->name('phase.details.save');
Route::put('phase-details/delete', [ProjectAPIController::class, 'deletePhaseDetails'])->name('phase.details.delete');

//Route::put('payment-details/calculate-payment', [ProjectAPIController::class, 'calculatePayment'])->name('payment.calculate');
 Route::post('payment-details/add', [ProjectAPIController::class, 'addPaymentDetails'])->name('payment.save');
 Route::put('payment-details/delete', [ProjectAPIController::class, 'deletePayment'])->name('payment.delete');


 Route::get('file-management', [FileAPIController::class, 'index'])->name('file.show');
 Route::get('file-management/edit/{id}/{name}', [FileAPIController::class, 'editFile'])->name('file.edit');
 Route::post('file-management/replace', [FileAPIController::class, 'replaceFile'])->name('file.replace');
 Route::put('file-management/delete', [FileAPIController::class, 'deleteFile'])->name('file.delete');

 Route::post('file-management/add', [FileAPIController::class, 'addPhaseDetailsFile'])->name('phase.details.file.save');
 Route::get('file-management/phase-details/view-file/{projectId?}', [FileAPIController::class, 'viewFiles'])->name('phase.details.file.view');
