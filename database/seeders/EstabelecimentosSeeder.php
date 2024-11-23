<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estabelecimento;

class EstabelecimentosSeeder extends Seeder
{
    public function run()
    {
        Estabelecimento::create(['nome' => 'Padaria Doce Pão', 'descricao' => 'Pães e doces', 'categoria_id' => 1, 'cep' => '41211-151', 'endereco' => '1ª Avenida Wanderson Campelo']);
        Estabelecimento::create(['nome' => 'Mercado do Antônio', 'descricao' => 'Supermercado completo', 'categoria_id' => 2, 'cep' => '41347-115', 'endereco' => 'Travessa Cabral']);
        Estabelecimento::create(['nome' => 'TechShop', 'descricao' => 'Eletrônicos e acessórios', 'categoria_id' => 3, 'cep' => '41336-590', 'endereco' => 'Rua Arca de Noé']);
    }
}
