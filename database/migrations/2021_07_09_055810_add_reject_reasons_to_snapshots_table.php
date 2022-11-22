<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectReasonsToSnapshotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `snapshots` CHANGE `status` `status` ENUM('draft','active','inactive', 'rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft';");

        Schema::table('snapshots', function (Blueprint $table) { 
            $table->text('reject_reason_other_text')->nullable()->after('draft');
            $table->boolean('reject_reason_other')->default(0)->after('draft');
            $table->boolean('reject_reason_upsell')->default(0)->after('draft');
            $table->boolean('reject_reason_packages')->default(0)->after('draft');
            $table->boolean('reject_reason_description')->default(0)->after('draft');
            $table->boolean('reject_reason_image')->default(0)->after('draft');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('snapshots', function (Blueprint $table) {
            $table->dropColumn('reject_reason_other_text');
            $table->dropColumn('reject_reason_other');
            $table->dropColumn('reject_reason_upsell');
            $table->dropColumn('reject_reason_packages');
            $table->dropColumn('reject_reason_description');
            $table->dropColumn('reject_reason_image');
        });
    }
}
