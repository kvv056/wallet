<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repo;

use App\Models;
use App\Models\Transaction;
/**
 * Description of TransactionRepo
 *
 * @author kvv
 */
class TransactionRepo
{
	public function getEnterTransaction(Models\Wallet $wallet, int $amount){
		$transaction = new Transaction([
			'user_id' => $wallet->user_id,
			'wallet_id' => $wallet->id,
			'deposit_id' =>null,
			'amount' =>$amount,
			'type' => 'enter',
		]);
		
		return $transaction;
	}
	
	public function getAccrueTransaction(Models\Deposit $deposit)
	{
		$transaction = new Transaction(
			[
				'user_id' => $deposit->user_id,
				'wallet_id' => $deposit->wallet_id,
				'deposit_id' =>$deposit->id,
				'amount' =>$deposit->getAccrueAmount(),
				'type' => 'accrue',
			]
		);
		
		return $transaction;
	}
	
	public function getCloseDepositTransaction(Models\Deposit $deposit)
	{
		$transaction = new Transaction(
			[
				'user_id' => $deposit->user_id,
				'wallet_id' => $deposit->wallet_id,
				'deposit_id' =>$deposit->id,
				'amount' =>0,
				'type' => 'close_deposit',
			]
		);
		
		return $transaction;
	}
	
	public function getCreateTransactionForDeposit(Models\Deposit $deposit, int $amount)
	{
		$transaction = new Models\Transaction([
			'user_id' => $deposit->user_id,
			'wallet_id' => $deposit->wallet_id,
			'deposit_id' =>$deposit->id,
			'amount' =>$amount,
			'type' => 'create_deposit',
		]);
		
		return $transaction;
	}
}
