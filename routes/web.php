<?php

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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('checkLogin')->group(function () {
    Route::resource('user','UserController');
    Route::resource('roles','RolesController');
    Route::resource('faculty','FacultyController');
    Route::resource('teacher','TeacherController');
    Route::resource('class','ClassController');
    Route::resource('student','StudentController');

    Route::get('/messsage', 'MessageController@index')->name('message.index');
    route::post('/messages','MessageController@messages')->name('message.messages');
    route::post('/send/messages','MessageController@sendMessages')->name('message.send');

    Route::get('users/account','UserController@account')->name('user.account');
}); 

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');