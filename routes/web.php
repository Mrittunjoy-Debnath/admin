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

Route::get('/', 'HomeController@HomeIndex');
Route::get('/visitor', 'VisitorController@VisitorIndex');

//Admin panel service management
Route::get('/service', 'ServiceController@ServiceIndex');
Route::get('/getServicesData', 'ServiceController@getServicesData');
Route::post('/ServiceDelete', 'ServiceController@ServiceDelete');
Route::post('/ServiceDetails', 'ServiceController@getServicesDetails');
Route::post('/ServiceUpdate', 'ServiceController@ServiceUpdate');
Route::post('/ServiceAdd', 'ServiceController@ServiceAdd');


//Admin panel courses management
Route::get('/Courses', 'CoursesController@CoursesIndex');
Route::get('/getCoursesData', 'CoursesController@getCoursesData');
Route::post('/CoursesDelete', 'CoursesController@CoursesDelete');
Route::post('/CoursesDetails', 'CoursesController@getCoursesDetails');
Route::post('/CoursesUpdate', 'CoursesController@CoursesUpdate');
Route::post('/CoursesAdd', 'CoursesController@CoursesAdd');

// Admin Panel Projects Management
Route::get('/Project', 'ProjectController@ProjectIndex');
Route::get('/getProjectData', 'ProjectController@getProjectData');
Route::post('/ProjectDetails', 'ProjectController@getProjectDetails');
Route::post('/ProjectDelete', 'ProjectController@ProjectDelete');
Route::post('/ProjectUpdate', 'ProjectController@ProjectUpdate');
Route::post('/ProjectAdd', 'ProjectController@ProjectAdd');
