<?php
Route::get('reboot', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    file_put_contents(storage_path('logs/laravel.log'),'');
    Artisan::call('key:generate');
    Artisan::call('config:cache');
    return '<center><h1>System Rebooted!</h1></center>';
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('myself', 'HomeController@myself');
Route::post('myself', 'HomeController@myselfSubmit');

Route::get('image', 'HomeController@image');
Route::post('image', 'HomeController@imageSubmit');

Route::get('change-password', 'HomeController@changePassword');
Route::post('change-password', 'HomeController@changePasswordSubmit');

Route::resource('members', 'MembersController');

Route::resource('expenses', 'ExpensesController');
Route::get('expenses/{id}/view', 'ExpensesController@view');

Route::resource('meals', 'MealsController');

Route::resource('monthly-calculation', 'MonthlyCalculationController');

Auth::routes();
