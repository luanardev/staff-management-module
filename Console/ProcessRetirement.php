<?php

namespace Lumis\StaffManagement\Console;

use Illuminate\Console\Command;
use Lumis\StaffManagement\Jobs\JobRetirement;

class ProcessRetirement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:retire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retire Staff whose retirement period is due.';

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
        JobRetirement::dispatch();
    }


}
