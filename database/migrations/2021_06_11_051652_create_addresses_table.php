<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('full_name')->nullable();  
            $table->string('company_name')->nullable();  
            $table->string('address')->nullable();  
            $table->string('address_number')->nullable();  
            $table->foreignId('country_id')->references('id')->on('countries')->nullable();  
            $table->foreignId('state_id')->references('id')->on('states')->nullable();  
            $table->string('phone')->nullable();  
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
        Schema::dropIfExists('addresses');
    }
}
