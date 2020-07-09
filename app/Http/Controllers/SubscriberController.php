<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Report;

class SubscriberController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:subscribers',
        ]);

        $s = new Subscriber();
        $s->email = $request->email;
        $s->save();

        return redirect(route('mainhome'))->with('successSubscriber', 'Subscriber Added Successfully');
    }

    public function report(Request $request)
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

}
