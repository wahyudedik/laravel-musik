<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View 
    {
        $user = $request->user();
        
        if ($user->hasVerifiedEmail()) {
            // Redirect berdasarkan jenis user
            if (in_array($user->user_type, ['super_admin', 'admin'])) {
                return redirect()->intended(route('landlord.dashboard'));
            } else {
                $tenant = $user->tenantUsers()->first();
                if ($tenant) {
                    return redirect()->intended(route('dashboard', ['tenant' => $tenant->path_id]));
                }
                return redirect('/');
            }
        }
        
        return view('auth.verify-email');
    }
}
