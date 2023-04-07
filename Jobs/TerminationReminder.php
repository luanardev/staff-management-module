<?php

namespace Lumis\StaffManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Notifications\TerminationReminder as Reminder;


class TerminationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $employments = Employment::getTerminating();

        // send reminder to HRM department


        // send reminders to employees
        foreach ($employments as $employment) {
            $this->notify($employment->staff);
        }
    }

    /**
     * Handle notification login
     *
     * @param Staff $staff
     * @return void
     */
    protected function notify(Staff $staff): void
    {
        $reminderDate = Carbon::createFromDate($staff->employment->end_date)->subMonth(); // month before termination
        $reminder = new Reminder($staff);
        $reminder->delay($reminderDate);
        $staff->notify($reminder);
    }
}
