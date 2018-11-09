<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


$router->get('ping', [
    'as' => 'api.ping', 'uses' => 'api\PingController@ping'
]);

$router->get('item', [
    'as' => 'api.item.itemList', 'uses' => 'api\ItemController@itemList'
]);

$router->post('invoice', [
    'as' => 'api.invoice.calculateInvoice', 'uses' => 'api\InvoiceController@calculateInvoice'
]);
