<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->Approved()->Published()->take(8)->get();
        $popularPosts = Post::Approved()->Published()->orderBy('view_count','desc')->take(4)->get();
        return view('welcome',compact('posts','categories','popularPosts'));
    }
}
