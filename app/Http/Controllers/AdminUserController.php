<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAdmin;

class AdminUserController extends Controller
{
    public function create()
    {
        return view('admin.user_admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:user_admin,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = UserAdmin::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('useradmin.create')->with('success', 'User admin berhasil dibuat.');
    }
}
