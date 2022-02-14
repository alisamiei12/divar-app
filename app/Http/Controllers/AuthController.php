<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'number' => 'required|numeric|digits:11|unique:users',
            'password' => 'required|min:4|max:22',
        ]);

        $slug = Str::random(5);

        $user = new User;

        $user->name = $request->name;
        $user->slug = $slug;
        $user->number = $request->number;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('login.form')->with('status', 'ثبت نام شما با موفقیت انجام شد');

    }

    public function registerAdminForm()
    {
        $count = User::where('role', 5)->count();
        if($count == 0)
        {
            return view('auth.registerAdmin');
        }
        else
        {
            return redirect()->route('post.index');
        }
        
    }

    public function registerAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'number' => 'required|numeric|digits:11|unique:users',
            'password' => 'required|min:4|max:22',
        ]);

        $role = 5;

        $slug = Str::random(5);

        $user = new User;

        $user->name = $request->name;
        $user->slug = $slug;
        $user->number = $request->number;
        $user->password = Hash::make($request->password);
        $user->role = $role;

        $user->save();

        return redirect()->route('login.form');

    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|numeric|digits:11',
            'password' => 'required|min:4|max:22',
        ]);

        if (Auth::attempt(['number' => $request->number, 'password' => $request->password, 'active' => 1])) {
            User::where('id', auth()->user()->id)->update(['updated_at' => date('Y-m-d H:i:s')]);
            return redirect()->route('post.index');
        }

        return back()->withErrors([
            'password' => 'مشکلی هست دقت کنید',
        ]);

    }

    public function logOut() {
        Session::flush();
        Auth::logout();

        return redirect('/');

    }
}
