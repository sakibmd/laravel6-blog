<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\ReportComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('admin.comments',compact('comments'));
    }

    public function destroy($id){
         Comment::findOrFail($id)->delete();
         return redirect()->back()->with('success','Comment Removed Successfully');
    }


    public function reportedCommentShow(){
        $rc = ReportComment::latest()->get();
        return view('admin.reportedComments',compact('rc'));
    }

    public function reportedCommentdestroy($id){
        Comment::findOrFail($id)->delete();
        return redirect()->back()->with('success','Comment Deleted Successfully');
   }

   public function reportedCommentRemove($id){
    ReportComment::findOrFail($id)->delete();
    return redirect()->back()->with('success','Report Deleted Successfully');
}


}
