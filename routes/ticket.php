<?php

/*
|--------------------------------------------------------------------------
| Ticket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register ticket routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function() {
    Route::namespace('ticket')->group(function() {
        Route::prefix('ticket')->group(function () {
            Route::get('ticket/{id}/resolve', 'ResolveTicketController@create');
            Route::post('ticket/{id}/resolve', 'ResolveTicketController@resolve');
    
            Route::get('ticket/{id}/close', 'CloseTicketController@create');
            Route::post('ticket/{id}/close', 'CloseTicketController@close');
    
            Route::get('ticket/{id}/reopen', 'ReopenTicketController@create');
            Route::post('ticket/{id}/reopen', 'ReopenTicketController@reopen');
    
            Route::get('ticket/{id}/transfer', 'TransferTicketController@create');
            Route::post('ticket/{id}/transfer', 'TransferTicketController@transfer');
        });

        Route::resource('ticket', 'TicketController');
    });
});
