<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $otp = rand(100000, 999999);
        $role = Role::firstOrCreate(['name' => 'user']);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'role_id' => $role->id,
        ]);

        Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)->subject('Your OTP');
        });

        session(['otp_user_id' => $user->id]);

        return redirect()->route('otp.verify');
    }

    public function showOtpForm()
    {
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $user = User::find(session('otp_user_id'));

        if ($user && $user->otp == $request->otp) {
            Auth::login($user);
            return redirect()->route('home');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

$user = User::where('email', $request->email)->with('role')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        Auth::login($user);

        if ($user->role && $user->role->name === 'admin') {
            return redirect()->route('admin.dashboard.users');

        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function showForgotForm()
    {
        return view('auth.passwords.email');
    }

    public function sendForgotOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return back()->withErrors(['email' => 'No account found with that email']);
        }

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        Mail::raw("Your password-reset OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)->subject('Password Reset OTP');
        });

        session(['forgot_user_id' => $user->id]);
        return redirect()->route('password.reset.form');
    }
    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(session('forgot_user_id'));
        if (! $user || $user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->save();

        session()->forget('forgot_user_id');

        return redirect()->route('login')->with('status', 'Password updated! Please log in.');
    }
}
