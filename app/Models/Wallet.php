<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
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
//        'user_id',
		
        'balance',
//        'created_at',
    ];
	
	/**
     * Get the wallets for the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	/*
	$table->increments('id');
	
	$table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
	
	$table->double('balance', 10, 0);
    $table->timestamp('created_at');
	 * 
	 */
	
}
