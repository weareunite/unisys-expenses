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
        Route::post('/',                            ['as' => 'create',                  'uses' => 'ExpenseController@create']);
        Route::put('{model}',                       ['as' => 'update',                  'uses' => 'ExpenseController@update']);
        Route::delete('{model}',                    ['as' => 'delete',                  'uses' => 'ExpenseController@delete']);

        Route::post('{id}/addTransaction',          ['as' => 'addTransaction',          'uses' => 'ExpenseController@addTransaction']);
        Route::get('{id}/transactions',             ['as' => 'transactions',            'uses' => 'ExpenseController@allTransactions']);

        Route::put('{id}/attachTags',               ['as' => 'attachTags',              'uses' => 'ExpenseController@attachTags']);
        Route::put('massAttachTags',                ['as' => 'massAttachTags',          'uses' => 'ExpenseController@massAttachTags']);
        Route::put('{id}/detachTags',               ['as' => 'detachTags',              'uses' => 'ExpenseController@detachTags']);
    });
});