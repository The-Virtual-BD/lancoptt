<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Category;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Gallery::all())->addIndexColumn()->make(true);
        }
        return view('galleries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('galleries.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {

        $gallery = Gallery::create([
            'category_id' => $request->category_id,
        ]);

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $gallery->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
                        ->toMediaCollection('images');
                    rmdir(storage_path('app/images/tmp/' . $image));
                    $tempfile->delete();
                }
            }
        }

        return redirect()->route('galleries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $photos = $gallery->getMedia();
        return view('galleries.show', compact('gallery','photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $photos = $gallery->getMedia();
        return view('galleries.edit', compact('gallery','photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {

        if ($request->image) {
            foreach ($request->image as $image) {
                $tempfile = TemporaryFile::where('folder', $image)->first();
                if ($tempfile) {
                    $gallery->addMedia(storage_path('app/images/tmp/' . $image . '/' . $tempfile->filename))
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
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return response()->json(['status' => 'success', 'message' => 'Gallery deleted successfylly !']);
    }
}
