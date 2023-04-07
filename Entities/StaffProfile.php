<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class StaffProfile
{
    protected Authenticatable $user;

    public function  __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function staff():mixed
    {
        return Staff::find($this->user->staff_id);
    }

    /**
     * @return bool
     */
    public function exists():bool
    {
        $staff = $this->staff();
        return !empty($staff);
    }

    /**
     * @return bool
     */
    public function missing():bool
    {
        return !$this->exists();
    }

    /**
     * @return mixed
     */
    public static function get():mixed
    {
        $user = Auth::user();
        $object = new self($user);
        return $object->staff();
    }

    /**
     * @return static
     */
    public static function instance():static
    {
        $user = Auth::user();
        return new self($user);
    }
}
