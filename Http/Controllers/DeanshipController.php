<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Lumis\StaffManagement\Entities\Staff;

class DeanshipController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('read-appointment');

        return view('staffmanagement::appointment.deanship.index');
    }

    /**
     * Search a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function search(): Renderable
    {
        $this->authorize('create-appointment');

        return view('staffmanagement::appointment.deanship.search');
    }

    /**
     * Show the form for creating a new resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function create(Staff $staff): Renderable
    {
        $this->authorize('create-appointment');

        return view('staffmanagement::appointment.deanship.create')->with([
            'staff' => $staff
        ]);
    }

}
