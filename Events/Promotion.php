<?php

namespace Lumis\StaffManagement\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Progress;

class Promotion
{
    use Dispatchable, SerializesModels;

    /**
     *
     * @var Progress
     */
    public Progress $progress;

    /**
     * Create a new event instance.
     * @param Progress $progress
     * @return void
     */
    public function __construct(Progress $progress)
    {
        $this->progress = $progress;
    }

}
