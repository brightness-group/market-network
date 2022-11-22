<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnapshotPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snapshot_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('snapshot_id');
            $table->enum('type', ['bronze', 'silver', 'gold'])->nullable();
            $table->integer('price')->nullable();
            $table->string('per_price')->nullable();
            $table->string('offer')->nullable();
            $table->text('description')->nullable();
            $table->text('includes')->nullable();
            $table->integer('quantity')->nullable();
            $table->foreign('snapshot_id')->references('id')->on('snapshots');
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
        Schema::dropIfExists('snapshot_packages');
    }
}
