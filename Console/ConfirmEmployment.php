<?php

namespace Lumis\StaffManagement\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\StaffManagement\Facades\StaffConfig;

class ConfirmEmployment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employment:confirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Confirm Employment';

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
        $employments = $this->getProbation();
        $probationPeriod = (int)StaffConfig::get('probation_period') ?? 12;
        $count = 0;
        foreach($employments as $employment){
            $confirmDate = $this->getConfirmedDate($employment->start_date, $probationPeriod);
            $employment->confirmTenure('System Confirmation', $confirmDate);
            $count++;
        }
        $this->info('Employment Confirmation Successful');
        $this->info($count.' Staff Members were confirmed');
    }

    public function getProbation()
    {
        $type = JobType::Permanent();
        $status = JobStatus::Serving();

        return Employment::where('job_type_id', $type)
            ->where('job_status_id', $status)
            ->where('confirmation_status', 'Unconfirmed')
            ->get();
    }

    public function getConfirmedDate($jobStartDate, $probationPeriod=12): Carbon
    {
        return Carbon::createFromDate($jobStartDate)->addMonths($probationPeriod);
    }


}
