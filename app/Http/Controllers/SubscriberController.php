<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Subscriber::query())->addIndexColumn()->make(true);
        }

        return view('subscribers.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriberRequest $request)
    {
        $subscribe = Subscriber::create(['email' => $request->email]);

        if ($request->site) {
            if ($subscribe) {
                return response()->json(['status' => 'success', 'message' => 'Email subscribed successfully !']);
            }else{
                return response()->json(['status' => 'error', 'message' => 'Email already subscribed !']);
            }
        }
        return redirect()->route('subscribers.index');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriberRequest  $request
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriberRequest $request, $id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->update(['status'=>$request->updateStatus]);
        return response()->json(['status'=>'success','message'=>'Subscriber '.(($request->updateStatus==1?'activated':'de-activated')).' successfully !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->delete();
        return response()->json(['status' => 'success', 'message' => 'Email unsubscribed successfylly !']);
    }
}
