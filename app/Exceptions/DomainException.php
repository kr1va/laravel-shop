<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class DomainException extends Exception
{

    public function render(Request $request)
    {
//        return
    }
}
