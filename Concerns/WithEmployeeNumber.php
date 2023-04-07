<?php

namespace Lumis\StaffManagement\Concerns;

use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use StaffConfig;

trait WithEmployeeNumber
{

    /**
     * @param int $length
     * @return void
     */
    public function makeIdNumber(int $length = 6): void
    {
        try {
            $config = [
                'table' => $this->table,
                'field' => 'employee_number',
                'length' => $length,
                'prefix' => date('y')
            ];
            $ID = IdGenerator::generate($config);
            $this->setAttribute('employee_number', $ID);
        } catch (Exception $exception) {
            $this->setAttribute('employee_number', null);
        }


    }

    /**
     * @param mixed $number
     * @return static|null
     */
    public static function getByNumber(mixed $number): null|static
    {
        return static::where('employee_number', $number)->first();
    }
}
