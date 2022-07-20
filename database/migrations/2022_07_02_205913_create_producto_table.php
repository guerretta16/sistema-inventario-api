<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cat', 50);
            $table->string('descripcion_cat');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCategoria');
            $table->string('nombre_prod', 50);
            $table->string('descripcion_prod');
            $table->double('precio', 8, 2);
            $table->integer('stock');
            $table->integer('disponible')->default(1);
            $table->string('image');
            $table->timestamps();

            $table->foreign('idCategoria')->references('id')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
};
