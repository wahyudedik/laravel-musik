<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionTenantController extends Controller
{
    public function landlordDashboard(Request $request)
    {
        try {
            switch ($request->user()->user_type) {
                case 'admin':
                    return view('admin.dashboard', ['message' => 'Admin Dashboard - Login berhasil!']);
                case 'super_admin':
                    return view('super_admin.dashboard', ['message' => 'Super Admin Dashboard - Login berhasil!']);
                default:
                    return redirect()->route('dashboard');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        try {
            switch ($request->user()->user_type) {
                case 'composer':
                    return view('composer.dashboard', ['message' => 'Composer Dashboard - Login berhasil!']);
                case 'cover_creator':
                    return view('cover_creator.dashboard', ['message' => 'Cover Creator Dashboard - Login berhasil!']);
                case 'official_artist':
                    return view('official_artist.dashboard', ['message' => 'Official Artist Dashboard - Login berhasil!']);
                default:
                    return view('errors.404');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
