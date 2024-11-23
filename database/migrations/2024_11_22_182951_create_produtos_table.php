<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
{
    Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->decimal('valor', 10, 2)->nullable(false); 
        $table->unsignedBigInteger('estabelecimento_id');
        $table->timestamps();
        
        $table->foreign('estabelecimento_id')->references('id')->on('estabelecimentos')->onDelete('cascade');
    });
}

    

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
