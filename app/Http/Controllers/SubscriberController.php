<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

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
}
