<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('catalog');
            $table->string('name');
            $table->string('reference')->primary();
            $table->text('description');
            $table->string('picture');
            $table->integer('stock');
            $table->float('price');
            $table->timestamps();
            $table->foreign('catalog')->references('catalog')->on('catalogs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};