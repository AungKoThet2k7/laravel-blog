<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home');
    }

    public function upload(Request $request)
    {
        $newName = uniqid() . "_file_test." . $request->file('upload')->extension();
        
        $image = Image::make($request->file('upload'));

        //Large
        $image->resize(1000, null, fn($constraint) => $constraint->aspectRatio());
        Storage::makeDirectory('public/1000');
        $image->save("storage/1000/$newName");

        //Small
        $image->resize(500, null, fn($constraint) => $constraint->aspectRatio());
        $image->blur(10);
        $image->rotate(45);
        Storage::makeDirectory('public/500');
        $image->save("storage/500/$newName");
        // return $image->response('png');
        return redirect()->back();
    }

    // public function test()
    // {
    //     return view('test');
    // }
}
