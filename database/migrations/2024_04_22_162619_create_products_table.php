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
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->integer('cat_id')->nullable();
            $table->integer('sup_id')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('place')->nullable();
            $table->string('route')->nullable();
            $table->text('image')->nullable();
            $table->text('buy_date')->nullable();
            $table->text('expire_date')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('qty')->default(0);
            $table->string('status')->default( 1);
            $table->timestamps();
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
