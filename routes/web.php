<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersContollerRole;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamLeaderController;   
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController; 
use App\Http\Controllers\HrController; 

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

Route::get('/',function (){
	return redirect('login');
}); 

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return redirect('dashbaord');
})->name('dashboard');  

Route::get('dashbaord', [DashbaordController::class, 'index'])->middleware('CheckRole');

Auth::routes();    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');