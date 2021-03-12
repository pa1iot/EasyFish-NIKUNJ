<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_books', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('bill_firstname')->nullable();
            $table->string('bill_lastname')->nullable();
            $table->string('bill_companyname')->nullable();
            $table->string('bill_email')->nullable();
            $table->string('bill_phone')->nullable();
            $table->string('bill_address')->nullable();
            $table->string('bill_city')->nullable();
            $table->string('bill_state')->nullable();
            $table->string('bill_postcode')->nullable();
            $table->string('bill_country')->nullable();

            $table->string('enable_shipping')->nullable();

            $table->string('ship_firstname')->nullable();
            $table->string('ship_lastname')->nullable();
            $table->string('ship_companyname')->nullable();
            $table->string('ship_email')->nullable();
            $table->string('ship_phone')->nullable();
            $table->string('ship_address')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_postcode')->nullable();
            $table->string('ship_country')->nullable();

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
        Schema::dropIfExists('address_books');
    }
}
