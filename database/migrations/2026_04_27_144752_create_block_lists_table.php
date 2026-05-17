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
        Schema::create('block_lists', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
            ->onDelete('cascade');

            $table->unsignedBigInteger('violation_id');
            $table->foreign('violation_id')
            ->references('id')
            ->on('violations')
            ->onDelete('cascade');

            $table->unique(['customer_id', 'violation_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_lists');
    }
};
