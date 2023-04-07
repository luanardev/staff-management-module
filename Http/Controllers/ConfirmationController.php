<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Lumis\StaffManagement\Entities\Staff;

class ConfirmationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::confirmation.index');
    }

    /**
     * Show the form for creating a new resource.
     * @param Staff $staff
     * @return Renderable|RedirectResponse
     * @throws AuthorizationException
     */
    public function create(Staff $staff): Renderable|RedirectResponse
    {
        $this->authorize('update-employment');

        if ($staff->isNotPermanent()) {
            return redirect()->route('confirmation.index')
                ->with('error', 'Cannot Confirm NonPermanent Staff');
        }

        if ($staff->isConfirmed()) {
            return redirect()
                ->route('confirmation.index')
                ->with('error', 'Staff confirmed already');
        }

        return view('staffmanagement::confirmation.create')->with(['staff' => $staff]);
    }

}
