<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //  Admin dashboard
    public function dashboard()
    {
        // Check: alleen admins
        if (!Auth::check() || !Auth::user()->is_admin) {
            return view('access-denied');
        }

        // Alle users ophalen voor overzicht
        $users = User::all();

        return view('admindashboard', compact('users'));
    }

    // Lijst met users
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return view('access-denied');
        }

        $users = User::all();

        return view('admin.manageuser', compact('users'));
    }

    //  User edit formulier
    public function editUser(User $user)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return view('access-denied');
        }

        return view('admin.manageuser', compact('user'));
    }

    // User updaten
    public function updateUser(Request $request, User $user)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return view('access-denied');
        }

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'is_admin'=> 'boolean',
        ]);

        $user->name    = $request->input('name');
        $user->email   = $request->input('email');
        $user->is_admin = $request->boolean('is_admin');
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User successfully updated.');
    }

    // User verwijderen
    public function destroyUser(User $user)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return view('access-denied');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User successfully deleted.');
    }
}
