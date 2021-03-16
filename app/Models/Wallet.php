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
        'balance',
    ];
	
	/**
     * Get the user for the wallet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	/**
     * Get the deposit for the wallet.
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
	
	public function getCreateTransaction($amount){
		$transaction = new Transaction([
			'user_id' => $this->user_id,
			'wallet_id' => $this->id,
			'deposit_id' =>null,
			'amount' =>$amount,
			'type' => 'enter',
		]);
		
		return $transaction;
	}

}
