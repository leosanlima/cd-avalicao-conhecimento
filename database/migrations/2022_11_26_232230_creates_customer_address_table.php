<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cep', 8);
            $table->string('neighborhood', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('address_number', 255);
            $table->string('complement', 255)->nullable();
            $table->foreignId('customer_id');
            $table->string('street', 255);
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('customer_id');
            $table->drop();
        });
    }
}

