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
        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        // }

        // if ($request->user()->markEmailAsVerified()) {
        //     event(new Verified($request->user()));
        // }

        // return redirect()->intended(route('dashboard', absolute: false).'?verified=1');

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended($this->redirectPath($user));
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended($this->redirectPath($user));
    }


    protected function redirectPath($user): string
    {
        if ($user->role === 'admin') {
            return route('admin.dashboard', ['verified' => 1]);
        } elseif ($user->role === 'author') {
            return route('author.dashboard', ['verified' => 1]);
        }

        return '/';
    }
}
