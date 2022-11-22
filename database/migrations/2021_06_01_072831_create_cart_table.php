<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('items_count')->default(0);
            $table->integer('items_qty')->default(0);
            $table->decimal('sub_total', 12,2)->nullable();
            $table->decimal('grand_total', 12,2)->nullable();
            $table->decimal('tax_total', 12,2)->nullable();
            $table->decimal('discount_amount', 12,2)->nullable();
            $table->string('coupon_code')->nullable();
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('cart');
    }
}
