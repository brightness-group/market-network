<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) { 
            $table->foreignId('city_id')->references('id')->on('cities')->nullable()->after('social_type');
            $table->foreignId('profession_id')->references('id')->on('professions')->nullable()->after('collaborate');
            $table->string('behance')->nullable()->after('social_type');
            $table->string('youtube')->nullable()->after('social_type');
            $table->string('instagram')->nullable()->after('social_type');
            $table->string('twitter')->nullable()->after('social_type');
            $table->string('facebook')->nullable()->after('social_type');
            $table->uuid('uuid')->nullable()->after('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['profession_id']);
            $table->dropColumn('profession_id');            
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('instagram');
            $table->dropColumn('youtube');
            $table->dropColumn('behance');
            $table->dropColumn('uuid');
        });
    }
}
