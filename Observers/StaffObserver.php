<?php

namespace Lumis\StaffManagement\Observers;

use App\Models\User;
use Exception;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Events\ProfileCreated;
use Lumis\StaffManagement\Events\ProfileUpdated;
use StaffConfig;
use Storage;

class StaffObserver
{

    /**
     * Handle the Staff "creating" event.
     *
     * @param Staff $staff
     * @return void
     * @throws Exception
     */
    public function creating(Staff $staff): void
    {
        $createEmail = (bool)StaffConfig::get('create_staff_email');
        if (empty($staff->official_email) && $createEmail) {
            $staff->makeEmail();
        }

    }

    /**
     * Handle the Staff "created" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function created(Staff $staff): void
    {
        $staff->activate();
        ProfileCreated::dispatch($staff);
    }

    /**
     * Handle the Staff "updated" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function updated(Staff $staff): void
    {
        if ($staff->wasChanged('avatar')) {
            $this->removeAvatar($staff);
        }
        if ($staff->wasChanged('signature')) {
            $this->removeSignature($staff);
        }

        ProfileUpdated::dispatch($staff);

    }

    /**
     * Remove old avatar file
     *
     * @param Staff $staff
     * @return void
     */
    protected function removeAvatar(Staff $staff): void
    {
        try {
            $avatar = $staff->getOriginal('avatar');
            if (!empty($avatar) && file_exists(storage_path('app/public/' . $avatar))) {
                unlink(storage_path('app/public/' . $avatar));
            }

        } catch (Exception $ex) {
        }
    }

    /**
     * Remove old signature file
     *
     * @param Staff $staff
     * @return void
     */
    protected function removeSignature(Staff $staff): void
    {
        try {
            $signature = $staff->getOriginal('signature');
            if (!empty($signature) && file_exists(storage_path('app/public/' . $signature))) {
                unlink(storage_path('app/public/' . $signature));
            }
        } catch (Exception $ex) {
        }

    }

    /**
     * Handle the Staff "deleted" event.
     *
     * @param Staff $staff
     * @return void
     */
    public function deleted(Staff $staff): void
    {
        try {
            $avatar = $staff->avatar;
            $signature = $staff->signature;

            if (!empty($avatar) && file_exists(storage_path('app/public/' . $avatar))) {
                unlink(storage_path('app/public/' . $avatar));
            }
            if (!empty($signature) && file_exists(storage_path('app/public/' . $signature))) {
                unlink(storage_path('app/public/' . $signature));
            }

            $user = User::getByStaffId($staff->id);
            if (!empty($user)) {
                $user->delete();
            }

        } catch (Exception $ex) {
        }

    }

}
