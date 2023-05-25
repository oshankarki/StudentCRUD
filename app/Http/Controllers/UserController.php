<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {

        return view('user.show');
    }
    public function edit()
    {

        return view('user.edit');
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('user.show')->with('success', 'Profile updated successfully');
    }
    public function changePassword()
    {

        return view('user.password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!password_verify($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors( 'Invalid old password');
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return redirect()->route('user.show')->with('success', 'Password updated successfully');
    }




}
