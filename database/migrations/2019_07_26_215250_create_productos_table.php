<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100)->nullable();
            $table->string('imagen',100)->nullable();
            $table->string('formadeuso',300)->nullable();
            $table->string('categoria',300)->nullable();
            $table->string('senasa',100)->nullable();
            $table->string('pdf',100)->nullable();
            $table->unsignedBigInteger('clase_id');
            $table->foreign('clase_id')
              ->references('id')->on('clases')
              ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
