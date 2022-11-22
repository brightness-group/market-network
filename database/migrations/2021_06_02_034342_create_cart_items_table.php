<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->references('id')->on('cart');
            $table->foreignId('snapshot_package_id')->references('id')->on('snapshot_packages');
            $table->foreignId('snapshot_id')->references('id')->on('snapshots');
            $table->foreignId('snapshot_package_user_id')->references('id')->on('users');
            $table->integer('quantity');
            $table->decimal('price', 12,2)->nullable();
            $table->decimal('extras', 12,2)->nullable();
            $table->decimal('total', 12,2)->nullable();
            $table->decimal('tax_percent', 5,2)->nullable();
            $table->decimal('tax_amount', 12,2)->nullable();
            $table->string('coupon_code')->nullable();  
            $table->date('delivery_date')->nullable();  
            $table->string('delivery_from_time')->nullable();  
            $table->string('delivery_to_time')->nullable();  
            $table->boolean('arrange_delivery_later')->default(0);
            $table->boolean('is_upsell')->default(0);
            $table->decimal('upsell_price', 12,2)->nullable();
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
        Schema::dropIfExists('cart_items');
    }
}
