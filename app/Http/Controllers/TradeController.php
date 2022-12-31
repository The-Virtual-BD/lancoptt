<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreTradeRequest;
use App\Http\Requests\UpdateTradeRequest;
use App\Models\TemporaryFile;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Trade::query())->addIndexColumn()->make(true);
        }
        return view('trades.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTradeRequest $request)
    {

        $trade = Trade::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $trade->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('images');
                    rmdir(storage_path('app/images/tmp/' . $image));
                    $tempfile->delete();
                }
            }
        }

        return redirect()->route('trades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        $trade->getMedia();
        return view('trades.show',compact('trade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTradeRequest  $request
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTradeRequest $request, Trade $trade)
    {
        if($request->image){
            $media =  $trade->getMedia();
            foreach($trade->media as $deleetablemedia){
                $deleetablemedia->delete();
            }
        }

        $trade->title = $request->title;
        $trade->body = $request->body;
        $trade->update();

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $trade->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('images');
                    rmdir(storage_path('app/images/tmp/' . $image));
                    $tempfile->delete();
                }
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $gallery = Trade::find($id);
        $gallery->delete();
        return response()->json(['status' => 'success', 'message' => 'Trade deleted successfylly !']);
    }
}
