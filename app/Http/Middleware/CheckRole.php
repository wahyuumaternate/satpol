<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Redirect ke login jika belum terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silahkan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Periksa apakah user memiliki salah satu role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect dengan pesan error jika tidak memiliki akses
        return redirect()->route('home')
            ->with('error', 'Anda tidak memiliki akses untuk fitur ini.');
    }
}
