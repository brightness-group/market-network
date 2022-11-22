<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('snapshot_id')->nullable();
            $table->string('path');
            $table->string('media_type');
            $table->string('type')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('snapshot_id')->references('id')->on('snapshots')->nullable();
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
        Schema::dropIfExists('media');
    }
}
