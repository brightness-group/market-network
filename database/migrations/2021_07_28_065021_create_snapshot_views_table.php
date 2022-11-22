<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapshotViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapshot_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('snapshot_id')->references('id')->on('snapshots');
            $table->string("slug")->nullable();
            $table->string("url")->nullable();
            $table->string("session_id")->nullable();
            $table->string("user_id");
            $table->string("ip")->nullable();
            $table->string("agent")->nullable();
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
        Schema::dropIfExists('snapshot_views');
    }
}
