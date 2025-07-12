<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function user()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Admins only');
        }
        $totalUsers = User::count();
        $otpUsedCount = User::where('otp_used', true)->count();
        $otpTypes = User::whereNotNull('otp_type')
            ->selectRaw('otp_type, COUNT(*) as count')
            ->groupBy('otp_type')
            ->get();

        $recentUsers = User::latest()->take(5)->get();

        return view('admin-dashboard.users', compact(
            'totalUsers',
            'otpUsedCount',
            'otpTypes',
            'recentUsers'
        ));
    }

    public function manageRoles()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Admins only');
        }

        $users = User::all();
        $roles = ['admin', 'user'];

        return view('admin-dashboard.roles', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.dashboard.roles')->with('success', 'User role updated.');
    }
}
