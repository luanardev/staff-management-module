<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Lumis\StaffManagement\Entities\Staff;

class ContractController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::contract.index');
    }

    /**
     * Search a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function search(): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::contract.search');
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


        if ($staff->isNotPermanent() && $staff->isNotTerminated()) {
            return redirect()
                ->route('contract.index')
                ->with('error', 'Cannot Renew Active Contract');
        }

        return view('staffmanagement::contract.create')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function retirement(): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::contract.retirement');
    }
}
