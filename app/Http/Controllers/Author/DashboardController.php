<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()
    			->withCount('comments')
    			->withCount('favorite_to_user')
    			->orderBy('view_count','desc')
    			->orderBy('comments_count', 'desc')
    			->orderBy('favorite_to_user_count', 'desc')
    			->take(5)->get();

        $total_pending_posts = $posts->where('is_approved',false)->count();
        $all_views = $posts->sum('view_count'); 

    	return view('author.dashboard',compact('posts','popular_posts','total_pending_posts','all_views'));
    }
}
