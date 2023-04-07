<?php

namespace Lumis\StaffManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Employment;

class ContractTermination implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $contracts = Employment::getTerminatingToday();

        foreach ($contracts as $contract) {
            $contract->terminateContract();
        }
    }
}
