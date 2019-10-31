<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCompose extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_produit');
            $table->foreign('id_produit')
            ->references('id')
            ->on('produits');
            $table->unsignedBigInteger('id_plat');
            $table->foreign('id_plat')
            ->references('id')
            ->on('plats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('composes');
    }
}
