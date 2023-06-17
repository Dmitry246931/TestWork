<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyCustomException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render( $request): \Illuminate\Http\JsonResponse
    {
        //
        return response()->json([
            'error' => $this->getMessage()
        ]);
    }
}
