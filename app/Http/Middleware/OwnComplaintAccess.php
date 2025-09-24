<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pengaduan;

class OwnComplaintAccess
{
    /**
     * Handle an incoming request.
     * Middleware untuk memastikan masyarakat hanya dapat mengakses pengaduan mereka sendiri
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Super admin dan babinsa diizinkan melewati middleware ini
        if ($user->isSuperAdmin() || $user->isBabinsa()) {
            return $next($request);
        }

        // Jika user adalah masyarakat, periksa apakah pengaduan milik mereka
        if ($user->isMasyarakat()) {
            $pengaduanId = $request->route('id');
            if ($pengaduanId) {
                $pengaduan = Pengaduan::find($pengaduanId);

                if (!$pengaduan || $pengaduan->user_id !== $user->id) {
                    return redirect()->route('pengaduan.index')
                        ->with('error', 'Anda hanya dapat mengakses pengaduan yang Anda buat sendiri.');
                }
            }
        }

        return $next($request);
    }
}
