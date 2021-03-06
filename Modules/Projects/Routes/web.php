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
use Http\Controllers\ProjectsMainController;
//use Http\Controllers\ProjectsController;

Route::prefix('projects')->group(function() 
{
      
    Route::get('/', 'ProjectsMainController@index'); 
	Route::post('team/project/settings_save', 'ProjectsMainController@settings_save');
	Route::post('team/project/add_task', 'ProjectsMainController@taskSave');
	Route::post('team/project/issueadd', 'ProjectsMainController@saveIssue');
	Route::post('team/project/add_sprint', 'ProjectsMainController@saveSprint');
	Route::post('sprint/create_issue/action','ProjectsMainController@action_issue');
    Route::get('team/sprint/delete/issue_create/{id}','ProjectsMainController@delete_issue');
    Route::post('team/create/issue/updateted','ProjectsMainController@update_issue');  
    Route::get('team/issue/delete/{id}','ProjectsMainController@issue_delete');
    Route::post('team/create/issue/update','ProjectsMainController@issue_update'); 
    Route::post('team/sprint/blackLogMove','ProjectsMainController@blackLogMove'); 
	Route::post('team/edit/blackLog/{id}','ProjectsMainController@editBlackLog'); 
	Route::post('team/delete/blackLog/{id}','ProjectsMainController@deleteBlackLog');  
	Route::post('team/create_issue','ProjectsMainController@create_issue');    

	
    
    
	// Route::get('team/{id}/roadmap', 'ProjectsMainController@roadmap');

	//=================== company================================
	Route::post('company/project/add_sprint', 'CompanyController@saveSprint');
	
	Route::get('/company/{id}/sprints','CompanyController@sprints'); 
	Route::post('/company/sprint/add_issue_create','CompanyController@add_issue_create');
	Route::get('/sprint/company/create_issue/{project_id}/{sprint_id}','CompanyController@sprint_create_issue');
	Route::get('company/edit_sprint/{project_id}/{edit_id}/','CompanyController@edit_sprint');
	Route::post('company/sprints/edit/{id}','CompanyController@editData_sprint');
	Route::get('company/delete_sprint/{project_id}/{delete_id}','CompanyController@delete_sprint');
	Route::get('company/{project_id}/board','CompanyController@board'); 
	Route::get('company/{project_id}/boardmove','CompanyController@boardMove');
	Route::get('company/{id}/backlog','CompanyController@backlog')->middleware('CheckRole');
	Route::post('company/edit/backLog/{id}','CompanyController@editBlackLog'); 
	Route::post('company/delete/backLog/{id}','CompanyController@deleteBlackLog');
	Route::post('company/sprint/blackLogMove','CompanyController@blackLogMove');
	Route::get('company/{id}/settings','CompanyController@project_settngs')->middleware('CheckRole')->name('company.detail');
	Route::post('company/details','CompanyController@project_company_detail_save')->middleware('CheckRole')->name('company.detail');
	Route::get('company/{id}/createissue','CompanyController@roadmap')->middleware('CheckRole');
	Route::post('company/create_issue','CompanyController@create_issue');
	
}); 
	

