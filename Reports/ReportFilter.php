<?php

namespace Lumis\StaffManagement\Reports;

abstract class ReportFilter
{
    public function render($view, $data = [])
    {
        $filters = $this->filters();
        $groups = $this->groups();
        return view($view)->with(['filters' => $filters, 'groups' => $groups])->with($data);
    }

    abstract public function filters(): array;

    abstract public function groups(): array;

}
