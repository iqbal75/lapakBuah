<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_product');
            $table->foreignId('category_id');
            $table->string('satuan');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('qty');
            $table->integer('berat');
            $table->integer('diskon')->nullable();
            $table->text('description');
            $table->string('slug');
            $table->integer('user_id');
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
        Schema::dropIfExists('products');
    }
}
