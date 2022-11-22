<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('promo_discount_amount', 12,2)->nullable()->after('tax_total');
            $table->decimal('promo_discount_percentage', 5,2)->nullable()->after('tax_total');
            $table->renameColumn('discount_amount', 'total_discount_amount');
            $table->string('coupon_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::dropColumn('promo_discount_amount');
            Schema::dropColumn('promo_discount_percentage');
            $table->renameColumn('total_discount_amount', 'discount_amount');
        });
    }
}
