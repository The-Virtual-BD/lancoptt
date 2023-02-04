<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cruise;
use App\Models\Package;
use App\Models\Query;
use App\Models\Trade;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends Controller
{
    //Home Route
    public function home ()
    {
        $categories = Category::take(4)->get();
        foreach ($categories as $category) {
            foreach ($category->galleries as $gallery) {
                $gallery->getMedia();
            }
        }

        $trades = Trade::all();
        foreach ($trades as $trade) {
            $trade->getMedia();
        }

        $packages = Package::all();
        foreach ($packages as $trade) {
            $trade->getMedia();
        }


        $cruises = Cruise::take(4)->get();
        foreach ($cruises as $trade) {
            $trade->getMedia();
        }
        return view('index',compact('categories','trades','packages','cruises'));
    }

    // Dashboard route
    public function dashboard()
    {
        return view('dashboard');
    }
    // sitesettings route
    public function settings()
    {
        return view('settings.index');
    }
    // Contuctus page
    public function contactUS()
    {
        return view('contactUs');
    }
    // gallery page
    public function gallery()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            foreach ($category->galleries as $gallery) {
                $gallery->getMedia();
            }
        }
        return view('gallery',compact('categories'));
    }


    // allCruises page
    public function allCruises()
    {
        $cruises = Cruise::all();


        foreach ($cruises as $cruise) {
            $cruise->getMedia();

            foreach ($cruise->options as $option) {
                $option->getMedia();
            }
        }

        return view('allCruises',compact('cruises'));
    }

    // retailService page
    public function retailService()
    {
        $trades = Trade::all();
        foreach ($trades as $trade) {
            $trade->getMedia();
        }
        // return $trades;

        return view('retailService',compact('trades'));
    }


    // detailspackage page
    public function detailspackage()
    {
        $packages = Package::all();

        foreach ($packages as $package) {
            $package->getMedia();

            foreach ($package->options as $option) {
                $option->getMedia();
            }
        }


        // return $packages;

        return view('packagesd',compact('packages'));
    }

    // Contuctus send
    public function contsend(Request $request)
    {
        $subscribe = Query::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        if ($subscribe) {
            return response()->json(['status' => 'success', 'message' => 'Thanks for contucting us. We wil get to you soon.']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Something wrong !']);
        }
    }
}
