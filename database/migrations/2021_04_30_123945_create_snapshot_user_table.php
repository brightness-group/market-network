<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapshotUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapshot_user', function (Blueprint $table) {
            $table->unsignedBigInteger('snapshot_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('snapshot_id')->references('id')->on('snapshots');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('snapshot_user', function (Blueprint $table) {
            Schema::dropIfExists('snapshot_user');
        });
    }
}
