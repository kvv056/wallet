<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Deposit extends Model
{
    use HasFactory;
	
	/**
	 * The column associated with the UPDATED_AT timestamp.
	 *
	 * @var string
	 */
	const UPDATED_AT = null;
	
	private $maxAccrueTimes = 10;
	
	private $percentPerStep = 20;
	
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
	
	public function isAccrueAllow()
	{
		return $this->accrue_times < $this->maxAccrueTimes;
	}
	
	public function getAccrueAmount()
	{
		return ($this->invested / 100) * $this->percentPerStep;
	}
	
	public function accrue()
	{
		$this->percent += $this->getAccrueAmount();
		$this->accrue_times ++;
	}
	
	public function close()
	{
		$this->active = 0;
	}
	/**
     * Get the user for the deposit.
     */	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	/**
     * Get the wallet for the deposit.
     */
	public function wallet()
	{
		return $this->belongsTo(Wallet::class);
	}
	
	/**
     * Get the transactions for the deposit.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
