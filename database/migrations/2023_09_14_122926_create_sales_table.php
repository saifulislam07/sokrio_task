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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('total_quantity');
            $table->decimal('total_sale_price', 10, 2);
            $table->decimal('total_payable', 10, 2);
            $table->decimal('grand_total', 10, 2);
            $table->decimal('pay', 10, 2);
            $table->decimal('due', 10, 2);
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
