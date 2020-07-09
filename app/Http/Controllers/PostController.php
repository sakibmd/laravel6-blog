<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){
        $posts = Post::latest()->Approved()->Published()->paginate(8);
        return view('posts',compact('posts'));
    }

    
    public function details($slug){
        $post = Post::where('slug', $slug)->Approved()->Published()->first();

        $blogKey = 'blog_' . $post->id;
        if(!Session::has($blogKey)){
            $post->increment('view_count');
            Session::put($blogKey,1);
        }

        $randomposts = Post::Approved()->Published()->take(4)->inRandomOrder()->get();

        return view('post',compact('post','randomposts'));
    }


    public function postByCategory($slug){
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->Approved()->Published()->get();
        return view('category', compact('category','posts'));
    }

    public function postByTag($slug){
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->Approved()->Published()->get();
        return view('tag', compact('tag', 'posts'));
    }

    
}
