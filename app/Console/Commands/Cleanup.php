<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\{Order, SeatShow};

class Cleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup all expired orders and reserves';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info("Cleaning up orders");
        Order::cleanup();
        $this->info("Cleaning up reserves");
        SeatShow::cleanup();
    }
}
