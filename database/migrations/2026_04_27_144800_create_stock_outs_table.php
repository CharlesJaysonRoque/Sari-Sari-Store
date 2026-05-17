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
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->unsignedBigInteger('reason_id')->nullable();
            $table->foreign('reason_id')
            ->references('id')
            ->on('reasons')
            ->onDelete('cascade');

            $table->integer('quantity');

            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->foreign('transaction_id')
            ->references('id')
            ->on('transactions')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
