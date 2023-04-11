<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('payment_methods_id')->constrained('payment_methods')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('purchased_date')->nullable();
            $table->timestamp('estimated_delivery_date')->nullable();
            $table->string('shipping_address')->nullable();
            $table->float('total');
            $table->boolean('payment_status')->default(false);
            $table->boolean('order_status')->default(false);
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
        Schema::dropIfExists('orders');
    }
};
