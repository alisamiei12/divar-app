<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        
        $results = Post::where('status', 2)->orderBy('id', 'desc')->paginate(10);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $artilces.='<a href="/p/'.$result->slug.'" class="items-a">
                                <div class="item">
                                    <div class="item-img">
                                        <img src="website/upload/'.$result->img.'">
                                    </div>
                                    <div class="item-body">
                                        <div class="item-body-top">'.$result->title.'</div>
                                        <div class="item-body-bottom">
                                            <p>'.$result->price.' تومان</p>
                                            <p>'.jdate($result->created_at)->format('%d %B،%M : %H').'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>';
                
            }
            return $artilces;
        }
        return view('website.post.index', compact('categories'));
    }

    public function category(Request $request, $slug)
    {
        $categories = Category::get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $results = Post::where('category_id', $category->id)->where('status', 2)->orderBy('id', 'desc')->paginate(10);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $artilces.='<a href="/p/'.$result->slug.'" class="items-a">
                                <div class="item">
                                    <div class="item-img">
                                        <img src="/website/upload/'.$result->img.'">
                                    </div>
                                    <div class="item-body">
                                        <div class="item-body-top">'.$result->title.'</div>
                                        <div class="item-body-bottom">
                                            <p>'.$result->price.' تومان</p>
                                            <p>'.jdate($result->created_at)->format('%d %B،%M : %H').'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>';
                
            }
            return $artilces;
        }
        return view('website.post.category', compact(['categories','slug']));
    }

    public function mypost(Request $request)
    { 
        $categories = Category::get();
        
        $results = Post::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $artilces.='<a href="/manage/'.$result->slug.'" class="items-a">
                                <div class="item">
                                    <div class="item-img">
                                        <img src="website/upload/'.$result->img.'">
                                    </div>
                                    <div class="item-body">
                                        <div class="item-body-top">'.$result->title.'</div>
                                        <div class="item-body-bottom">
                                            <p>'.$result->price.' تومان</p>
                                            <p>'.jdate($result->created_at)->format('%d %B،%M : %H').'</p>
                                        </div>
                                    </div>
                                </div>
                            </a>';
                
            }
            return $artilces;
        }
        return view('website.post.mypost', compact('categories'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 2)->firstOrFail();
        $post->view_count = $post->view_count + 1;
        $post->update();
        return view('website.post.show', compact('post')); 
    }

    public function manage($slug)
    {
        $post = Post::where('slug', $slug)->where('user_id', auth()->user()->id)->firstOrFail();
        return view('website.post.manage', compact('post')); 
    }


    public function create(Request $request)
    {
        $categories = Category::get();
        return view('website.post.create', compact('categories'));
        
    }


    public function store(Request $request)
    {
        //return $request;
        $validated = $request->validate([
            'title' => 'required|min:3|max:50',
            'price' => 'required|integer|min:1000|max:10000000000',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $imageName="";
        if($request->img)
        {
            $imageName = auth()->user()->id.'_'.time().'.'.$request->img->extension();  
            $request->img->move(public_path('website/upload'), $imageName);
        }

        $slug = Str::random(7);

        // add category
        $post = new Post;
        $post->category_id = $request->category;
        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->slug = $slug;
        $post->price = $request->price;
        $post->status_kala = $request->status_kala;
        $post->description = $request->description;
        $post->img = $imageName;
        $post->save();

        // redirect list category
        return redirect()->route('post.mypost');
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->where('user_id', auth()->user()->id)->firstOrFail();
        $categories = Category::get();
        return view('website.post.edit', compact(['post','categories'])); 
    }

    public function editImg($slug)
    {
        $post = Post::where('slug', $slug)->where('user_id', auth()->user()->id)->firstOrFail();
        return view('website.post.editimg', compact('post'));
        
    }


    public function update(Request $request)
    {
         //return $request;
         $validated = $request->validate([
            'title' => 'required|min:3|max:50',
            'price' => 'required|integer|min:1000|max:10000000000',
        ]);

        $post = Post::where('slug', $request->slug)->where('user_id', auth()->user()->id)->firstOrFail();

        
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->price = $request->price;
        $post->status_kala = $request->status_kala;
        $post->description = $request->description;
        $post->update();
        return redirect()->route('post.mypost');
    }

    public function updateImg(Request $request)
    {
        //return $request;
        $validated = $request->validate([
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $post = Post::where('slug', $request->slug)->where('user_id', auth()->user()->id)->firstOrFail();

        if($request->img)
        {
            if($post->img)
            {
                $image_path = public_path().'/website/upload/'.$post->img;
                unlink($image_path);
            }
            $imageName = auth()->user()->id.'_'.time().'.'.$request->img->extension();  
            $request->img->move(public_path('website/upload'), $imageName);
            $post->img = $imageName;
            $post->update();
        }

        // redirect list category
        return redirect()->route('post.mypost');
    }


    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->where('user_id', auth()->user()->id)->firstOrFail();
        if($post->img)
        {
            $image_path = public_path().'/website/upload/'.$post->img;
            unlink($image_path);
        }
        $post->delete();
        return redirect()->route('post.mypost');
    }
}
