<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber.index',compact('subscribers'));
    }

    public function deleteSubscriberFunction($subscriber){
        $subscriber = Subscriber::find($subscriber);
        $subscriber->delete();
        return redirect(route('admin.subscriber.index'))->with('success','Subscriber Deleted Successfully');
    }

    // public function app($subscriber){
    //     $subscriber_delete_id = Subscriber::findOrFail($subscriber);
    //     $subscriber_delete_id->delete();
    //     return redirect(route('admin.subscriber.index'))->with('success','Subscriber Deleted Successfully');
    // }
}
