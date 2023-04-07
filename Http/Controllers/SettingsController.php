<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function index(): RedirectResponse
    {
        $this->authorize('execute-staff-settings');

        return redirect()->route('staffmanagement.settings.general');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function general(): Renderable
    {
        $this->authorize('execute-staff-settings');

        return view('staffmanagement::settings.general');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function document(): Renderable
    {
        $this->authorize('execute-staff-settings');

        return view('staffmanagement::settings.document');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function qualification(): Renderable
    {
        $this->authorize('execute-staff-settings');

        return view('staffmanagement::settings.qualification');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function position(): Renderable
    {
        $this->authorize('execute-staff-settings');

        return view('staffmanagement::settings.position');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function rank(): Renderable
    {
        $this->authorize('execute-staff-settings');

        return view('staffmanagement::settings.rank');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function grade(): Renderable
    {
        $this->authorize('execute-staff-settings');

        return view('staffmanagement::settings.grade');
    }

}
