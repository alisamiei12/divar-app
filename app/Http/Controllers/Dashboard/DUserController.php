<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class DUserController extends Controller
{
    
    public function index()
    {
        $users = User::where('role', 1)->orderBy('id', 'desc')->paginate(15);
        $users = User::orderBy('id', 'desc')->paginate(15);
        $count = User::count();
        	
        return view('dashboard.user.index', compact(['users','count']));
    }

    public function updateStatus($slug, $status)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $user->active = $status;
        $user->update();
        return redirect()->route('d.user.index');
    }
    
    public function destroy(Request $request)
    {
        $user = User::where('slug', $request->slug)->first();
        if($user)
        {
            $user->delete();
            Post::where('user_id', $user->id)->delete();
        }
        return redirect()->route('d.user.index');
    }
}
