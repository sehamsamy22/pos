<?php

namespace App\Console\Commands;

use App\Models\ClientSubscriptions;
use Carbon\Carbon;
use Illuminate\Console\Command;

class activeSubstriptionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activeSubstription:cron';

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

        $subcriptions=ClientSubscriptions::whereDate('end','<=',Carbon::today())->get();
        foreach ($subcriptions as $subcription){
          $subcription->update([
              'active'=>0,
          ]);
        }
        return 0;
    }
}
