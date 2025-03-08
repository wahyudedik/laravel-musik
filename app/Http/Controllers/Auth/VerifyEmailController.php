<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->hasVerifiedEmail()) {
            // Check if user is landlord or tenant
            if (in_array($user->user_type, ['super_admin', 'admin'])) {
                return redirect()->route('landlord.dashboard')->with('verified', true);
            } else {
                // Get tenant associated with user
                $tenant = $user->tenantUsers()->first();
                
                if ($tenant) {
                    return redirect()->route('dashboard', ['tenant' => $tenant->path_id])->with('verified', true);
                } else {
                    // Fallback if no tenant found
                    return redirect('/');
                }
            }
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Redirect based on user type after verifying
        if (in_array($user->user_type, ['super_admin', 'admin'])) {
            return redirect()->route('landlord.dashboard')->with('verified', true);
        } else {
            // Get tenant associated with user
            $tenant = $user->tenantUsers()->first();
            
            if ($tenant) {
                return redirect()->route('dashboard', ['tenant' => $tenant->path_id])->with('verified', true);
            } else {
                // Fallback if no tenant found
                return redirect('/');
            }
        }
    }
}
