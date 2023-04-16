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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_index');
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->float('total');
            $table->timestamps();
            // $table->foreign('order_index')->references('index_id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};