<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ErrorHandler extends BaseController
{
    public static function handlerExecption($exception): void
    {        
        echo json_encode([
            "code"    => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file"    => $exception->getFile(),
            "line"    => $exception->getLine()
        ]);        
    }
}
