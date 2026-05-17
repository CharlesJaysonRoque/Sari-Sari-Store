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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
            ->onDelete('cascade');

            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')
            ->references('id')
            ->on('payment_methods')
            ->onDelete('cascade');

            $table->unsignedBigInteger('payment_term_id');
            $table->foreign('payment_term_id')
            ->references('id')
            ->on('payment_terms')
            ->onDelete('cascade');

            $table->integer('quantity')->unsigned();
            $table->decimal('selling_price', 8, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
