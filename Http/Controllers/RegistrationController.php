<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Lumis\StaffManagement\Entities\Staff;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RegistrationController extends Controller
{

    /**
     * Show the specified resource.
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function create(): RedirectResponse
    {
        $this->authorize('create-staff');
        return redirect()->route('staff.create.profile');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function profile(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.profile');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function employment(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.employment');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function supervisor(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.supervisor');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function spouse(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.spouse');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function kinsman(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.kinsman');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function dependants(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.dependants');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function experience(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.experience');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function qualifications(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.qualifications');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function awards(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.awards');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function referees(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.referees');
    }

    /**
     * Show the specified resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function documents(): Renderable
    {
        $this->authorize('create-staff');
        return view('staffmanagement::registration.documents');
    }

    /**
     * @return View|Factory|Application|RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function finish(): View|Factory|Application|RedirectResponse
    {
        if (session()->exists('staff')) {
            $employeeId = session()->get('staff');

            $staff = Staff::find($employeeId);

            session()->forget('staff');

            return view("staffmanagement::registration.finish")->with('staff', $staff);
        } else {
            return redirect()->route('staff.create');
        }

    }

    /**
     * @return RedirectResponse
     */
    public function cancel(): RedirectResponse
    {
        if (session()->exists('staff')) {
            session()->forget('staff');
        }

        return redirect()->route('staff.index')->with('error', 'Operation Cancelled');
    }


}
