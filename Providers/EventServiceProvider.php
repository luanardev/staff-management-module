<?php

namespace Lumis\StaffManagement\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Lumis\StaffManagement\Entities\Document;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\Progress;
use Lumis\StaffManagement\Entities\Qualification;
use Lumis\StaffManagement\Entities\Spouse;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Events\AccountCreated;
use Lumis\StaffManagement\Events\Confirmation;
use Lumis\StaffManagement\Events\Dismissal;
use Lumis\StaffManagement\Events\EmploymentCreated;
use Lumis\StaffManagement\Events\ProfileUpdated;
use Lumis\StaffManagement\Events\Promotion;
use Lumis\StaffManagement\Events\Retirement;
use Lumis\StaffManagement\Events\Termination;
use Lumis\StaffManagement\Listeners\CreateUserAccount;
use Lumis\StaffManagement\Listeners\SendConfirmationNotification;
use Lumis\StaffManagement\Listeners\SendDismissalNotification;
use Lumis\StaffManagement\Listeners\SendEmploymentNotification;
use Lumis\StaffManagement\Listeners\SendProfileNotification;
use Lumis\StaffManagement\Listeners\SendPromotionNotification;
use Lumis\StaffManagement\Listeners\SendRetirementNotification;
use Lumis\StaffManagement\Listeners\SendTerminationNotification;
use Lumis\StaffManagement\Listeners\SendUserAccountNotification;
use Lumis\StaffManagement\Observers\DocumentObserver;
use Lumis\StaffManagement\Observers\EmploymentObserver;
use Lumis\StaffManagement\Observers\ProgressObserver;
use Lumis\StaffManagement\Observers\QualificationObserver;
use Lumis\StaffManagement\Observers\SpouseObserver;
use Lumis\StaffManagement\Observers\StaffObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        ProfileUpdated::class => [
            SendProfileNotification::class,
        ],

        EmploymentCreated::class => [
            SendEmploymentNotification::class,
            CreateUserAccount::class,
        ],

        AccountCreated::class => [
            SendUserAccountNotification::class
        ],

        Promotion::class => [
            SendPromotionNotification::class
        ],

        Termination::class => [
            SendTerminationNotification::class
        ],

        Retirement::class => [
            SendRetirementNotification::class
        ],

        Dismissal::class => [
            SendDismissalNotification::class
        ],

        Confirmation::class => [
            SendConfirmationNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Staff::observe(
            StaffObserver::class
        );

        Employment::observe(
            EmploymentObserver::class
        );

        Spouse::observe(
            SpouseObserver::class
        );

        Progress::observe(
            ProgressObserver::class
        );

        Document::observe(
            DocumentObserver::class
        );

        Qualification::observe(
            QualificationObserver::class
        );


    }


}
