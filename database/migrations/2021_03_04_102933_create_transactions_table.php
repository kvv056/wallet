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
            $table->increments('id');
			
			$table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->unsignedInteger('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
			$table->unsignedInteger('deposit_id')->references('id')->on('deposits')->nullable()->onDelete('cascade');
			
			$table->double('amount', 10, 0);
			$table->string('type', 30);
			
			$table->timestamp('created_at');
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
