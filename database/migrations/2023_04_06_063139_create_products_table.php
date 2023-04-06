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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('producer_id')->constrained('producers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image');
            $table->foreignId('color_id')->constrained('colors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('size_id')->constrained('sizes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('price');
            $table->integer('stock');
            $table->boolean('product_status')->default(false);
            $table->timestamp('import_date')->nullable();
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
};
