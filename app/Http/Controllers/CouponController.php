<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
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
    public function add_coupon(){
        $this->AuthLogin();
        return view('admin.add_coupon');
    }


    public function save_coupon(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['coupon_status'] = $request->coupon_status;
        DB::table('tbl_coupon')->insert($data);
        Session::put('message','Thêm mã khuyến mãi thành công.');
        return Redirect::to('add-coupon');

    }

    public function all_coupon(){
        $this->AuthLogin();
        $all_coupon = DB::table('tbl_coupon')->get();
        $manager_coupon = view('admin.all_coupon')->with('all_coupon',$all_coupon);
        return view('admin_layout')->with('admin.all_coupon', $manager_coupon);
    }

    public function unactive_coupon ($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->update(['coupon_status'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công.');
        return Redirect::to('all-coupon');
    }

    public function active_coupon ($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->update(['coupon_status'=>0]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công.');
        return Redirect::to('all-coupon');
    }

    public function edit_ecoupon($ecoupon_id){
        $this->AuthLogin();
        $edit_ecoupon = DB::table('tbl_brand')->where('brand_id',$ecoupon_id)->get();
        $manager_ecoupon = view('admin.edit_ecoupon')->with('edit_ecoupon',$edit_ecoupon);
        return view('admin_layout')->with('admin.edit_ecoupon', $manager_ecoupon);
    }

    public function update_ecoupon(Request $request,$ecoupon_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->ecoupon_name;
        $data['brand_desc'] = $request->ecoupon_desc;
        $data['brand_status'] = $request->ecoupon_status;
        DB::table('tbl_brand')->where('brand_id',$ecoupon_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công.');
        return Redirect::to('all-brand-product');
    }

    public function delete_ecoupon($ecoupon_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$ecoupon_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công.');
        return Redirect::to('all-brand-product');
    }

}
