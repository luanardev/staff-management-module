<?php

namespace Lumis\StaffManagement\Concerns;

use ErrorException;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

trait WithExcelDate
{
    /**
     * @param $value
     * @param string $format
     * @return Carbon
     */
    public function transformDate($value, string $format = 'Y-m-d'): Carbon
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value));
        } catch (ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }
}
