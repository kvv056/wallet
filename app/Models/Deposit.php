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
	
	/**
     * Get the transactions for the deposit.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
	
	public function isNewTransactionAllow()
	{
		return $this->accrue_times < 10;
	}
	
	public function getTransactionsAmount()
	{
		return ($this->invested / 100) * $this->percentPerStep;
	}
	
	public function getCreateTransaction($amount)
	{
		$transaction = new Transaction([
			'user_id' => $this->user_id,
			'wallet_id' => $this->wallet_id,
			'deposit_id' =>$this->id,
			'amount' =>$amount,
			'type' => 'create_deposit',
		]);
		
		return $transaction;
	}
	
	public function createAccrueTransaction()
	{
		try{
            DB::beginTransaction();
			
			$this->addPercent();
			
			if(!$this->isNewTransactionAllow()){		
				$this->close();
				
			}
			
			$this->save();
			
            DB::commit();

        } catch(\Exception $exception){

            DB::rollBack();

            throw $exception;
        }
	}
	
	private function addPercent()
	{
		$this->transactions()->create(
			[
				'user_id' => $this->user_id,
				'wallet_id' => $this->wallet_id,
				'deposit_id' =>$this->id,
				'amount' =>$this->getTransactionsAmount(),
				'type' => 'accrue',
			]
		);
		
		$this->percent += $this->getTransactionsAmount();
		$this->accrue_times ++;
	}
	
	private function close()
	{
		echo 'weew';
			$this->active = 0;
			$this->transactions()->create(
				[
					'user_id' => $this->user_id,
					'wallet_id' => $this->wallet_id,
					'deposit_id' =>$this->id,
					'amount' =>0,
					'type' => 'close_deposit',
				]
			);
	}

}
