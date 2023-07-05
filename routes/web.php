<?php

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

/* Importar os controllers */
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');  // Cria um novo dado apenas para usuários autenticados 
Route::get('/events/{id}', [EventController::class, 'show']);  // Mostra um dado do banco
Route::get('/contato', [EventController::class, 'contact']);
Route::get('/dashboard',[EventController::class, 'dashboard'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth'); // Para poder alterar algum projeto

Route::post('/events', [EventController::class, 'store']);  // Envia um dado para o banco 
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');

Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth'); // Passar a nova rota atualizada
