<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        event(new Registered($user));

        // Buat tenant
        $domain = str_replace([' ', '_', '.'], '-', strtolower($request->name));
        $pathId = strtolower(str_replace([' ', '.'], '-', $request->name));
    
        $tenant = Tenant::create([
            'name' => $request->name,
            'domain' => config('app.url'),
            'path_id' => $pathId,
            'database' => $request->user_type . '_' . $domain,
        ]);

        $tenant->vendorUsers()->attach($user);

        Auth::login($user);

        if (in_array($user->user_type, ['super_admin', 'admin'])) {
            return redirect()->route('landlord.dashboard');
        } else {
            // Pastikan parameter tenant disediakan
            return redirect()->route('dashboard', ['tenant' => $pathId]);
        }
    }}
