<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function user()
    {
         if (!Auth::check() || !Auth::user()->role || Auth::user()->role->name !== 'admin') {
            abort(403, 'Admins only');
        }
        $totalUsers = User::count();
        $otpUsedCount = User::where('otp_used', true)->count();
        $otpTypes = User::whereNotNull('otp_type')
            ->selectRaw('otp_type, COUNT(*) as count')
            ->groupBy('otp_type')
            ->get();

        $recentUsers = User::latest()->take(5)->get();
        $users = User::all();

        return view('admin-dashboard.users', compact(
            'totalUsers',
            'otpUsedCount',
            'otpTypes',
            'recentUsers',
            'users'
        ));
    }


    public function createUserForm()
{
    $roles = Role::all();
    return view('admin-dashboard.create-user', compact('roles'));
}
public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role_id' => 'required|exists:roles,id',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->role_id = $request->role_id;
    $user->save();

    return redirect()->route('admin.dashboard.users')->with('success', 'User created successfully.');
}
public function editUser(User $user)
{
    $roles = Role::all();
    return view('admin-dashboard.edit-user', compact('user', 'roles'));
}
public function updateUser(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role_id' => 'required|exists:roles,id',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role_id = $request->role_id;

    if ($request->filled('password')) {
        $request->validate([
            'password' => 'min:6|confirmed',
        ]);
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.dashboard.users')->with('success', 'User updated successfully.');
}
public function deleteUser(User $user)
{
    $user->delete();
    return redirect()->route('admin.dashboard.users')->with('success', 'User deleted successfully.');
}

public function manageRoles()
    {
        if (!Auth::check() || !Auth::user()->role || Auth::user()->role->name !== 'admin') {
            abort(403, 'Admins only');
        }
  $users = User::with('role')->get();
$roles = Role::all();

        return view('admin-dashboard.roles', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
         $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->role_id = $request->role_id;
        $user->save();

    return redirect()->back()->with('success', 'Role updated successfully.');
    }


}
