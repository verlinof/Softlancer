<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if ($e instanceof ValidationException) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 422);
            } elseif ($e instanceof AuthorizationException) {
                return response()->json([
                    'error' => "Unauthorized"
                ], 401);
            } elseif ($e instanceof RouteNotFoundException) {
                return response()->json([
                    'error' => "Unauthorized"
                ], 401);
            } else {
                return response()->json([
                    'error' => "Internal Server Error"
                ], 500);
            }
        });
    }
}
