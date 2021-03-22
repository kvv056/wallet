<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TopUpPostRequest;
use App\Domain\WalletService;


class WalletController extends Controller
{
	private $walletService;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WalletService $walletService)
    {
		$this->walletService = $walletService;
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
     * @param  \Illuminate\Http\TopUpPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateBalance(TopUpPostRequest $request)
    {
		$amount = $request->validated()['amount'];
		$wallet = Auth::user()->wallet;
		
		try{
			$this->walletService->updateBalance($wallet, $amount);
		} catch (Exception $ex) {
			\Session::flash('flash_error', 'updating balance error');
		}
		return redirect()->route('showBalance');
    }

}
