<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('email_verified')->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('kyc')->nullable();
            $table->string('address')->nullable();
            $table->string('countrys')->nullable();
            $table->string('states')->nullable();
            $table->string('citys')->nullable();
            $table->string('addr_file')->nullable();
            $table->string('btc_wallet_addr')->nullable();
            $table->string('usdt_wallet_addr')->nullable();
            $table->string('eth_wallet_addr')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