Route::prefix('admin')->group(function()
{  
	
	Route::get('project/template', 'ProjectsMainController@index')->middleware('CheckRole');
	Route::get('project/scrum/template', 'ProjectsMainController@scrum_template')->middleware('CheckRole');
	Route::get('project/scrum/team_management', 'ProjectsMainController@team_management')->middleware('CheckRole');  
	Route::get('project/scrum/company_management', 'ProjectsMainController@company_management')->middleware('CheckRole');  
	Route::post('project/scrum/slug', 'ProjectsController@slug')->middleware('CheckRole');  
	Route::post('project/scrum/company_management/insert','ProjectsMainController@company_management_insert')->middleware('CheckRole');
	Route::post('project/scrum/team_management/insert','ProjectsMainController@team_management_insert')->middleware('CheckRole');
	Route::get('project/information','ProjectsMainController@information')->middleware('CheckRole');
	Route::get('project/view/{id}','ProjectsController@view')->middleware('CheckRole');
	Route::get('project/{id}/settings','ProjectsController@project_settngs')->middleware('CheckRole');
	Route::post('project-save','ProjectsController@project_photo_save')->name('project.save');
	Route::get('project/delete/{id}','ProjectsController@delete')->middleware('CheckRole'); 
	// Route::get('project/company/{id}','CompanyController@index')->middleware('CheckRole');
	// Route::get('project/company/{id}/sprints','CompanyController@sprints')->middleware('CheckRole'); 
	// Route::post('projects/company/sprint/add_issue_create','CompanyController@add_issue_create');
	// // Route::get('project/team/{id}','teamController@projectview')->middleware('CheckRole');
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

	Route::get('project/edit_sprint/{project_id}/{edit_id}/','ProjectsMainController@edit_sprint');

	Route::post('project/team/sprints/edit/{id}','ProjectsMainController@editData_sprint'); 
	
	Route::get('project/team/delete_sprint/{project_id}/{delete_id}','ProjectsMainController@delete_sprint'); 
	  
	
	// Route::get('dashbaord', [DashbaordController::class, 'index'])->middleware('CheckRole');
	Route::get('project/team/{id}','TeamController@load_page')->middleware('CheckRole');
	Route::get('project/team/{id}/settings','TeamController@project_settngs')->middleware('CheckRole');
	Route::get('project/team/{id}/createissue','ProjectsMainController@createissue')->middleware('CheckRole');
	Route::get('project/team/{id}/sprints','ProjectsMainController@sprints')->middleware('CheckRole');
	Route::get('project/team/{id}/backlog','ProjectsMainController@backlog')->middleware('CheckRole');
    Route::get('project/team/{id}/issues','ProjectsMainController@project_issues')->middleware('CheckRole');
    Route::get('project/team/{id}/access','ProjectsMainController@settings_access')->middleware('CheckRole');

   
	//Route::get('role','AdminController@role')->middleware('CheckRole');  
	Route::post('create/role','AdminController@roleAdd')->middleware('CheckRole');   
	Route::post('delete/role','AdminController@delete_role')->middleware('CheckRole');




	Route::post('save/category','ProjectsMainController@savecategory')->middleware('CheckRole');
	Route::get('edit/category/{id}','ProjectsMainController@editCategory')->middleware('CheckRole');
	Route::post('editdata/category/{id}','ProjectsMainController@editDataCat')->middleware('CheckRole');
	Route::get('delete/category/{id}','ProjectsMainController@deleteCat')->middleware('CheckRole');
 
	
	Route::get('project/sprint/create_issue/{project_id}/{sprint_id}','ProjectsMainController@sprint_create_issue');

	

	Route::post('projects/team/sprint/blackLogIssueCreate','ProjectsMainController@blackLogIssueCreate');
 
	Route::post('projects/team/sprint/add_issue_create','ProjectsMainController@add_issue_create');
	Route::post('projects/team/start/sprint','ProjectsMainController@add_issue_create');
	Route::post('projects/team/sprint/start','ProjectsMainController@start_sprint');
    
	Route::post('projects/team/sprint/complete','ProjectsMainController@complete_sprint'); 
	 


    Route::get('project/team/{project_id}/board','ProjectsMainController@board'); 

	Route::get('project/team/{project_id}/boardmove','ProjectsMainController@boardMove');  
	

	//  company 
	Route::get('/project/company/{id}','CompanyController@index');
	  
});

Route::post('photo-save','TeamController@project_photo_save')->middleware('CheckRole')->name('save.detail');



 Route::prefix('ceo')->group(function()
 { 

	Route::get('project/information','ProjectsMainController@information')->middleware('CheckRole');
	Route::get('project/template', 'ProjectsMainController@index')->middleware('CheckRole');
	Route::get('project/scrum/template', 'ProjectsMainController@scrum_template')->middleware('CheckRole');
	Route::get('project/scrum/team_management', 'ProjectsMainController@team_management')->middleware('CheckRole'); 
	Route::post('project/scrum/team_management/insert','ProjectsMainController@team_management_insert')->middleware('CheckRole'); 
	Route::get('project/scrum/company_management', 'ProjectsMainController@company_management')->middleware('CheckRole'); 
	Route::post('project/scrum/company_management/insert','ProjectsMainController@company_management_insert')->middleware('CheckRole'); 
	Route::get('project/team/{id}/sprints','ProjectsMainController@sprints')->middleware('CheckRole');
	Route::get('project/sprint/create_issue/{project_id}/{sprint_id}','ProjectsMainController@sprint_create_issue');
	Route::post('projects/team/sprint/add_issue_create','ProjectsMainController@add_issue_create');
	Route::get('project/team/{id}/backlog','ProjectsMainController@backlog')->middleware('CheckRole');
	Route::get('project/team/{project_id}/board','ProjectsMainController@board')->middleware('CheckRole'); 
	Route::get('project/team/{id}/createissue','ProjectsMainController@createissue')->middleware('CheckRole');
	Route::get('project/team/{id}','TeamController@load_page')->middleware('CheckRole');
	Route::get('/project/company/{id}','CompanyController@index')->middleware('CheckRole');
	Route::get('project/team/{project_id}/boardmove','ProjectsMainController@boardMove');  
	
	
 });  


