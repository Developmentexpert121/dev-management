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

Route::prefix('projects')->group(function() {
    Route::get('/', 'ProjectsController@index');
}); 

Route::get('admin/project/template', 'ProjectsController@index');
Route::get('admin/project/scrum/template', 'ProjectsController@scrum_template');
Route::get('admin/project/scrum/team_management', 'ProjectsController@team_management');  
Route::get('admin/project/scrum/company_management', 'ProjectsController@company_management');  
Route::post('admin/project/scrum/slug', 'ProjectsController@slug');