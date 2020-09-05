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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'is.enabled']);

Auth::routes();

// Routes that need authentication
Route::prefix('admin')->middleware(['auth', 'is.enabled'])->group(
    function () {
        // Routes in general for any user authenticated
        Route::view('settings', 'settings')->name('settings');
        Route::post('/update_password', 'UserConfigController@updatepassword')->name('update_password');

        //Routes for data in forms
        Route::get('api/data_user', 'DataFormController@data_user');
        Route::get('api/data_department', 'DataFormController@data_department');
        Route::get('api/data_dates_complaint', 'DataFormController@data_dates_complaint');
        Route::get('api/data_tender_section', 'DataFormController@data_tender_section');
        Route::get('api/date', 'DataFormController@date');

        //Routes for data by ID
        Route::get('api/user_id/{id}', 'DataByIdController@user_id');
        Route::get('api/department_user_id/{id}', 'DataByIdController@department_user_id');

        // Routes for System Administrator
        Route::middleware(['has.permission:1'])->group(
            function () {
                $route = "/admin/";
                Route::view('permissions', $route . 'permission')->name('permissions');
                Route::view('users', $route . 'user')->name('users');
                Route::view('statistics/system', $route . 'statistics_system')->name('statistics_system');
                Route::view('statistics/business', $route . 'statistics_website')->name('statistics_business');
                Route::get('details/user', 'StatisticsController@details_user');
                Route::get('details/permission', 'StatisticsController@details_permission');
                Route::get('details/complaint/{dates}', 'StatisticsController@details_complaint');
                Route::get('details/machine', 'StatisticsController@details_machine');
                Route::get('details/advertisement', 'StatisticsController@details_advertisement');
                Route::get('details/tender', 'StatisticsController@details_tender');
                Route::resource('api/user', 'UserController')->except([
                    'show', 'edit', 'create'
                ]);
                Route::resource('api/permission', 'PermissionController')->except([
                    'update', 'edit', 'create'
                ]);
            }
        );
        // Routes for Complaint Administrator.
        Route::middleware(['has.permission:2'])->group(
            function () {
                Route::view('complaints', 'permission/complaint')->name('complaints');
                Route::resource('api/complaint', 'ComplaintController')->only([
                    'index', 'destroy'
                ]);
            }
        );
        // Routes for Advertisement Manager.
        Route::middleware(['has.permission:3'])->group(
            function () {
                Route::view('advertisements', 'permission/advertisement')->name('advertisements');
                Route::resource('api/advertisement', 'AdvertisementController')->except([
                    'show', 'edit', 'create'
                ]);
            }
        );
        // Routes for Machine Monitor.
        Route::middleware(['has.permission:4'])->group(
            function () {
                Route::view('machine_state', 'permission/machine_state')->name('machine_state');
                Route::resource('api/machine_state', 'MachineStateController')->only([
                    'index', 'update'
                ]);
            }
        );
        // Routes for Tender Administrator.
        Route::middleware(['has.permission:5'])->group(
            function () {
                Route::view('tenders', 'permission/tender')->name('tenders');
                Route::resource('api/tender', 'TenderController')->except([
                    'index', 'edit', 'create'
                ]);
                Route::resource('api/tender_section', 'TenderSectionController')->except([
                    'show', 'edit', 'create'
                ]);
            }
        );
    }
);

Route::view('user_disabled', 'user_disabled')->middleware(['auth', 'is.not.enable']);
Route::post('/update_password', 'UserConfigController@updatepassword')->name('update_password')
    ->middleware(['auth', 'is.enable']);
