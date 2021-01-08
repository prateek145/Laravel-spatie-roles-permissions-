<?php


//use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Forget\ForgetPasswordcontroller;
use App\Http\Controllers\Role\RolePermissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Page\PageController;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return redirect('home');
    });
    Route::resource('article', ArticleController::class);


    //---------change password--------------//

    Route::get('forget', [ForgetPasswordcontroller::class, 'forget'])->name('changepassword');
    Route::post('forgetpassword', [ForgetPasswordcontroller::class, 'forgetpassword'])->name('forgetpassword');
    Route::get('ChangePassword', [ForgetPasswordcontroller::class, 'ChangePassword'])->name('ChangePassword');
    Route::post('ChangePasswordSave', [ForgetPasswordcontroller::class, 'ChangePasswordSave'])->name('ChangePasswordSave');
});


//Route::group(['middleware' => 'admin'], function () {
    //---------Admin---------------//
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('role', RolePermissionController::class);
    Route::resource('user', UserController::class);
    Route::resource('page', PageController::class);
//});
