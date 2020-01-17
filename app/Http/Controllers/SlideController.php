<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class SlideController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_slide(){
        $this->AuthLogin();
        return view('admin.add_slide');
    }

    public function save_slide(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['slide_name'] = $request->slide_name;
        $data['slide_image'] = $request->slide_image;
        $data['slide_status'] = $request->slide_status;

        DB::table('tbl_slide')->insert($data);
        Session::put('message','Thêm ảnh bìa thành công.');
        return Redirect::to('add-slide');

    }

    public function all_slide(){
        $this->AuthLogin();
        $all_slide = DB::table('tbl_slide')->get();
        $manager_slide = view('admin.all_slide')->with('all_slide',$all_slide);
        return view('admin_layout')->with('admin.all_slide', $manager_slide);
    }

    public function unactive_slide ($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slide')->where('slide_id',$slide_id)->update(['slide_status'=>1]);
        Session::put('message','Kích hoạt ảnh bìa thành công.');
        return Redirect::to('all-slide');
    }

    public function active_slide ($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slide')->where('slide_id',$slide_id)->update(['slide_status'=>0]);
        Session::put('message','Không kích hoạt ảnh bìa thành công.');
        return Redirect::to('all-slide');
    }

    public function delete_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slide')->where('slide_id',$slide_id)->delete();
        Session::put('message','Xóa ảnh bìa thành công.');
        return Redirect::to('all-slide');
    }

}
