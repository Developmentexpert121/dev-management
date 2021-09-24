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



Route::get('project/information','ProjectsController@information')->middleware('CheckRole'); 



Route::get('project/company/{id}','companyController@index')->middleware('CheckRole'); 
// Route::get('project/team/{id}','teamController@projectview')->middleware('CheckRole'); 


Route::get('project/team/{id}','TeamController@load_page')->middleware('CheckRole');
Route::get('project/team/backlog/{id}','TeamController@backlog_view')->middleware('CheckRole');
Route::get('project/team/createissue/{id}','TeamController@create_issue')->middleware('CheckRole');
Route::post('project/team/save_issue','TeamController@store_issue')->middleware('CheckRole');

// Route::post('project/team/save_sprint','TeamController@store_sprints')->middleware('CheckRole');
//Route::get('project/team/{id}/backlog','TeamController@count_sprints')->middleware('CheckRole');
Route::any('project/team/backlog/create_sprint','TeamController@create_sprint')->middleware('CheckRole');
Route::get('project/team/active_sprints','TeamController@active_sprints')->middleware('CheckRole');
Route::post('project/team/save_sprint','TeamController@store_sprints')->middleware('CheckRole');
Route::get('project/team/backlog/sprints/form/{id}','TeamController@sprint_view')->middleware('CheckRole');
Route::get('project/team/sprint/detail/{id}/{issue_id}','TeamController@single_sprint')->middleware('CheckRole');
});  

