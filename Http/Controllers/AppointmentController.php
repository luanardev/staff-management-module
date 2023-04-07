<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function index(): RedirectResponse
    {
        $this->authorize('read-appointment');

        return redirect()->route('general.index');
    }


}
