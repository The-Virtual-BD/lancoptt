<?php

namespace App\Http\Controllers;

use App\Models\CruiseOption;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCruiseOptionRequest;
use App\Http\Requests\UpdateCruiseOptionRequest;
use App\Models\Cruise;
use App\Models\TemporaryFile;

class CruiseOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( CruiseOption::query())->addIndexColumn()->make(true);
        }
        return view('cruiseOptions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cruises = Cruise::all();
        return view('cruiseOptions.create',compact('cruises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCruiseOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCruiseOptionRequest $request)
    {
        $trade = CruiseOption::create([
            'title' => $request->title,
            'cruise_id' => $request->cruise_id,
            'body' => $request->body,
        ]);

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $trade->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('option');
                    $tempfile->delete();
                    rmdir(storage_path('app/images/tmp/' . $image));
                }
            }
        }

        return redirect()->route('cruiseOptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CruiseOption  $cruiseOption
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cruiseOption = CruiseOption::with('cruise')->find($id);
        $cruiseOption->getMedia();
        return view('cruiseOptions.show',compact('cruiseOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CruiseOption  $cruiseOption
     * @return \Illuminate\Http\Response
     */
    public function edit(CruiseOption $cruiseOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCruiseOptionRequest  $request
     * @param  \App\Models\CruiseOption  $cruiseOption
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCruiseOptionRequest $request,  $id)
    {
        $cruiseOption = CruiseOption::find($id);


        if($request->image){
            $media =  $cruiseOption->getMedia();
            foreach($cruiseOption->media as $deleetablemedia){
                $deleetablemedia->delete();
            }


            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $cruiseOption->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('option');
                    rmdir(storage_path('app/images/tmp/' . $image));
                    $tempfile->delete();
                }
            }

            return redirect()->back();
        }

        $cruiseOption->title = $request->title;
        $cruiseOption->body = $request->body;
        $cruiseOption->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CruiseOption  $cruiseOption
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cruiseOption = CruiseOption::find($id);
        $cruiseOption->delete();
        return response()->json(['status' => 'success', 'message' => 'Option deleted successfylly !']);
    }
}
