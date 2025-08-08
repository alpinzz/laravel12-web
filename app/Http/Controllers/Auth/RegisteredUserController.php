<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,author'],
            'division_id' => [
                'nullable',
                Rule::requiredIf($request->role === 'author'),
                'exists:divisis,slug'
            ],
        ]);

        if ($request->role === 'admin' && $request->filled('division')) {
            return back()->withErrors(['division' => 'Admin tidak bisa memiliki bidang.'])->withInput();
        }

        $division_id = null;
        if ($request->role === 'author' && $request->filled('division_id')) {
            $divisi = Divisi::where('slug', $request->division_id)->first();
            if (!$divisi) {
                return back()->withErrors(['division_id' => 'Bidang Tidak Ditemukan.'])->withInput();
            }
            $division_id = $divisi->id;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'division' => $division_id,
        ]);

        // dd($user);
        event(new Registered($user));

        Auth::login($user);


        return redirect()->route('verification.notice');
    }
}
