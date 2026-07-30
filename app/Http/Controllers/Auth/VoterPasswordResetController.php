<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VoterResetPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class VoterPasswordResetController extends Controller
{
    public function forgotPassword(): Response
    {
        return Inertia::render('voter/ForgotPassword');
    }

    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::query()
            ->where('email', $request->email)
            ->where('role', 'voter')
            ->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => [__('No encontramos un votante con ese correo electrónico.')],
            ]);
        }

        $token = Password::broker('voters')->createToken($user);

        Mail::to($user)->queue(new VoterResetPasswordMail($user, $token));

        return back()->with('status', __('Te hemos enviado un enlace para restablecer tu contraseña.'));
    }

    public function resetForm(string $token): Response
    {
        return Inertia::render('voter/ResetPassword', [
            'token' => $token,
        ]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $status = Password::broker('voters')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            },
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('voter.login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}
