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

Route::get('/', function () {
    if( Auth::guest()) {
        return view('welcome');
    }
    else{
        return redirect()->route('home');
    }
})->name('main');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('chart')->group(function () {
        Route::prefix('custom')->group(function () {
            Route::get('/', 'chartController@customs')->name('chart.customs.view');
            Route::get('getCustoms', [
                'uses' => 'chartController@getCustoms'
            ]);
        });
    });

    Route::prefix('form')->group(function () {
        Route::prefix('node')->group(function () {
            Route::get('/', 'formController@nodes')->name("form.nodes.view");
            Route::post('/', 'formController@setNodes')->name("form.nodes.store");
            Route::get('all', 'formController@getNodes')->name("form.nodes.all");
        });
        Route::prefix('crop')->group(function () {
            Route::get('/', 'formController@crops')->name("form.crops.view");
            Route::post('/', 'formController@setCrops')->name("form.crops.store");
            Route::get('all', 'formController@getCrops')->name("form.crops.all");
        });
        Route::prefix('stage')->group(function () {
            Route::get('/', 'formController@stages')->name("form.stages.view");
            Route::post('/', 'formController@setStages')->name("form.stages.store");
            Route::get('all', 'formController@getStages')->name("form.stages.all");
        });
        Route::prefix('soil')->group(function () {
            Route::get('/', 'formController@soils')->name("form.soils.view");
            Route::post('/', 'formController@setSoils')->name("form.soils.store");
            Route::get('all', 'formController@getSoils')->name("form.soils.all");
        });
        Route::prefix('region')->group(function () {
            Route::get('/', 'formController@regions')->name("form.regions.view");
            Route::post('/', 'formController@setRegions')->name("form.regions.store");
            Route::get('all', 'formController@getRegions')->name("form.regions.all");
        });
        Route::prefix('area')->group(function () {
            Route::get('/', 'formController@areas')->name("form.areas.view");
            Route::post('/', 'formController@setAreas')->name("form.areas.store");
            Route::get('all', 'formController@getAreas')->name("form.areas.all");
            Route::get('end/{id}', 'formController@endAreas')->name("form.areas.end");
        });

        Route::prefix('coefficient')->group(function () {
            Route::get('/', 'formController@coefficients')->name("form.coefficients.view");
            Route::post('/', 'formController@setCoefficients')->name("form.coefficients.store");
            Route::get('all', 'formController@getCoefficients')->name("form.coefficients.all");
        });
    });
    Route::prefix('table')->group(function () {
        Route::prefix('field')->group(function () {
            Route::get('/', 'tableController@fields')->name("table.fields.view");
            Route::get('all', 'tableController@getFields')->name("table.fields.all");
        });
        Route::prefix('schedule')->group(function () {
            Route::get('/', 'tableController@schedules')->name("table.schedules.view");
            Route::get('all', 'tableController@getSchedules')->name("table.schedules.all");
        });
        Route::prefix('data')->group(function () {
            Route::prefix('light')->group(function () {
                Route::get('/', 'tableController@datatable')->defaults('table', 1)->name("table.data.light.view");
                Route::get('all', 'tableController@getDatatable')->defaults('table', 1)->name("table.data.light.all");
            });
            Route::prefix('wind')->group(function () {
                Route::get('/', 'tableController@datatable')->defaults('table', 2)->name("table.data.wind.view");
                Route::get('all', 'tableController@getDatatable')->defaults('table', 2)->name("table.data.wind.all");
            });
            Route::prefix('ahumidity')->group(function () {
                Route::get('/', 'tableController@datatable')->defaults('table', 3)->name("table.data.ahumidity.view");
                Route::get('all', 'tableController@getDatatable')->defaults('table', 3)->name("table.data.ahumidity.all");
            });
            Route::prefix('shumidity')->group(function () {
                Route::get('/', 'tableController@datatable')->defaults('table', 4)->name("table.data.shumidity.view");
                Route::get('all', 'tableController@getDatatable')->defaults('table', 4)->name("table.data.shumidity.all");
            });
            Route::prefix('stemperature')->group(function () {
                Route::get('/', 'tableController@datatable')->defaults('table', 5)->name("table.data.stemperature.view");
                Route::get('all', 'tableController@getDatatable')->defaults('table', 5)->name("table.data.stemperature.all");
            });
            Route::prefix('atemperature')->group(function () {
                Route::get('/', 'tableController@datatable')->defaults('table', 6)->name("table.data.atemperature.view");
                Route::get('{all', 'tableController@getDatatable')->defaults('table', 6)->name("table.data.atemperature.all");
            });
            Route::prefix('ph')->group(function () {
                Route::get('/', 'tableController@datatable')->defaults('table', 7)->name("table.data.ph.view");
                Route::get('all', 'tableController@getDatatable')->defaults('table', 7)->name("table.data.ph.all");
            });
        });
    });
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::get('manger','UserController@index')->name('user.index');
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

