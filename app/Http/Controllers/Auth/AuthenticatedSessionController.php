<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect berdasarkan jenis user
        if (in_array($user->user_type, ['super_admin', 'admin'])) {
            // Pengguna landlord (super_admin atau admin)
            return redirect()->intended(route('landlord.dashboard', absolute: false));
        } else {
            // Pengguna tenant (composer, cover_creator, official_artist)
            // Temukan tenant yang terkait dengan user ini
            $tenant = $user->tenantUsers->first();

            if ($tenant) {
                // Gunakan path_id tenant untuk parameter di URL
                return redirect()->intended(route('dashboard', ['tenant' => $tenant->path_id]));
            }

            // Fallback jika tenant tidak ditemukan
            return redirect()->intended(route('dashboard', absolute: false))->with('error', 'Tenant tidak ditemukan untuk akun ini.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
