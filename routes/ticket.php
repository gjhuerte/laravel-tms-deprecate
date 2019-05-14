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
            Route::get('ticket/{id}/resolve', [
                'as' => 'ticket.resolve.form',
                'uses' => 'ResolveTicketController@create',
            ]);

            Route::post('ticket/{id}/resolve', [
                'as' => 'ticket.resolve',
                'uses' => 'ResolveTicketController@store',
            ]);
    
            Route::get('ticket/{id}/close', [
                'as' => 'ticket.close.form',
                'uses' => 'CloseTicketController@create',
            ]);

            Route::post('ticket/{id}/close', [
                'as' => 'ticket.close',
                'uses' => 'CloseTicketController@store',
            ]);
    
            Route::get('ticket/{id}/reopen', [
                'as' => 'ticket.reopen.form',
                'uses' => 'ReopenTicketController@create',
            ]);

            Route::post('ticket/{id}/reopen', [
                'as' => 'ticket.reopen',
                'uses' => 'ReopenTicketController@store',
            ]);
    
            Route::get('ticket/{id}/transfer', [
                'as' => 'ticket.transfer.form',
                'uses' => 'TransferTicketController@create',
            ]);

            Route::post('ticket/{id}/transfer', [
                'as' => 'ticket.transfer',
                'uses' => 'TransferTicketController@store',
            ]);
        });

        Route::resource('ticket', 'TicketController');
    });
});
