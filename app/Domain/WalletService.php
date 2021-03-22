<?php

namespace App\Domain;

use App\Models;
use App\Repo\TransactionRepo as TransactionRepo;
use DB;

/**
 * Description of WalletService
 *
 * @author kvv
 */
class WalletService
{
	private $transactionRepo;
	
	/**
	 * 
	 * @param TransactionRepo $transactionRepo
	 */
	public function __construct(TransactionRepo $transactionRepo)
	{
		$this->transactionRepo = $transactionRepo;
	}
	
	/**
	 * Update balance for specific wallet
	 * @param Models\Wallet $wallet
	 * @param type $amount
	 * @throws \Exception
	 */
	public function updateBalance(Models\Wallet $wallet, $amount)
	{
		try{
            DB::beginTransaction();
			$wallet->balance += $amount;
            $wallet->save();
			$transaction = $this->transactionRepo->getEnterTransaction($wallet, $amount);
			$transaction->save();
			
            DB::commit();

        } catch(\Exception $exception){

            DB::rollBack();

            throw $exception;
        }
	}
}
