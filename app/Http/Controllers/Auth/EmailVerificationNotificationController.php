<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse 
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

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
