<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreNewsletterRequest;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Newsletter::query())->addIndexColumn()->make(true);
        }
        return view('subscribers.news');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsletterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsletterRequest $request)
    {
        $newsletter = Newsletter::create([
            'text' => $request->body,
        ]);
        return redirect()->route('newsletters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        return view('subscribers.show',compact('newsletter'));
    }



    public function send($id)
    {
        $newsletter = Newsletter::find($id);
        $subscribers = Subscriber::where('status',1)->get('email','id');

        foreach ($subscribers as $subscriber) {
            try{
             $sendmail =    Mail::to($subscriber->email)->send(new NewsletterMail($newsletter));
             if ($sendmail) {
                $newsletter->status = 2;
                $newsletter->update();
             }
            }catch (\Exception $exception){}
        }

        return response()->json(['status' => 'success', 'message' => 'Newsletter Sent successfylly !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->delete();
        return response()->json(['status' => 'success', 'message' => 'Newsletter deleted successfylly !']);
    }
}
