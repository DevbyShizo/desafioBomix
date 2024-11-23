<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        Categoria::create(['nome' => 'Alimentação']);
        Categoria::create(['nome' => 'Bebidas']);
        Categoria::create(['nome' => 'Eletrônicos']);
    }
}
