<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'valor' => 'required|numeric',
            'estabelecimento_id' => 'required'
        ]);
        return Produto::create($request->all());
    }

    public function show(Produto $produto)
    {
        return $produto;
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required',
            'valor' => 'required|numeric',
            'estabelecimento_id' => 'required'
        ]);
        $produto->update($request->all());
        return $produto;
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->noContent();
    }
}
