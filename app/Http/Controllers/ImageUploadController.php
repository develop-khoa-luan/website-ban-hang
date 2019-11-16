<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUpload;
use Illuminate\Support\Facades\Redirect;
use Session;

class ImageUploadController extends Controller
{
    public function fileCreate()
    {
        return view('admin.add_image');
    }

    public function allImage()
    {
        $photos = ImageUpload::all();
        return view('gallery.all_image', compact('photos'));
    }

    //for getting image ckeditor and choose picture product
    public function add_gallery()
    {
        return view('gallery.add_image');
    }

    //for adding image ckeditor and choose picture 
    public function gallery()
    {
        $photos = ImageUpload::all();
        return view('gallery.all_image', compact('photos'));
    }

    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads/product'),$imageName);
        $imageUpload = new ImageUpload();
        $imageUpload->filename = $imageName;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    public function fileDestroy($filename)
    {
        ImageUpload::where('filename',$filename)->delete();
        $path=public_path().'/uploads/product/'.$filename;
        if (file_exists($path)) {
            unlink(public_path('uploads/product/'. $filename));
            Session::put('message', 'Xóa hình ảnh thành công.');
        }
        else {
            Session::put('message', 'Không xóa thành công.');
        }
        return Redirect::to('all-image');  
    }

}
