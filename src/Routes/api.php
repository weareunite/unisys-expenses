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
        Route::get('{id}',                          ['as' => 'show',                    'uses' => 'ExpenseController@show']);
        Route::post('/',                            ['as' => 'create',                  'uses' => 'ExpenseController@create']);
        Route::put('{id}',                          ['as' => 'update',                  'uses' => 'ExpenseController@update']);
        Route::delete('{id}',                       ['as' => 'delete',                  'uses' => 'ExpenseController@delete']);

        Route::post('{id}/addTransaction',          ['as' => 'addTransaction',          'uses' => 'ExpenseController@addTransaction']);
        Route::get('{id}/transactions',             ['as' => 'transactions',            'uses' => 'ExpenseController@allTransactions']);

        Route::put('{id}/attachTags',               ['as' => 'attachTags',              'uses' => 'ExpenseController@attachTags']);
        Route::put('massAttachTags',                ['as' => 'massAttachTags',          'uses' => 'ExpenseController@massAttachTags']);
        Route::put('{id}/detachTags',               ['as' => 'detachTags',              'uses' => 'ExpenseController@detachTags']);

        Route::post('{id}/addFile',                 ['as' => 'uploadFile',              'uses' => 'ExpenseController@uploadFile']);
        Route::get('{id}/files',                    ['as' => 'getFiles',                'uses' => 'ExpenseController@getFiles']);
        Route::get('{id}/latestFile',               ['as' => 'getLatestFile',           'uses' => 'ExpenseController@getLatestFile']);

        Route::get('export',                        ['as' => 'export',                  'uses' => 'ExpenseController@export']);
    });
});