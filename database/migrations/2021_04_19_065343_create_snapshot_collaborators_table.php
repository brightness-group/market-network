<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapshotCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapshot_collaborator', function (Blueprint $table) {
            $table->unsignedBigInteger('snapshot_id');
            $table->unsignedBigInteger('collaborate_id');
            $table->foreign('snapshot_id')->references('id')->on('snapshots');
            $table->foreign('collaborate_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snapshot_collaborator');
    }
}
