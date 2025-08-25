<?php

namespace App\Http\Requests\Auth;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use League\Config\Exception\ValidationException as ExceptionValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return
            [
                'login.required' => 'Kolom username atau email wajib diisi',
                'password.required' => 'Password wajib diisi',
                'role.required' => 'Silahkan pilih role',
                'role.in' => 'Role tidak valid',
                'division.required_if' => 'Silhkan pilih bidang jika role author',
                'division.in' => 'Divisi tidak valid',
                'g-recaptcha-response.required' => 'Silahkan centang Captcha',
                'g-recaptcha-response.captcha' => 'Verifikasi captcha gagal, silahkan coba lagi',
            ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['required', 'in:admin,author'],
            'division' => ['nullable', 'required_if:role,author', 'in:bph,organisasi,kader,hikmah,rpk,olahraga,medkom,tkk'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $login_type = filter_var($this->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // if (! Auth::attempt([$login_type => $this->input('login'), 'password' => $this->input('password')], $this->boolean('remember'))) {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'login' => trans('auth.failed'),
        //     ]);
        // }

        $user = User::where($login_type, $this->input('login'))->where('role', $this->input('role'))->when($this->input('role') === 'author', function ($query) {
            $divisi = Divisi::where('slug', $this->input('division'))->first();
            if ($divisi) {
                return $query->where('division', $divisi->id);
            } else {
                $query->whereNull('division');
            }
        })->first();


        if (!$user) {
            throw ValidationException::withMessages([
                'login' => 'Username/email tidak ditemukan atau role salah',
            ]);
        }



        if (!$user || !Hash::check($this->input('password'), $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => 'Password yang anda masukkan salah',
            ]);
        }

        Auth::login($user);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        // return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());

        return Str::lower($this->input('login')) . '|' . $this->ip();
    }
}
