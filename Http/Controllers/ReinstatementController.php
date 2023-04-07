<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Lumis\StaffManagement\Entities\Staff;

class ReinstatementController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::reinstatement.index');
    }

    /**
     * Show the form for creating a new resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function create(Staff $staff): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::reinstatement.create')->with(['staff' => $staff]);
    }

}
