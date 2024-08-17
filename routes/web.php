<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManageInternController;
use App\Http\Controllers\AdminSetRequirementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\CoordinatorManageInternController;
use App\Http\Controllers\CoordinatorRequirementController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\InternRequirementController;
use App\Http\Controllers\ManageCoordinatorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
// Route::group(['middleware' => ['approval']], function () {
//     Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
// });

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admindashboard', [AdminController::class, 'index'])->name('admindashboard');
    Route::get('/adminprofile', [AdminController::class, 'adminprofile'])->name('adminprofile');
    Route::put('/updateProfile/{admin}', [AdminController::class, 'update'])->name('updateProfile');

    Route::get('/addcoordinator', [ManageCoordinatorController::class, 'index'])->name('addcoordinator');
    Route::post('/addcoordinator', [ManageCoordinatorController::class, 'store'])->name('addcoordinator');
    Route::get('/managecoordinator', [ManageCoordinatorController::class, 'managecoordinatorPage'])->name('managecoordinator');
    Route::get('/editCoordinator/{coordinator}/', [ManageCoordinatorController::class, 'editCoordinator'])->name('editCoordinator');
    
    Route::put('/updateCoordinator/{coordinator}/', [ManageCoordinatorController::class, 'update'])->name('updateCoordinator');
    Route::delete('/deleteCoordinator/{coordinator}/', [ManageCoordinatorController::class, 'destroy'])->name('deleteCoordinator');

    Route::get('/manageintern/viewpage', [AdminManageInternController::class, 'manageinternview'])->name('admin.manageinternview');
    Route::get('/manageintern/viewprofile/{intern}', [AdminManageInternController::class, 'viewinternprofile'])->name('admin.viewinternprofile');
    Route::put('/manageintern/updateinternprofile/{intern}', [AdminManageInternController::class, 'updateinternprofile'])->name('admin.updateInternprofile');
    Route::delete('/deleteintern/{intern}', [AdminManageInternController::class, 'deleteintern'])->name('admin.deleteIntern');

    Route::get('/setrequirement/viewpage', [AdminSetRequirementController::class, 'index'])->name('admin.viewsetrequirement');
    Route::post('/setrequirement/viewpage', [AdminSetRequirementController::class, 'setrequirement'])->name('admin.setrequirement');

    Route::get('/managerequirement/viewpage', [AdminSetRequirementController::class, 'managerequirements'])->name('admin.managerequirement');
    Route::get('/viewrequirement/{requirement}', [AdminSetRequirementController::class, 'viewrequirement'])->name('admin.viewrequirement');
    Route::put('/updaterequirement/{requirement}', [AdminSetRequirementController::class, 'updaterequirement'])->name('updaterequirement');
    Route::delete('/admin/deleterequirement/{requirement}', [AdminSetRequirementController::class, 'deleterequirement'])->name('admin.deleterequirement');

    Route::get('/admin/approvedrequirementpage', [AdminSetRequirementController::class, 'approvedrequirementpage'])->name('admin.approvedrequirementpage');
    Route::get('/admin/viewapprovedrequirementpage/{user}', [AdminSetRequirementController::class, 'viewapprovedrequirementpage'])->name('admin.viewapprovedrequirementpage');

    Route::put('/admin/declinerequirement/{requirement}', [AdminSetRequirementController::class, 'declinerequirement'])->name('admin.declinerequirement');
    Route::put('/admin/checkedrequirement/{requirement}', [AdminSetRequirementController::class, 'checkedrequirement'])->name('admin.checkedrequirement');
});

