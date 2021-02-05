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

// Routes for people in general
Route::get('/','IndexController@index' )->name('index');

Route::get('blog/{post}', 'PageController@post')->name('blog');
Route::get('blog', 'PageController@posts')->name('blogs');

Auth::routes(['register' => false]);

// Routes that need authentication
Route::prefix('admin')->middleware(['auth', 'is.enabled'])->group(
    function () {
        // Routes in general for any user authenticated
        Route::view('/home', 'app.home')->name('home');
        Route::get('/settings', 'SettingController@index')->name('password.index');
        Route::post('/update_password', 'SettingController@update')->name('password.update');

        //Routes for data in forms
        Route::get('api/data_user', 'DataFormController@data_user');
        Route::get('api/data_department', 'DataFormController@data_department');
        Route::get('statistics/data_dates_complaint', 'DataFormController@data_dates_complaint');
        Route::get('api/data_tender_section', 'DataFormController@data_tender_section');
        Route::get('api/date', 'DataFormController@date');

        //Routes for data by ID
        Route::get('api/user_id/{id}', 'DataByIdController@user_id');
        Route::get('api/department_user_id/{id}', 'DataByIdController@department_user_id');

        // Routes for System Administrator
        Route::middleware(['has.permission:1'])->group(
            function () {
                $route = "/admin/";
                Route::get('permissions', 'PermissionController@index')->name('permissions');
                Route::view('users', $route . 'user')->name('users');
                Route::get('statistics/system', 'StatisticsController@system')->name('statistics_system');
                Route::get('statistics/business', 'StatisticsController@business')->name('statistics_business');
                Route::get('statistics/detail_complaint/{dates}', 'StatisticsController@detail_complaint');
                Route::resource('api/user', 'UserController')->except([
                    'show', 'edit', 'create'
                ]);
                Route::delete('/api/user/{id}/disable', 'UserController@disabled');
                // Route to disable and enable
                Route::resource('api/permission', 'PermissionController')->except([
                    'index', 'update', 'edit'
                ]);
            }
        );
        // Routes for Complaint Administrator.
        Route::middleware(['has.permission:2'])->group(
            function () {
                Route::view('complaints', 'app/complaint')->name('complaints');
                Route::resource('api/complaint', 'ComplaintController')->only([
                    'index', 'destroy'
                ]);
            }
        );
        // Routes for Advertisement Manager.
        Route::middleware(['has.permission:3'])->group(
            function () {
                Route::get('advertisements', 'AdvertisementController@index')->name('advertisements');
                Route::resource('api/advertisement', 'AdvertisementController')->except([
                    'index', 'show', 'edit', 'create'
                ]);
            }
        );
        // Routes for Machine Monitor.
        Route::middleware(['has.permission:4'])->group(
            function () {
                Route::view('machine_state', 'app/machine_state')->name('machine_state');
                Route::resource('api/machine_state', 'MachineStateController')->only([
                    'index', 'update'
                ]);
            }
        );
        // Routes for Tender Administrator.
        Route::middleware(['has.permission:5'])->group(
            function () {
                Route::get('tenders', 'TenderSectionController@index')->name('tenders');
                Route::resource('api/tender', 'TenderController')->except([
                    'index', 'edit', 'create'
                ]);
                Route::resource('api/tender_section', 'TenderSectionController')->except([
                    'index', 'show', 'edit', 'create'
                ]);
            }
        );
        // Routes for Post Administrator.
        Route::middleware(['has.permission:6'])->group(
            function () {
                Route::resource('posts', 'Backend\PostController')->except('show');
            }
        );
    }
);

Route::view('user_disabled', 'auth/user_disabled')->middleware(['auth', 'is.not.enabled'])->name('user_disabled');
