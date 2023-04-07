<?php

namespace Lumis\StaffManagement\Console;

use Illuminate\Console\Command;
use Lumis\StaffManagement\Jobs\ProbationReminder;

class RemindProbation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'probation:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send staff probation reminder.';

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
        ProbationReminder::dispatch();
    }


}
