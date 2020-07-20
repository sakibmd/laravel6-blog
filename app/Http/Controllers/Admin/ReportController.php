<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Report;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;
use App\ReportComment;

class ReportController extends Controller
{
    public function showAllReport(){
        $posts = Report::latest()->get();
        return view('admin.reportList',compact('posts'));
    }

    public function reportedPostShow($id){
        $post = Post::find($id);
        return view('admin.showReportedPost',compact('post'));
    }


    public function deleteReport($item){
        $r = Report::find($item);
        $r->delete();
        return redirect(route('admin.report.show'))->with('success','Report Deleted Successfully');
    }

    public function deleteReportedPost($id){
       
        $post = Post::find($id);
        if (Storage::disk('public')->exists('post/'.$post->image)) {
            Storage::disk('public')->delete('post/'.$post->image);
         }
         $post->categories()->detach();
         $post->tags()->detach();
         $post->delete();
        return redirect(route('admin.report.show'))->with('success','Report Deleted Successfully');
    }


    public function reportedCommentShow(){
        $rc = ReportComment::latest()->get();
        return view('admin.reportedComments',compact('rc'));
    }

    public function reportedCommentdestroy($id){
            Comment::findOrFail($id)->delete();
            return redirect()->back()->with('success','Comment Deleted Successfully');
    }

    public function reportedCommentRemoveFromReportList($id){
        ReportComment::findOrFail($id)->delete();
        return redirect()->back()->with('success','Report Deleted Successfully');
    }



}
