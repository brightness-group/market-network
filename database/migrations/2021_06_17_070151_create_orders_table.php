<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('increment_id')->nullable();  
            $table->foreignId('user_id')->references('id')->on('users');
            $table->bigInteger('cart_id');
            $table->string('status');  
            $table->string('customer_full_name');  
            $table->string('customer_company_name')->nullable();
            $table->integer('total_item_count')->default(0);
            $table->integer('items_qty')->default(0);
            $table->decimal('sub_total', 12,2)->nullable();
            $table->decimal('grand_total', 12,2)->nullable();
            $table->decimal('tax_total', 12,2)->nullable();
            $table->decimal('discount_amount', 12,2)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
