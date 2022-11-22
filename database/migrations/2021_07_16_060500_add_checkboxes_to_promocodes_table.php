<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckboxesToPromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            $table->boolean('is_expiry_date_checked')->default(0)->after('expiry_date');
            $table->boolean('is_usage_limit_checked')->default(0)->after('usage_limit');
            $table->date('status_changed_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            $table->dropColumn('is_expiry_date_checked');
            $table->dropColumn('is_usage_limit_checked');            
            $table->dropColumn('status_changed_at');            
        });
    }
}
