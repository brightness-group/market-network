<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEmailNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_email_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('network_activity')->default(0);
            $table->boolean('invites_to_collaborate')->default(0);
            $table->boolean('sends_direct_message')->default(0);
            $table->boolean('publishes_snapshot')->default(0);
            $table->boolean('comments_on_snapshot')->default(0);
            $table->boolean('mentions_in_snapshot_comment')->default(0);
            $table->boolean('loves_snapshot')->default(0);
            $table->boolean('starts_following_account')->default(0);
            $table->boolean('newsletter')->default(0);
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_email_notifications');
    }
}
