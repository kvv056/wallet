<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AmountPostRequest;
use DB;

class DepositController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$deposits = Auth::user()->wallet->deposits()->get();
        return view('deposits',['deposits'=>$deposits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDeposit()
    {
		$user = Auth::user();
        return view('createDeposit', ['user'=>$user]);
    }

    /**
     * Save a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveDeposit(AmountPostRequest $request)
    {
        $amount = $request->validated()['amount'];
		$wallet = Auth::user()->wallet;
		$wallet->balance -= $amount;
 
		try{

            DB::beginTransaction();
			$deposit = $wallet->deposits()->create([
				'user_id' => Auth::user()->id,

				'invested' => $amount,
				'percent' => 0,
				'active' => 1,
				'accrue_times' => 0,
				'duration' => 10,
			]);
			//create_deposit
            $wallet->save();
			$deposit->getCreateTransaction($amount)->save();
			

            DB::commit();

        } catch(\Exception $exception){

            DB::rollBack();

            throw $exception;
        }

		return redirect()->route('showBalance');;
    }

}
