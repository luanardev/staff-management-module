<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Lumis\StaffManagement\Entities\Staff;
use Barryvdh\DomPDF\Facade\Pdf;

class IdentityController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function index(): Renderable
    {
        $this->authorize('create-staff-card');

        return view('staffmanagement::staffidentity.index');
    }

    /**
     * Show the form for creating a new resource.
     * @param Staff $staff
     * @return Renderable
     * @throws AuthorizationException
     */
    public function show(Staff $staff): Renderable
    {
        $this->authorize('read-staff-card');

        return view('staffmanagement::staffidentity.show')->with([
            'staff' => $staff
        ]);
    }

    /**
     * Show the specified resource.
     * @param Staff $staff
     * @return Response
     * @throws AuthorizationException
     */
    public function card(Staff $staff): Response
    {
        $this->authorize('read-staff-card');

        $name = Str::kebab($staff->name());

        $pdf = Pdf::loadView('staffmanagement::staffidentity.card', [
            'staff' => $staff
        ]);

        $paper = array(0, 0, 324, 204);
        $pdf->setPaper($paper);

        return $pdf->stream($name . '-id-card.pdf');
    }

}
