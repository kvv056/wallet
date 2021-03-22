<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateDepositPostRequest;
use App\Domain\DepositService as DepositService;

class DepositController extends Controller
{
	
	protected $depositService;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DepositService $depositService)
    {
		$this->depositService = $depositService;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$wallet = Auth::user()->wallet;
		if(!is_null($wallet)){
			$deposits = $wallet->deposits()->get();
			return view('deposits',['deposits'=>$deposits]);
		}
        return view('deposits',['deposits'=>[]]);
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
    public function saveDeposit(CreateDepositPostRequest $request)
    {
        $amount = $request->validated()['amount'];
		$wallet = Auth::user()->wallet;
		try{
			$this->depositService->makeDepositFromWallet($wallet, $amount);
		} catch (Exception $ex) {
			\Session::flash('flash_error', 'deposit creating error');
		}
		

		return redirect()->route('showBalance');
    }

}
