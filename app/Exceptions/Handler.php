<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{

    public function render($request, Throwable $exception)
    {
        // Log unexpected errors
        Log::error($exception);

        if ($exception instanceof ModelNotFoundException) {
            return back()->with([
                'status' => 'error',
                'message' => 'Resource not found',
            ]);
        }

        if ($exception instanceof ValidationException && $request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $exception->errors(),
            ], 422);
        }

        return parent::render($request, $exception);
    }

}
