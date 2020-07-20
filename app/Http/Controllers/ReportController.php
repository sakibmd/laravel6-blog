<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\ReportComment;
use App\Post;
use App\Comment;

class ReportController extends Controller
{
    public function reportOnAPost(Request $request)
    {
       
        $this->validate($request,[
            'report' => 'required',
           ]);
        
        $r = new Report();
        $r->reported_by = $request->name;
        $r->post_title = $request->post_title;
        $r->post_id = $request->post_id;
        $r->reason =$request->report;
        $slug = str_slug($request->post_title);
        $r->save();
  
        return redirect(route('post.details', $slug))->with('report', 'Your report has been submitted');
    }
    
    public function reportOnAComment(Request $request)
    {
       
        $cid = $request->commentId;
        $cidSingle = Comment::find($cid);
        
        $postid = $request->post_id;
        $cr = new reportComment();
        $cr->post_id = $request->post_id;
        $cr->commented_by = $request->commented_by;
        $cr->comment = $cidSingle->comment;
        $singlePost = Post::find($postid);
        $slug = $singlePost->slug;
        $cr->post_title = $singlePost->title;
        $cr->comment_id = $cid;
        $cr->post_creatorName = $singlePost->user->name;
        $cr->save();
  
        return redirect(route('post.details', $slug))->with('report', 'Your report on a comment has been submitted');
    }
}
