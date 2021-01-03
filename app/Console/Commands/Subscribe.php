<?php

namespace App\Console\Commands;

use App\Models\Provider;
use Illuminate\Console\Command;

class Subscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'decrease subscribe 1 on vendor table every day';

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
        Provider::where('email_verified_at','<>',null)->where('subscribe','>',0)->decrement('subscribe',1);
    }
}
