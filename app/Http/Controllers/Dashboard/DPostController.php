<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class DPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(15);
        $count = Post::count();
        	
        return view('dashboard.post.index', compact(['posts','count']));
    }

    public function filter($status)
    {
        if($status == "releaseQueue")
        {
            $status = 1;
        }
        elseif($status == "published")
        {
            $status = 2;
        }
        else
        {
            $status = 0;
        }
        
        $posts = Post::where('status', $status)->orderBy('id', 'desc')->paginate(15);
        $count = Post::where('status', $status)->count();
        return view('dashboard.post.index', compact('posts','count'));
    }

    public function category($slug)
    {
        
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->orderBy('id', 'desc')->paginate(15);
        $count = Post::where('category_id', $category->id)->count();
        return view('dashboard.post.index', compact(['posts','count'])); 
    }

    public function user($slug)
    {
        
        $user = User::where('slug', $slug)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(15);
        $count = Post::where('user_id', $user->id)->count();
        return view('dashboard.post.index', compact(['posts','count'])); 
    }

    public function manage($slug)
    {
        session(['route' => url()->previous()]);
        
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('dashboard.post.manage', compact('post')); 
    }

    public function updateStatus($slug, $status)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->status = $status;
        $post->update();
        return redirect(session('route'));
    }


    public function destroy(Request $request)
    {
        Post::where('slug', $request->slug)->delete();
        return redirect()->back();
    }
}
