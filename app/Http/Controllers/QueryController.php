<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreQueryRequest;
use App\Http\Requests\UpdateQueryRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\QueryMail;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allquaries(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Query::query())->addIndexColumn()->make(true);
        }

        return view('quaries.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function readed(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Query::where('status', 2)->get())->addIndexColumn()->make(true);
        }

        return view('quaries.readed');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unreaded(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Query::where('status', 1)->get())->addIndexColumn()->make(true);
        }

        return view('quaries.unreaded');
    }


    public function replay(Request $request)
    {

        // return $request;
        $sender = Query::find($request->sender);
        $msg = $request->message;
        try{
            $sendmail =    Mail::to($sender->email)->send(new QueryMail($sender,$msg));
            if ($sendmail) {
                $sender->status = 3;
                $sender->update();
            }
        }catch (\Exception $exception){}

        // return response()->json(['status' => 'success', 'message' => 'Replied successfylly !']);
        return redirect()->route('quaries.all');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQueryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQueryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function read (Query $query)
    {
        if ($query->status == 1) {
            $query->status = 2 ;
            $query->update();
        }
        return view('quaries.read',compact('query'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function edit(Query $query)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQueryRequest  $request
     * @param  \App\Models\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function toggle(UpdateQueryRequest $request, $id)
    {

        $query = Query::find($id);
        $query->status=$request->updateStatus;
        $query->update();
        return response()->json(['status'=>'success','message'=>'Message mark as '.(($request->updateStatus==1?'unreaded':'readed')).' !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Query  $query
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Query::find($id);
        $category->delete();
        return response()->json(['status' => 'success', 'message' => 'Message deleted successfylly !']);
    }
}
