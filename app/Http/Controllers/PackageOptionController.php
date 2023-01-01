<?php

namespace App\Http\Controllers;

use App\Models\PackageOption;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StorePackageOptionRequest;
use App\Http\Requests\UpdatePackageOptionRequest;
use App\Models\Package;
use App\Models\TemporaryFile;


class PackageOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( PackageOption::query())->addIndexColumn()->make(true);
        }
        return view('packagesOptions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $packages = Package::all();
        return view('packagesOptions.create',compact('packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageOptionRequest $request)
    {

        $trade = PackageOption::create([
            'title' => $request->title,
            'package_id' => $request->package_id,
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

        return redirect()->route('packagesOptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $packageOption = PackageOption::with('package')->find($id);
        $packageOption->getMedia();
        return view('packagesOptions.show',compact('packageOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageOption $packageOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageOptionRequest  $request
     * @param  \App\Models\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageOptionRequest $request,  $id)
    {


        $packageOption = PackageOption::find($id);


        if($request->image){
            $media =  $packageOption->getMedia();
            foreach($packageOption->media as $deleetablemedia){
                $deleetablemedia->delete();
            }


            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $packageOption->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('option');
                    rmdir(storage_path('app/images/tmp/' . $image));
                    $tempfile->delete();
                }
            }
            
            return redirect()->back();
        }

        $packageOption->title = $request->title;
        $packageOption->body = $request->body;
        $packageOption->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packageOption = PackageOption::find($id);
        $packageOption->delete();
        return response()->json(['status' => 'success', 'message' => 'Option deleted successfylly !']);
    }
}
