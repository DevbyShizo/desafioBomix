<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CategoriasSeeder::class,
            EstabelecimentosSeeder::class,
            ProdutosSeeder::class,
            PedidosSeeder::class,
        ]);
    }
}
