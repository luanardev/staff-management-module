<?php

namespace Lumis\StaffManagement\Console;

use Illuminate\Console\Command;
use Lumis\StaffManagement\Jobs\AppointmentDismissal;

class DismissAppointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointment:dismiss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dismiss appointments which are due.';

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
        AppointmentDismissal::dispatch();
    }


}
