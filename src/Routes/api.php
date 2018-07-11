<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => '\Unite\Expenses\Http\Controllers',
    'middleware' => ['api', 'auth:api', 'authorize'],
    'as' => 'api.'
], function ()
{
    Route::group(['as' => 'expense.', 'prefix' => 'expense'], function ()
    {
        Route::get('/',                             ['as' => 'list',                    'uses' => 'ExpenseController@list']);
        Route::get('{model}',                       ['as' => 'show',                    'uses' => 'ExpenseController@show']);
        Route::put('{model}',                       ['as' => 'update',                  'uses' => 'ExpenseController@update']);
        Route::delete('{model}',                    ['as' => 'delete',                  'uses' => 'ExpenseController@delete']);

        Route::put('{model}/attachTags',            ['as' => 'attachTags',              'uses' => 'ExpenseController@attachTags']);
        Route::put('massAttachTags',                ['as' => 'massAttachTags',          'uses' => 'ExpenseController@massAttachTags']);
        Route::put('{model}/detachTags',            ['as' => 'detachTags',              'uses' => 'ExpenseController@detachTags']);

    });
});