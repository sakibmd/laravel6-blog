<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $authors = User::Authors()
                         ->withCount('posts')
                        ->withCount('comments')
                        ->withCount('favorite_posts')
                        ->get();
        return view('admin.authors', compact('authors'));
    }

    public function destroy($id){
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Author Deleted Successfully');
    }
}
