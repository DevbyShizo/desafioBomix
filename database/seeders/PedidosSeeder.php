<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;

class PedidosSeeder extends Seeder
{
    public function run()
    {
        Pedido::create(['produto_id' => 1, 'cliente_id' => 1, 'quantidade' => 10, 'valor_total' => 5.00]);
        Pedido::create(['produto_id' => 2, 'cliente_id' => 2, 'quantidade' => 5, 'valor_total' => 20.00]);
        Pedido::create(['produto_id' => 3, 'cliente_id' => 3, 'quantidade' => 2, 'valor_total' => 100.00]);
    }
}
