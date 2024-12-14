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
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->text('city');  // Shipping address
            $table->string('street_address');
            $table->string('state');
            $table->string('zip');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User who placed the order
            $table->string('order_number')->unique();  // Unique order identifier
            $table->decimal('sub_total');
            $table->decimal('tax');
            $table->decimal('discount');
            $table->decimal('total');  // Total price of the order
            $table->enum('status', ['ordered', 'delivered', 'cancelled'])->default('ordered');
            $table->date('delivery_date')->nullable();
            $table->date('cancelled_date')->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('payment_gateway_reference')->nullable();  // Reference to payment gateway transaction ID
            $table->timestamps();
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
