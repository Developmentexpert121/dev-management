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



Route::prefix('admin')->group(function(){
    
Route::get('project/template', 'ProjectsController@index')->middleware('CheckRole');
Route::get('project/scrum/template', 'ProjectsController@scrum_template')->middleware('CheckRole');
Route::get('project/scrum/team_management', 'ProjectsController@team_management')->middleware('CheckRole');  
Route::get('project/scrum/company_management', 'ProjectsController@company_management')->middleware('CheckRole');  
Route::post('project/scrum/slug', 'ProjectsController@slug')->middleware('CheckRole');  
Route::post('project/scrum/company_management/insert','ProjectsController@company_management_insert')->middleware('CheckRole');
Route::post('project/scrum/team_management/insert','ProjectsController@team_management_insert')->middleware('CheckRole'); 

}); 
