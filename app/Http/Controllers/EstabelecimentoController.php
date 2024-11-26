<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EstabelecimentoController extends Controller
{
    public function index()
    {
        return Estabelecimento::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'cep' => 'required'
        ]);

        $cep = $request->cep;
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response->json()['erro'])) {
            return response()->json(['error' => 'CEP inválido ou não encontrado'], 400);
        }

        $data = $response->json();
        
        // Verificar se todas as chaves necessárias estão presentes
        if (!isset($data['logradouro'], $data['bairro'], $data['localidade'], $data['uf'])) {
            return response()->json(['error' => 'Informações incompletas do CEP'], 400);
        }

        $endereco = "{$data['logradouro']}, {$data['bairro']}, {$data['localidade']} - {$data['uf']}";

        $estabelecimento = Estabelecimento::create(array_merge($request->all(), ['endereco' => $endereco]));
        return $estabelecimento;
    }

    public function show(Estabelecimento $estabelecimento)
    {
        return $estabelecimento;
    }

    public function update(Request $request, Estabelecimento $estabelecimento)
    {
        $request->validate([
            'nome' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'cep' => 'required'
        ]);

        $cep = $request->cep;
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response->json()['erro'])) {
            return response()->json(['error' => 'CEP inválido ou não encontrado'], 400);
        }

        $data = $response->json();
        
    
        if (!isset($data['logradouro'], $data['bairro'], $data['localidade'], $data['uf'])) {
            return response()->json(['error' => 'Informações incompletas do CEP'], 400);
        }

        $endereco = "{$data['logradouro']}, {$data['bairro']}, {$data['localidade']} - {$data['uf']}";

        $estabelecimento->update(array_merge($request->all(), ['endereco' => $endereco]));
        return $estabelecimento;
    }

    public function destroy(Estabelecimento $estabelecimento)
    {
        $estabelecimento->delete();
        return response()->noContent();
    }
}
