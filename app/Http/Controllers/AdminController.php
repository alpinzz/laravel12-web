<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Adminlogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AdminLogin(Request $request)
    {
        $cred = $request->only('email', 'password');

        if (Auth::attempt($cred)) {
            $user = Auth::user();

            $verifCode = random_int(100000, 999999);

            session([
                'verification_code' => $verifCode,
                "user_id" => $user->id
            ]);

            Mail::to($user->email)->send(new VerificationCodeMail($verifCode));

            Auth::logout();

            return redirect()->route('custom.verification.form')->with('status', 'Kode verifikasi telah dikirim ke email Anda');
        }
        return redirect()->back()->withErrors(['email' => 'email atau password salah']);
    }

    public function showVerify()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        if ($request->code == session('verification_code')) {
            Auth::loginUsingId(session('user_id'));

            session()->forget(['verification_code', 'user_id']);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['code' => 'Invalid Verification Code']);
    }

    public function AdminProfile()
    {

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $title = DashboardController::title();

        return view('admin.profile', compact('profileData', 'title'));
    }


    public function ProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;

        $oldImagePath = $data->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $filename);
            $data->image = $filename;

            if ($oldImagePath && $oldImagePath !== $filename) {
                $this->deleteOldImage($oldImagePath);
            }
        }

        $data->save();

        $notif = array(
            'message' => 'Profile berhasil diupdate',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notif);
    }

    private function deleteOldImage(string $oldImagePath): void
    {
        $fullPath = public_path('upload/user_images/' . $oldImagePath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function PasswordUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            $notif = array(
                'message' => 'Old password does not Match',
                'alert-type' => 'error'
            );
            return back()->with($notif);
        }
        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notif = array(
            'message' => 'Password berhasil diganti',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notif);
    }
}
