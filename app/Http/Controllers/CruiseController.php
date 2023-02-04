<?php

namespace App\Http\Controllers;

use App\Models\Cruise;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCruiseRequest;
use App\Http\Requests\UpdateCruiseRequest;
use App\Models\TemporaryFile;


class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Cruise::query())->addIndexColumn()->make(true);
        }
        return view('cruises.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cruises.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCruiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCruiseRequest $request)
    {
        $cruise = Cruise::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $cruise->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('images');
                    rmdir(storage_path('app/images/tmp/' . $image));
                    $tempfile->delete();
                }
            }
        }

        return redirect()->route('cruises.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cruise  $cruise
     * @return \Illuminate\Http\Response
     */
    public function show(Cruise $cruise)
    {
        $cruise->getMedia();
        foreach ($cruise->options as $option) {
            $option->getMedia();
        }
        return view('cruises.show',compact('cruise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cruise  $cruise
     * @return \Illuminate\Http\Response
     */
    public function edit(Cruise $cruise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCruiseRequest  $request
     * @param  \App\Models\Cruise  $cruise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCruiseRequest $request, Cruise $cruise)
    {
        if($request->image){
            $media =  $cruise->getMedia();
            foreach($cruise->media as $deleetablemedia){
                $deleetablemedia->delete();
            }
        }

        $cruise->title = $request->title;
        $cruise->body = $request->body;
        $cruise->update();

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $cruise->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
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
     * @param  \App\Models\Cruise  $cruise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cruise = Cruise::find($id);
        $cruise->delete();
        return response()->json(['status' => 'success', 'message' => 'Cruise deleted successfylly !']);
    }
}
