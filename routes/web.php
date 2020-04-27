<?php

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

Route::get('/', 'Auth\RegisterController@index');

Auth::routes();

Route::get('/success', function () {
    return view('success');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');

//Events::

Route::get('admin/events', 'AdminController@events')->name('events')->middleware('admin'); // Список всех мероприятий

Route::post('admin/events', 'AdminController@store')->name('create_event')->middleware('admin'); // Создания

Route::get('admin/events/{id}/delete', 'AdminController@destroy')->name('delete_event')->middleware('admin'); //Удаление

Route::patch('admin/events/update_all', 'AdminController@update_all')->name('update_events')->middleware('admin'); //Редактирование списком

Route::patch('admin/events/{id}/update', 'AdminController@update')->name('update_event')->middleware('admin'); //Редактирование одного мероприятия