Route::prefix('cto')->group(function()
{   
	 Route::get('project/information','ProjectsMainController@information')->middleware('CheckRole');
	 Route::get('project/template', 'ProjectsMainController@index')->middleware('CheckRole');
	 Route::get('project/scrum/template', 'ProjectsMainController@scrum_template')->middleware('CheckRole');
	 Route::get('project/scrum/team_management', 'ProjectsMainController@team_management')->middleware('CheckRole'); 
	 Route::post('project/scrum/team_management/insert','ProjectsMainController@team_management_insert')->middleware('CheckRole'); 
	 Route::get('project/scrum/company_management', 'ProjectsMainController@company_management')->middleware('CheckRole'); 
	 Route::post('project/scrum/company_management/insert','ProjectsMainController@company_management_insert')->middleware('CheckRole');
	 Route::get('project/team/{id}/sprints','ProjectsMainController@sprints')->middleware('CheckRole'); 
	 Route::get('project/sprint/create_issue/{project_id}/{sprint_id}','ProjectsMainController@sprint_create_issue');
	 Route::post('projects/team/sprint/add_issue_create','ProjectsMainController@add_issue_create');
	 Route::get('project/edit_sprint/{project_id}/{edit_id}/','ProjectsMainController@edit_sprint');
	 Route::post('project/team/sprints/edit/{id}','ProjectsMainController@editData_sprint'); 
	 Route::get('project/team/delete_sprint/{project_id}/{delete_id}','ProjectsMainController@delete_sprint'); 
	 Route::get('project/team/{id}/createissue','ProjectsMainController@createissue')->middleware('CheckRole');
	 Route::get('project/team/{id}/backlog','ProjectsMainController@backlog')->middleware('CheckRole');
	 Route::get('project/team/{project_id}/board','ProjectsMainController@board'); 
	 Route::get('project/team/{id}','TeamController@load_page')->middleware('CheckRole');
	 Route::get('/project/company/{id}','CompanyController@index');
	 Route::get('project/team/{project_id}/boardmove','ProjectsMainController@boardMove');  

});  

 Route::prefix('team_leader')->group(function()
 {    

	Route::get('project/template', 'ProjectsMainController@index')->middleware('CheckRole');
    Route::get('project/assign','TeamLeaderController@index')->middleware('CheckRole'); 
	Route::get('project/team/{id}/sprints','ProjectsMainController@sprints')->middleware('CheckRole');
	Route::get('project/team/{id}/createissue','ProjectsMainController@createissue')->middleware('CheckRole');
	Route::get('project/team/{id}/backlog','ProjectsMainController@backlog')->middleware('CheckRole');
    Route::get('project/team/{project_id}/board','ProjectsMainController@board'); 
	Route::get('project/sprint/create_issue/{project_id}/{sprint_id}','ProjectsMainController@sprint_create_issue');
	Route::get('project/edit_sprint/{project_id}/{edit_id}/','ProjectsMainController@edit_sprint'); 
	Route::post('project/team/sprints/edit/{id}','ProjectsMainController@editData_sprint'); 
	Route::get('project/team/delete_sprint/{project_id}/{delete_id}','ProjectsMainController@delete_sprint'); 
	Route::post('projects/team/sprint/complete','ProjectsMainController@complete_sprint'); 
	Route::post('projects/team/sprint/add_issue_create','ProjectsMainController@add_issue_create');
	Route::get('/project/company/{id}','CompanyController@index'); 
	Route::get('project/scrum/template', 'ProjectsMainController@scrum_template')->middleware('CheckRole');
	Route::get('project/scrum/team_management', 'ProjectsMainController@team_management')->middleware('CheckRole');  
	Route::post('project/scrum/team_management/insert','ProjectsMainController@team_management_insert')->middleware('CheckRole');
	Route::get('project/team/{id}','TeamController@load_page')->middleware('CheckRole');
	Route::get('project/scrum/company_management', 'ProjectsMainController@company_management')->middleware('CheckRole');  
	Route::post('project/scrum/company_management/insert','ProjectsMainController@company_management_insert')->middleware('CheckRole');
    Route::get('project/team/{project_id}/boardmove','ProjectsMainController@boardMove');  
	
 });

 Route::prefix('employee')->group(function()
 {    
     Route::get('project/assign','TeamLeaderController@index')->middleware('CheckRole'); 
	 Route::get('project/team/{id}','TeamController@load_page')->middleware('CheckRole');
	 Route::get('project/team/{id}/sprints','ProjectsMainController@sprints')->middleware('CheckRole');
	 Route::get('project/sprint/create_issue/{project_id}/{sprint_id}','ProjectsMainController@sprint_create_issue')->middleware('CheckRole');
	 Route::post('projects/team/sprint/add_issue_create','ProjectsMainController@add_issue_create');
	 Route::get('project/team/{id}/createissue','ProjectsMainController@createissue')->middleware('CheckRole');
	 Route::get('project/team/{id}/backlog','ProjectsMainController@backlog')->middleware('CheckRole');
	 Route::get('project/team/{project_id}/board','ProjectsMainController@board'); 
	 Route::get('/project/company/{id}','CompanyController@index');
	 Route::get('project/team/{project_id}/boardmove','ProjectsMainController@boardMove');  
	

 });



 