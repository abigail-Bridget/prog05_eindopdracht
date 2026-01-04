<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Access denied. You do not have permission to view this page.');
        }

        $users = User::all();
        return view('admin.manageuser', compact('users'));
    }

    public function showAdminDashboard()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Access denied. You do not have permission to view this page.');
        }

        return view('admindashboard');
    }

    public function edit(User $user)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Access denied. You do not have permission to view this page.');
        }

        return view('admin.manageuser', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Access denied. You do not have permission to view this page.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.'
        );
    }

    public function destroy(User $user)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Access denied. You do not have permission to view this page.'
            );
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User successfully deleted.'
        );
    }
}
