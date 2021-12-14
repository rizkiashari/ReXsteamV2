<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_transaction');
            $table->foreignId('user_id');
            $table->string('card_name');
            $table->string('card_number', 100);
            $table->string('expired_month', 100);
            $table->string('expired_year', 100);
            $table->integer('cvc_cvv');
            $table->string('card_country', 100);
            $table->integer('postal_code');
            $table->integer('total');
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
        Schema::dropIfExists('transactions');
    }
}
