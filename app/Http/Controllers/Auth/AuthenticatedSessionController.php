<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login form.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming login request (admin only).
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Only allow the admin email to log in
        $adminEmail = 'admin@gmail.com'; // your admin email

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->email !== $adminEmail) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }

        // Login user using 'web' guard
        Auth::guard('web')->login($user);

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        return redirect()->route('admin.posts.index'); // redirect to admin dashboard
    }

    /**
     * Destroy an authenticated session (logout).
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
