<?php


//use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Forget\ForgetPasswordcontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Role\RolePermissionController;
use App\Http\Controllers\RoleandPermisson\RolePermission;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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




Auth::routes();

Route::group(['middleware'=>'auth'], function(){

    Route::get('/', function () {
        return redirect('home');
    });
    Route::resource('article', ArticleController::class);

});


Route::group(['middleware'=>'admin'], function(){
    //---------Admin---------------//
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('role', RolePermissionController::class);
    Route::resource('user', UserController::class);

});



//---------forget password--------------//
Route::get('forget', [ForgetPasswordcontroller::class, 'forget'])->name('forget');
Route::post('forgetpassword', [ForgetPasswordcontroller::class, 'forgetpassword'])->name('forgetpassword');
Route::get('ChangePassword', [ForgetPasswordcontroller::class, 'ChangePassword'])->name('ChangePassword');
Route::post('ChangePasswordSave', [ForgetPasswordcontroller::class, 'ChangePasswordSave'])->name('ChangePasswordSave');

