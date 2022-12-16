<?php

use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\Lead\LeadFormController;
use App\Http\Controllers\Web\Login\LoginController;
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

//LOGIN
Route::get('/login',function (){
    return view('user.login');
})->name('login');
Route::post('login',[LoginController::class,'login'])->name('loginUser');


//REGISTER
Route::prefix('register')->group(function () {
    Route::get('/',function (){
        return view('user.register');
    })->name('register');
    Route::post('save',[LoginController::class,'register'])->name('registerUser');
});



//LEAD FORM
Route::group(['middleware' => ['validate_browser']],function () {
    Route::prefix('lead')->group(function () {
        Route::get('form',function (){
            header('Access-Control-Allow-Origin: *');
            return view('leadform.index');
        })->name('leadForm');

        Route::post('save',[LeadFormController::class,'saveLeadForm'])->name('saveLeadForm');
    });
});

//DASHBOARD AND LEAD LIST FOR SINGING USERS
Route::group(['middleware' => ['auth:sanctum']],function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout',[LoginController::class,'logout'])->name('logout');

    Route::post('lead/list',[LeadFormController::class,'getLeadFormList'])->name('getLeadFormList');

});
