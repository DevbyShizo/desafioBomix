<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return Pedido::with('produto', 'cliente')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required',
            'cliente_id' => 'required',
            'quantidade' => 'required|integer',
        ]);

        $produto = Produto::find($request->produto_id);
        $valor_total = $produto->valor * $request->quantidade;

        $pedido = Pedido::create(array_merge($request->all(), ['valor_total' => $valor_total]));
        return $pedido;
    }

    public function show(Pedido $pedido)
    {
        return $pedido->load('produto', 'cliente');
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'quantidade' => 'required|integer',
        ]);

        $produto = Produto::find($pedido->produto_id);
        $valor_total = $produto->valor * $request->quantidade;

        $pedido->update(array_merge($request->all(), ['valor_total' => $valor_total]));
        return $pedido;
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return response()->noContent();
    }
}
