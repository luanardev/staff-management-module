<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Lumis\StaffManagement\Entities\Staff;
use Barryvdh\DomPDF\Facade\Pdf;

class StaffController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.index');
    }

    /**
     * Show the form for creating a new resource.
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
     * @param Staff $staff
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function show(Staff $staff): RedirectResponse
    {
        $this->authorize('read-staff');

        return redirect()->route('staff.show.profile', $staff);
    }

    /**
     * Delete the specified resource.
     * @param Staff $staff
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Staff $staff): RedirectResponse
    {
        $this->authorize('delete-staff');

        $staff->delete();

        if (session()->exists('staff')) {
            session()->forget('staff');
        }
        return redirect()->route('staff.index')->with('success', 'Staff Record Deleted');
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Response
     * @throws AuthorizationException
     */
    public function export(Staff $staff): Response
    {
        $this->authorize('read-staff');

        $name = Str::kebab($staff->name());

        $pdf = Pdf::loadView('staffmanagement::profile.pdf', [
            'staff' => $staff
        ]);

        return $pdf->stream($name . '.pdf');
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function profile(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.profile')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function employment(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.employment')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function supervisor(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.supervisor')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function spouse(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.spouse')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function kinsman(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.kinsman')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function dependants(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.dependants')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function experience(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.experience')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function qualifications(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.qualifications')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function awards(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.awards')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function referees(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.referees')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function documents(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.documents')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function progress(Staff $staff): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::profile.progress')->with([
            'staff' => $staff
        ]);
    }


}
