<?php

namespace Lumis\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Lumis\StaffManagement\Reports\StaffFilter;
use Lumis\StaffManagement\Reports\StaffReport;

class ReportController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function create(): Factory|View|Application
    {
        $this->authorize('read-staff-report');

        $filter = new StaffFilter;

        return $filter->render('staffmanagement::report.create');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function result(Request $request): View|Factory|Application
    {
        $this->authorize('read-staff-report');

        $report = new StaffReport;
        $report->setFilterBy($request->get('filterby'));
        $report->setGroupBy($request->get('groupby'));
        $report->setSortBy($request->get('sortby'));
        return $report->render('staffmanagement::report.show');
    }

}
