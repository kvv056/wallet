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
        'deposit_id',
		
		'amount',
		'type',
		'created_at',
    ];
	
	/**
     * Get the deposit for the transactions.
     */
    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }
}
