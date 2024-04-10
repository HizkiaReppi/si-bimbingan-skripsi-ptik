<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        if(Auth::user()->role == 'admin'){
            return redirect()->intended(route('dashboard', absolute: false));
        } else if(Auth::user()->role == 'lecturer'){
            return redirect()->intended(route('dashboard.atur-jadwal-bimbingan.index', absolute: false));
        } else if(Auth::user()->role == 'student'){
            return redirect()->intended(route('dashboard.bimbingan.index', absolute: false));
        } else if(Auth::user()->role == 'HoD'){
            return redirect()->intended(route('dashboard.bimbingan.index', absolute: false));
        } else {
            return redirect()->intended(route('dashboard', absolute: false));
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

        return redirect('/login');
    }
}
