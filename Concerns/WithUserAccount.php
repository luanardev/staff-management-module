<?php

namespace Lumis\StaffManagement\Concerns;

use App\Models\User;
use Illuminate\Support\Str;
use Lumis\StaffManagement\Events\AccountCreated;

trait WithUserAccount
{

    /**
     * @return void
     */
    public function createAccount(): void
    {
        if ($this->accountExists()) {
            $user = $this->getUser();
            if ($user instanceof User) {
                $user->setStaff($this->id); ;
                $user->setCampus($this->campus->id);
                $user->save();
            }
        } else {
            $password = Str::upper(Str::random(8));
            $user = new User();
            $user->name = $this->name();
            $user->email = $this->emailAddress();
            $user->setStaff($this->id); ;
            $user->setCampus($this->campus->id);
            $user->setPassword($password);
            $user->save();
            AccountCreated::dispatch($this, $password);
        }

    }

    /**
     * @return bool
     */
    protected function accountExists(): bool
    {
        $email = $this->emailAddress();
        $user = User::getByEmail($email);
        return isset($user);
    }

    /**
     * @return mixed
     */
    protected function getUser(): mixed
    {
        $email = $this->emailAddress();
        return User::getByEmail($email);
    }

    /**
     * @return void
     */
    public function disableAccount(): void
    {
        $user = User::getByStaff($this->id);
        if (!empty($user)) {
            $user->deactivate();
        }

    }

    /**
     * @return void
     */
    public function enableAccount(): void
    {
        $user = User::getByStaff($this->id);
        if (!empty($user)) {
            $user->activate();
        }
    }
}
