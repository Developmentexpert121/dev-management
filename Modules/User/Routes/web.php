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


// ***************************** Admin Route ****************************************************//

Route::prefix('admin')->group(function() {

    Route::get('/', 'UserController@index'); 
    Route::get('dashbaord','UserController@dashbaord')->middleware('CheckRole'); 
    Route::get('user','UserController@addUser')->middleware('CheckRole'); 
    Route::get('userlist', 'UserController@userlist')->middleware('CheckRole'); 
    Route::get('user/view/{id}','UserController@view')->middleware('CheckRole');  
    Route::post('edit/users/data','UserController@edit_user')->middleware('CheckRole');  
    Route::get('user/edit/{id}','UserController@user_edit')->middleware('CheckRole'); 
    Route::post('newuser','UserController@index')->middleware('CheckRole');
    Route::get('user/delete/{id}','UserController@delete')->middleware('CheckRole');  
    
    Route::get('/user/profile','UserController@profile')->middleware('CheckRole');
    Route::get('/user/manage-profile/profile-and-visibility','UserController@manageprofile')->middleware('CheckRole');
    Route::get('/user/change-password','UserController@security')->middleware('CheckRole')->name('change.password');
    Route::post('/user/change-password','UserController@changePassword')->middleware('CheckRole')->name('change.password');
    Route::get('/user/profile-email','UserController@profileEmail')->middleware('CheckRole');
    

});
    Route::post('/user/user_job_title','UserController@user_job_title');
    Route::post('/user/your_department','UserController@your_department');
    Route::post('/user/your_organisation','UserController@your_organisation');
    Route::post('/user/your_location','UserController@your_location');
    Route::post('photo','UserController@save');
 
// *****************************End Admin Route ****************************************************//




       // ***************************** Tl Route ****************************************************//

       Route::group(['middleware' => ['auth:web','CheckRole'], 'prefix' => 'team_leader'],function() 
       {
           Route::get('dashbaord','TeamLeaderController@dashbaord');  
       });
  
       //*******************************End Tl Route*************************************************//




       
      // ***************************** Employee Route ****************************************************//

      Route::group(['middleware' => ['auth:web','CheckRole'], 'prefix' => 'employee'],function() 
      {
        Route::get('dashbaord','EmployeeController@dashbaord'); 
       
      });
       //*******************************end Employee  Route*************************************************//

       
        // ***************************** Manager Route ****************************************************//
        Route::group(['middleware' => ['auth:web','CheckRole'], 'prefix' => 'manager'],function() 
        {
           Route::get('dashbaord','ManagerController@dashbaord');   
        
        });  
           //*******************************end Manager Route*************************************************//


                   
           
        // ***************************** hr Route ****************************************************//
        Route::group(['middleware' => ['auth:web','CheckRole'], 'prefix' => 'hr'],function() 
        {
        Route::get('dashbaord','HrController@dashbaord'); 
        });

        //*******************************end hr Route*************************************************//

