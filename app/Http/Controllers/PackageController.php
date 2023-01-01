<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\TemporaryFile;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Package::query())->addIndexColumn()->make(true);
        }
        return view('packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {
        $trade = Package::create([
            'title' => $request->title,
            'price' => $request->price,
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

        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        $package->getMedia();

        foreach ($package->options as $option) {
            $option->getMedia();
        }
        return view('packages.show',compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        if($request->image){
            $media =  $package->getMedia();
            foreach($package->media as $deleetablemedia){
                $deleetablemedia->delete();
            }
        }

        $package->title = $request->title;
        $package->body = $request->body;
        $package->price = $request->price;

        $package->update();

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $package->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
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
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();
        return response()->json(['status' => 'success', 'message' => 'Package deleted successfylly !']);
    }
}
