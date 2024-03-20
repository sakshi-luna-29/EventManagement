<?php

use App\Http\Controllers\eventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [eventController::class, 'index'])->name('event.index');

Route::post('/events', [eventController::class, 'event'])->name('event.save');

Route::post('/ticket', [eventController::class, 'ticket'])->name('ticket.save');

Route::delete('/ticket', [eventController::class, 'ticketDel'])->name('ticket.delete');

Route::delete('/editTicket', [eventController::class, 'editTicket'])->name('ticket.edit');
