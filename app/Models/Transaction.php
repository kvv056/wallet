<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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
        'depoit_id',
		
		'amount',
		'type',
		'created_at',
    ];
	/*
	$table->increments('id');
			
	$table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
	$table->unsignedInteger('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
	$table->unsignedInteger('depoit_id')->references('id')->on('deposits')->onDelete('cascade');
	
	$table->double('amount', 10, 0);
	$table->string('type', 30);
	
	$table->timestamp('created_at');
	 * 
	 */
}
