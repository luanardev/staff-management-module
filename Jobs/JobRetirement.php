<?php

namespace Lumis\StaffManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Employment;

class JobRetirement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $employments = Employment::getRetiringToday();

        foreach ($employments as $employment) {
            $employment->retireFromWork();
        }
    }
}
