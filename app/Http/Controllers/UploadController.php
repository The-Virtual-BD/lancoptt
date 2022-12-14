<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\PackageOption;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class UploadController extends Controller
{

    // Temporarily uploading file
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $folder = uniqid().'-'.now()->timestamp;
            foreach ($images as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('images/tmp/'.$folder,$filename);
                TemporaryFile::create([
                    'folder' => $folder,
                    'filename' => $filename
                ]);
                return $folder;
            }
            return '';
        }
    }
    // Deleting midea Image
    public function delete(Gallery $gallery, $id)
    {
        // return $id;
        $media =  $gallery->getMedia();
        $image =  $gallery->media->where('id',$id)->first();
        $image->delete();

        return redirect()->back();
    }


    //Delete any Media
    public function mideaDelete($id)
    {
        $media = Media::find($id);
        $media->delete();
        return redirect()->back();
    }


}
