<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class TelegramBotApiException extends Exception
{
    public function report()
    {

    }

    public function render(Request $request)
    {
        return response()->json([]);
    }
}
