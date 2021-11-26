<?php

namespace App\Http\Middleware;

use App\Model\User;
use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization') == null) {
            return response()->json([
                'message' => 'Token tidak ditemukan'
            ], 403);
        }

        $token = $request->header('Authorization');
        $user = User::where('token', $token)->first();
        if (!$user) return response()->json([
            'message' => 'Token tidak valid'
        ], 403);

        // $request->attributes->add(['user' => $user]);
        $request['user'] = $user;
        return $next($request);
    }
}
