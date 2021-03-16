<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AmountPostRequest;
use DB;

class WalletController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBalance()
    {
        $user = Auth::user();
        return view('wallet', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editBalance()
    {
		$user = Auth::user();
        return view('editBalance', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBalance(AmountPostRequest $request)
    {
//		$user = Auth::user();
		$amount = $request->validated()['amount'];
		$wallet = Auth::user()->wallet;
		$wallet->balance += $amount;
		try{

            DB::beginTransaction();
			//enter
            $wallet->save();
			$transaction = $wallet->getCreateTransaction($amount);
			$transaction->save();
			
            DB::commit();

        } catch(\Exception $exception){

            DB::rollBack();

            throw $exception;
        }

		return redirect()->route('showBalance');

    }

}
