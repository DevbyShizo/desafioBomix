<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EstabelecimentoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rota para obter informações do usuário autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rota de categorias
Route::resource('categorias', CategoriaController::class);

// Rota de estabelecimentos
Route::apiResource('estabelecimentos', EstabelecimentoController::class);

// Rota de produtos
Route::resource('produtos', ProdutoController::class);

// Rota de pedidos (corrigido o nome da rota)
Route::resource('pedidos', PedidoController::class);
