<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

use Cart;

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

    public function edit_coupon($coupon_id){
        $this->AuthLogin();
        $edit_coupon = DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->get();
        $manager_coupon = view('admin.edit_coupon')->with('edit_coupon',$edit_coupon);
        return view('admin_layout')->with('admin.edit_coupon', $manager_coupon);
    }

    public function update_coupon(Request $request,$coupon_id){
        $this->AuthLogin();
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['coupon_status'] = $request->coupon_status;
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->update($data);
        Session::put('message','Cập nhật danh mục mã khuyến mãi thành công.');
        return Redirect::to('all-coupon');
    }

    public function delete_coupon($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->delete();
        Session::put('message','Xóa mã khuyến mãi thành công.');
        return Redirect::to('all-coupon');
    }

    public function apply_coupon(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $test = DB::table('tbl_coupon')->where('coupon_name',$data['coupon_name'])->count();
        if ($test == 0){
            Session::put('message','Mã khuyến mãi không tồn tại. Xin vui lòng nhập lại');
            return Redirect::to('payment');
        }else{
            $couponDetails = DB::table('tbl_coupon')->where('coupon_name',$data['coupon_name'])->first();

            if($couponDetails->coupon_status==0){
                Session::put('message','Mã khuyến mãi không tồn tại hoat dong. Xin vui lòng nhập lại');
                return Redirect::to('payment');
            }

            // $get_cart_coupon = Cart::content();
            // $total_amount = 0;
            // foreach($get_cart_coupon as $g_coupon){
            //     $coupon_detail_data = array();
            //     $coupon_detail_data['order_id'] = $g_coupon->order_id;
            //     $coupon_detail_data['product_id'] = $g_coupon->id;
            //     $coupon_detail_data['product_name'] = $g_coupon->name;
            //     $coupon_detail_data['product_price'] = $g_coupon->price;
            //     $coupon_detail_data['product_sales_quantity'] = $g_coupon->qty;
            //     $coupon_detail_data['product_size'] = $g_coupon->options->size;

            //     $total_amount = $total_amount + ($g_coupon->qty * $g_coupon->price); 
            // }

            $content = Cart::content();
            $total_amount = 0;
            foreach($content as $v_content){

                $total_amount = $total_amount + ($v_content->qty * $v_content->price); 
            }



            // amount discount

            $couponAmount = $total_amount * ($couponDetails->coupon_amount/100);

            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_name']);
            Session::put('message','Mã khuyến mãi áp dụng thành công');
            //     return Redirect::to('payment');
            return redirect()->back();
            // echo $couponAmount; die;
        } 
    }

}
