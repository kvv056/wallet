<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\DepositService;
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
	
	private $depositService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DepositService $depositService)
    {
		$this->depositService = $depositService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$this->depositService->accrueDeposits();

        return 0;
    }
	
}
