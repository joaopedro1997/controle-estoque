<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {

            $table->bigIncrements('id')->autoIncrement()->primary();
            $table->string('descricao', 255 );
            $table->string('observacoes', 255 )->nullable();
            $table->enum('tipo', ['adulto','infantil']);
            $table->double('valor',8,2);
            $table->integer('quantidade')->nullable();
            $table->timestamps();
            //colocar todas as tabelas em vigor dentro do banco de dados -> php artisan migrate
            //caso precisa recriar uma migrate usar comando após apagar os arquivos -> composer dump-autoload

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
