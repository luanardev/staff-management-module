<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Lumis\StaffManagement\Entities\Staff;

class AttritionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::attrition.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function search(): Renderable
    {
        $this->authorize('update-employment');

        return view('staffmanagement::attrition.search');
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

        if (!$staff->employment->isServing() && !$staff->employment->isProbation()) {
            return redirect()->route('attrition.index')
                ->with('error', 'Cannot Process Staff Attrition');
        }

        return view('staffmanagement::attrition.create')->with(['staff' => $staff]);
    }

}
