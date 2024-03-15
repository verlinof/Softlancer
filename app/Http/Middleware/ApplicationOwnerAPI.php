<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationOwnerAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $id_user = auth()->user()->id;
            $application = Application::findOrFail($request->id);
            if ($application->user_id != $id_user) {
                return response()->json([
                    'message' => 'Unauthorized',
                ], 401);
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
    }
}
