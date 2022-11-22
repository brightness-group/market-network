<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_from_id')->references('id')->on('users');
            $table->foreignId('review_to_id')->references('id')->on('users');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->boolean('recommend')->default(0);
            $table->tinyInteger('quality')->nullable();
            $table->tinyInteger('communication')->nullable();
            $table->tinyInteger('availability')->nullable();            
            $table->text("review")->nullable();
            $table->boolean('is_deleted')->default(0);            
            $table->string("status")->default('submitted');
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
        Schema::dropIfExists('reviews');
    }
}
