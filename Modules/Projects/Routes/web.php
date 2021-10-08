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
use Http\Controllers\Projects2Controller;

Route::prefix('projects')->group(function() {

    Route::get('/', 'Projects2Controller@index');
	Route::post('team/project/settings_save', 'Projects2Controller@settings_save');
	Route::post('team/project/add_task', 'Projects2Controller@taskSave');
	Route::post('team/project/issueadd', 'Projects2Controller@saveIssue');
	Route::post('team/project/add_sprint', 'Projects2Controller@saveSprint');


	

	// Route::get('team/{id}/roadmap', 'Projects2Controller@roadmap');
	
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

	Route::get('project/edit_sprint/{project_id}/{edit_id}/','Projects2Controller@edit_sprint');

	Route::post('project/team/sprints/edit/{id}','Projects2Controller@editData_sprint'); 
	
	Route::get('project/team/delete_sprint/{project_id}/{delete_id}','Projects2Controller@delete_sprint'); 
	  
	
	

	// Route::get('dashbaord', [DashbaordController::class, 'index'])->middleware('CheckRole');
	Route::get('project/team/{id}','TeamController@load_page')->middleware('CheckRole');
	Route::get('project/team/{id}/settings','TeamController@project_settngs')->middleware('CheckRole');
	Route::get('project/team/{id}/roadmap','Projects2Controller@roadmap')->middleware('CheckRole');
	Route::get('project/team/{id}/sprints','Projects2Controller@sprints')->middleware('CheckRole');
	Route::get('project/team/{id}/backlog','Projects2Controller@backlog')->middleware('CheckRole');
    Route::get('project/team/{id}/issues','Projects2Controller@project_issues')->middleware('CheckRole');

 
	Route::get('add/category','Projects2Controller@category')->middleware('CheckRole');
	Route::post('save/category','Projects2Controller@savecategory')->middleware('CheckRole');
	Route::get('edit/category/{id}','Projects2Controller@editCategory')->middleware('CheckRole');
	Route::post('editdata/category/{id}','Projects2Controller@editDataCat')->middleware('CheckRole');
	Route::get('delete/category/{id}','Projects2Controller@deleteCat')->middleware('CheckRole');

	
	  
});