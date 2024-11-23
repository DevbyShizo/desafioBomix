<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    use HasFactory;

    // Adicione os atributos que podem ser atribuídos em massa
    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id',
        'cep',
        'endereco'
    ];
}
