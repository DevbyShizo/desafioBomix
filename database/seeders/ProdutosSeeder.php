<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutosSeeder extends Seeder
{
    public function run()
    {
        Produto::create(['nome' => 'Pão Francês', 'valor' => 0.50, 'estabelecimento_id' => 1]);
        Produto::create(['nome' => 'Leite Integral', 'valor' => 4.00, 'estabelecimento_id' => 2]);
        Produto::create(['nome' => 'Fone de Ouvido', 'valor' => 50.00, 'estabelecimento_id' => 3]);
    }
}
