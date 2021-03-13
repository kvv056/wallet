<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
	
	/**
	 * The column associated with the UPDATED_AT timestamp.
	 *
	 * @var string
	 */
	const UPDATED_AT = null;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'wallet_id',
		
        'invested',
		'percent',
		'active',
		'duration',
		'accrue_times',
		'created_at',
    ];
	
	/*
	$table->increments('id');
			
	$table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
	$table->unsignedInteger('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
	
	$table->double('invested', 10, 0);
	$table->double('percent', 10, 0);
	$table->smallInteger('active');
	$table->smallInteger('duration');
	$table->smallInteger('accrue_times');
    $table->timestamp('created_at');
	 * 
	 */
}
