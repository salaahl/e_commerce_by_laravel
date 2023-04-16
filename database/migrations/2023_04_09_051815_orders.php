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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('index_id');
            $table->string('user_email');
            $table->string('product_reference');
            $table->integer('quantity');
            $table->timestamps();
            // $table->foreign('index_id')->references('id')->on('orders_index');
            // $table->foreign('user_id')->references('user_id')->on('baskets');
            // $table->foreign('product_id')->references('product_id')->on('baskets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};