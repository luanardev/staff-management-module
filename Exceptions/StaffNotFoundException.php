<?php

namespace Lumis\StaffManagement\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class StaffNotFoundException extends HttpException
{

    public function __construct()
    {
        $message = 'Staff Record Not Found.';
        parent::__construct(403, $message, null, []);
    }
}
