<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
			
			$table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->unsignedInteger('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
			
			$table->double('invested', 10, 0);
			$table->double('percent', 10, 0);
			$table->smallInteger('active');
			$table->smallInteger('duration');
			$table->smallInteger('accrue_times');
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
        Schema::dropIfExists('deposits');
    }
}
