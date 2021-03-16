<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Deposit;
//use App\Models\Transaction;
//use DB;

class AddDepositPercent extends Command
{
    /**
     * The name and signature of the console command.
     * php artisan deposit:AddPercent
     * @var string
     */
    protected $signature = 'deposit:AddPercent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$deposits = Deposit::where('active', 1)->get();
		
		foreach ($deposits as $deposit){
			$deposit->createAccrueTransaction();
		}

        return 0;
    }
	
}
