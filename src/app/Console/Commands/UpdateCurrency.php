<?php

namespace App\Console\Commands;

use App\Services\LoadCurrencyService;
use Illuminate\Console\Command;

class UpdateCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency data';

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
     * @param LoadCurrencyService $loadCurrencyService
     * @return int
     */
    public function handle(LoadCurrencyService $loadCurrencyService)
    {
        ($loadCurrencyService->execute()) ? $this->info('The command was successful!') : $this->info('The command was failed!');
    }
}
