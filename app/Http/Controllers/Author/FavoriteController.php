<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(){
        $posts = Auth::user()->favorite_posts;
        return view('author.favorite',compact('posts'));
    }

    public function show($post)
    {
        if(Auth::user()->role_id == 2){
            $post = Post::findOrFail($post);
            return view('author.post.show', compact('post'));
        }
        
    }
}
