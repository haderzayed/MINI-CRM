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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() { //...
    Auth::routes(['register' => false]);
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['middleware'=>['auth']],function(){
        Route::resource('companies','CompaniesController');
        Route::resource('ContactPeople','ContactPeopleController');
        Route::resource('admins','AdminsController')->middleware('superAdmin');

    });
});

Route::get('/', function () {
    return view('welcome');
});






