<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use PDF;

class SearchController extends Controller
{


    /**
     * Search a listing of the resource.
     * @return Renderable
     * @throws AuthorizationException
     */
    public function search(): Renderable
    {
        $this->authorize('read-staff');

        return view('staffmanagement::staffsearch.search');
    }


}
