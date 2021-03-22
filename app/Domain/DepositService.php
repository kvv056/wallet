<?php

namespace App\Domain;

use App\Models;
use App\Repo\TransactionRepo;
use DB;

/**
 * Description of DepositOperations
 *
 * @author kvv
 */
class DepositService
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
	 * Deposit creation logic
	 * @param Models\Wallet $wallet
	 * @param int $amount
	 * @throws \Exception
	 */
	public function makeDepositFromWallet(Models\Wallet $wallet, int $amount)
	{
		try{
            DB::beginTransaction();
			$wallet->balance -= $amount;
			$deposit = $wallet->deposits()->create([
				'user_id' => $wallet->user->id,
				'invested' => $amount,
				'percent' => 0,
				'active' => 1,
				'accrue_times' => 0,
				'duration' => 10,
			]);

            $wallet->save();
			$this->transactionRepo->getCreateTransactionForDeposit($deposit, $amount)->save();
			
            DB::commit();

        } catch(\Exception $exception){

            DB::rollBack();

            throw $exception;
        }
	}
	
	/**
	 * Add percent to deposits
	 */
	public function accrueDeposits()
	{
		$deposits = Models\Deposit::where('active', 1)->get();
		
		foreach ($deposits as $deposit){
			$this->accrueDeposit($deposit);
		}
	}
	
	/**
	 * Add percent to specific deposit
	 * @param type $deposit
	 * @throws \Exception
	 */
	public function accrueDeposit($deposit)
	{
		try{
            DB::beginTransaction();
			
			$deposit->accrue();
			$transaction = $this->transactionRepo->getAccrueTransaction($deposit);
			$transaction->save();
			if(!$deposit->isAccrueAllow()){		
				$deposit->close();
				$closeTransaction = $this->transactionRepo->getCloseDepositTransaction($deposit);
				$closeTransaction->save();
			}
			
			$deposit->save();
			
            DB::commit();

        } catch(\Exception $exception){

            DB::rollBack();

            throw $exception;
        }
	}

}

