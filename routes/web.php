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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\String\ByteString;

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
        return view('home.home');
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
    
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashshow'])->name('dashboard');
    Route::resource('role', RolePermissionController::class);
    Route::resource('user', UserController::class);
    Route::resource('page', PageController::class);
//});


//for html tamplate //
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('missionvission', [App\Http\Controllers\HomeController::class, 'missionvission'])->name('mission_vission');
Route::get('contactus', [App\Http\Controllers\HomeController::class, 'contactus'])->name('contactus');

Route::get('termscondition', [App\Http\Controllers\HomeController::class, 'specials'])->name('termscondition');
Route::get('blog', [HomeController::class, 'blog'])->name('blog');
Route::get('content/{id}', [HomeController::class, 'content'])->name('content');

Route::get('api', function(){

    $clientapikey = 'globalgatewaytest';
    $secretkey = 'Glo@61334398';
    $timestamp = strtotime('now');
    $tobehashed = $clientapikey . $secretkey . $timestamp;
    $bytes = utf8_encode($tobehashed);
    $encoded = base64_encode($bytes);
    $signature = hash('sha512', $encoded);
    dd($clientapikey, $secretkey, $timestamp, $tobehashed, $signature, $encoded);

    
})->name('api_post');

Route::get('ajax', function(){
    return view('home.ajax');

});


