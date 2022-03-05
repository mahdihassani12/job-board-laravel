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

// index page controller
Route::get('/','HomeController@index')->name('index');

// login / register routes
Route::get('login','LoginController@login')->name('login');
Route::post('postLogin','LoginController@postLogin')->name('postLogin');
Route::get('register','LoginController@register')->name('register');
Route::post('postRegister','LoginController@postRegister')->name('postRegister');
Route::post('postRegisterCo','LoginController@postRegisterCo')->name('postRegisterCo');
Route::put('register/update/{id}','LoginController@update')->name('register.update');
Route::delete('register/destroy/{id}','LoginController@destroy')->name('register.destroy');


// user protected routes
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', 'HomeController@index')->name('user_dashboard');
    Route::get('user_profie','UsersController@user_profile')->name('user_profile');
    Route::resource('student','StudentsController');
    Route::resource('document','DocumentsController');
    Route::resource('reference','ReferencesController');
    Route::resource('experience','ExperienceController');
    Route::put('student_setting/{id}','StudentsController@studentSetting')->name('studentSetting');
});

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin_dashboard');
    Route::get('admin_profie','UsersController@admin_profile')->name('admin_profile');
    Route::resource('jobs','PostsController');
    Route::resource('admin','backend\adminController');
    Route::get('companies_lists','backend\adminController@companies_lists')->name('admin.companies');
    Route::get('students_lists','backend\adminController@students_lists')->name('admin.students');
    Route::get('jobs_lists','backend\adminController@jobs_lists')->name('admin.jobs');
    Route::resource('faculties','backend\facultyController');
    Route::resource('departments','backend\departmentController');
    Route::resource('categories','backend\categoryController');
    Route::resource('skills','skillsController');
    Route::get('add_student','LoginController@addStudent')->name('add_student');
    Route::get('getImport','LoginController@getImport')->name('getImport');
    Route::post('importExcel','LoginController@importExcel')->name('importExcel');
    Route::get('ExportExcel','LoginController@ExportExcel')->name('ExportExcel');
    Route::resource('blog','backend\blogController');
    Route::resource('info','contactInfoController');
    Route::put('updateCompany/{id}','UsersController@updateCred')->name('updateCred');
    Route::get('settings','backend\adminController@settings')->name('settings.index');
    Route::resource('setting','backend\settingsController');
    Route::get('editStudentList/{id}','LoginController@editStudentList')->name('editStudentList');
    Route::put('updateStudentList/{id}','LoginController@updateStudentList')->name('updateStudentList');
    Route::delete('deleteStudentList/{id}','LoginController@deleteStudentList')->name('deleteStudentList');
    Route::get('studentAccepted','StudentsController@getStudents')->name('getStudents');
});

// company protected routes
Route::group(['middleware' => ['auth', 'company'], 'prefix' => 'company'], function () {
    Route::get('/', 'HomeController@index')->name('company_dashboard');
    Route::get('company_profie','UsersController@company_profile')->name('company_profile');
    Route::resource('company','CompanyMetaController');
    Route::resource('jobs','PostsController');
    Route::put('company_setting/{id}','UsersController@companySetting')->name('companySetting');
    Route::put('studentAccepted/{id}','StudentsController@studentAccepted')->name('studentAccepted');
});

// Pages
Route::get('jobs_page','PagesController@job_page')->name('jobs.page');
Route::get('job_details/{id}','PagesController@job_detail')->name('job.detail');
Route::get('companies_page','PagesController@companies_page')->name('companies.page');
Route::get('companies_page/{id}','PagesController@company_details')->name('company.detail');
Route::get('students_page','PagesController@students_page')->name('students.page');
Route::get('students_page/{id}','PagesController@student_detail')->name('student.detail');
Route::resource('message','MessagesController');
Route::get('blogPage','PagesController@blogPage')->name('blog.page');;
Route::get('singleBlog/{id}','PagesController@singleBlog')->name('blog.single');;
Route::get('contact','PagesController@contact')->name('contact');
Route::post('contact_message','contactMessagesController@store')->name('contact.store');
Route::get('contact_message/{id}','contactMessagesController@show')->name('contact.show');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('homeSearch','PostsController@homeSearch')->name('homeSearch');
Route::post('archiveSearch','PostsController@archiveSearch')->name('archiveSearch');
Route::post('studentsSearch','StudentsController@studentsSearch')->name('studentsSearch');
Route::post('companiesSearch','CompanyMetaController@companiesSearch')->name('companiesSearch');
Route::resource('enrolls','enrollsController');
Route::get('forget','LoginController@forget')->name('forget');
Route::post('checkEmail','LoginController@checkEmail')->name('checkEmail');
Route::post('postCategory','backend\categoryController@postCategory')->name('postCategory');