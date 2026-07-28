<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VoterLoginController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('voter')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::guard('voter')->user();

            if ($user->must_change_password) {
                return redirect()->route('voter.change-password');
            }

            return redirect()->route('voter.vote');
        }

        throw ValidationException::withMessages([
            'email' => ['Las credenciales proporcionadas no son correctas.'],
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('voter')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('voter.login');
    }
}
