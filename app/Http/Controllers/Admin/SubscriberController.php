<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Report;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber.index',compact('subscribers'));
    }
    

    public function showAllReport(){
        $posts = Report::latest()->get();
        return view('admin.reportList',compact('posts'));
    }

    public function deleteSubscriberFunction($subscriber){
        $subscriber = Subscriber::find($subscriber);
        $subscriber->delete();
        return redirect(route('admin.subscriber.index'))->with('success','Subscriber Deleted Successfully');
    }


    public function deleteReport($item){
        $r = Report::find($item);
        $r->delete();
        return redirect(route('admin.report.show'))->with('success','Report Deleted Successfully');
    }

    // public function app($subscriber){
    //     $subscriber_delete_id = Subscriber::findOrFail($subscriber);
    //     $subscriber_delete_id->delete();
    //     return redirect(route('admin.subscriber.index'))->with('success','Subscriber Deleted Successfully');
    // }
}