Route::group(['middleware' => ['auth', 'coordinator']], function () {
    Route::get('/coordinatordashboard', [CoordinatorController::class, 'index'])->name('coordinatordashboard');
    Route::get('/coordinatorprofile', [CoordinatorController::class, 'coordinatorprofile'])->name('coordinatorprofile.view');
    Route::put('/coordinatorprofile/update/{coordinator}', [CoordinatorController::class, 'updateprofile'])->name('coordinatorprofile.update');

    Route::get('/approveintern/view', [CoordinatorManageInternController::class, 'viewintern'])->name('approveintern.view');
    Route::get('/approveintern/viewprofile/{intern}', [CoordinatorManageInternController::class, 'viewprofile'])->name('approveintern.viewprofile');
    Route::put('/approveintern/approved/{intern}', [CoordinatorManageInternController::class, 'approved'])->name('approveintern.approved');
    Route::put('/approveintern/decline/{intern}', [CoordinatorManageInternController::class, 'decline'])->name('approveintern.decline');

    Route::get('/manageintern/view', [CoordinatorManageInternController::class, 'manageintern'])->name('manageintern.view');
    Route::get('/manageintern/viewintern/{intern}', [CoordinatorManageInternController::class, 'viewinternprofile'])->name('manageintern.viewprofile');
    Route::put('/manageintern/updateintern/{intern}', [CoordinatorManageInternController::class, 'updateintern'])->name('manageintern.update');
    Route::delete('/manageintern/deleteintern/{intern}', [CoordinatorManageInternController::class, 'deleteintern'])->name('manageintern.deleteintern');

    Route::get('/coordinator/setrequirementpage', [CoordinatorRequirementController::class, 'setRequirementPage'])->name('coordinator.setRequirementPage');
    Route::post('/coordinator/setrequirement', [CoordinatorRequirementController::class, 'setrequirement'])->name('coordinator.setrequirement');
    Route::get('/coordinator/managerequirementPage', [CoordinatorRequirementController::class, 'managerequirement'])->name('coordinator.managerequirement');
    Route::get('/coordinator/viewrequirement/{requirement}', [CoordinatorRequirementController::class, 'viewrequirement'])->name('coordinator.viewrequirement');
    Route::put('/coordinator/updaterequirement/{requirement}', [CoordinatorRequirementController::class, 'updaterequirement'])->name('coordinator.updaterequirement');
    Route::delete('/coordinator/deleterequirement/{requirement}', [CoordinatorRequirementController::class, 'deleterequirement'])->name('coordinator.deleterequirement');

    Route::get('/coordinator/approvedrequirementpage', [CoordinatorRequirementController::class, 'approvedrequirementpage'])->name('coordinator.approvedrequirementpage');
    Route::get('/coordinator/viewapprovedrequirementpage/{user}', [CoordinatorRequirementController::class, 'viewapprovedrequirementpage'])->name('coordinator.viewapprovedrequirementpage');

    Route::put('/coordinator/declinerequirement/{requirement}', [CoordinatorRequirementController::class, 'declinerequirement'])->name('coordinator.declinerequirement');
    Route::put('/coordinator/checkedrequirement/{requirement}', [CoordinatorRequirementController::class, 'checkedrequirement'])->name('coordinator.checkedrequirement');
});

Route::group(['middleware' => ['auth', 'intern','approved']], function () {
    Route::get('/interndashboard', [InternController::class, 'index'])->name('interndashboard');
    Route::get('/internprofile', [InternController::class, 'internprofile'])->name('internprofile');
    Route::put('/updateprofile/{intern}', [InternController::class, 'update'])->name('updateprofile');

    Route::get('/viewrequirements', [InternRequirementController::class, 'viewrequirements'])->name('intern.viewrequirements');
    Route::post('/submitrequirements', [InternRequirementController::class, 'submitrequirements'])->name('intern.submitrequirements');
    Route::get('/viewrequriements/status', [InternRequirementController::class, 'viewstatus'])->name('intern.viewstatus');

    Route::get('/reuploadRequirementPage/{requirement}/', [InternRequirementController::class, 'reuploadRequirementPage'])->name('intern.reuploadRequirementPage');
    Route::put('/reuploadRequirement/{requirement}/', [InternRequirementController::class, 'reuploadRequirement'])->name('intern.reuploadRequirement');
});


Route::group(['middleware' => ['auth']], function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

