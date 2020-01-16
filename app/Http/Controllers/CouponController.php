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
        Session::put('message','Kích hoạt mã khuyến mãi thành công.');
        return Redirect::to('all-coupon');
    }

    public function active_coupon ($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->update(['coupon_status'=>0]);
        Session::put('message','Không kích hoạt mã khuyến mãi thành công.');
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
        Session::put('message','Cập nhật mã khuyến mãi thành công.');
        return Redirect::to('all-coupon');
    }

    public function delete_coupon($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->delete();
        Session::put('message','Xóa mã khuyến mãi thành công.');
        return Redirect::to('all-coupon');
    }

    public function apply_coupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('total_after_discount');
        Session::forget('coupon_name');

        $data = $request->all();
        $test = DB::table('tbl_coupon')->where('coupon_name',$data['coupon_name'])->count();
        if ($test == 0){
            Session::put('message','Mã khuyến mãi không tồn tại. Xin vui lòng nhập lại');
            $message = 'Mã khuyến mãi không tồn tại. Xin vui lòng nhập lại';
            return $message;
        }else{
            $couponDetails = DB::table('tbl_coupon')->where('coupon_name',$data['coupon_name'])->first();

            if($couponDetails->coupon_status==0){
                $message = 'Mã khuyến mãi không tồn tại. Xin vui lòng nhập lại';
                Session::put('message','Mã khuyến mãi không tồn tại. Xin vui lòng nhập lại');
                return $message;
            }

            

            $content = Cart::content();
            $total_amount = 0;
            foreach($content as $v_content){

                $total_amount = $total_amount + ($v_content->qty * $v_content->price); 
            }

            // amount discount

            $couponAmount = $total_amount * ($couponDetails->coupon_amount/100);

            // $couponAmount_1 = $total_amount * ($couponDetails->coupon_amount/100);

            $total_after_discount = $total_amount - $couponAmount;

            Session::put('CouponAmount',$couponAmount);

            // Session::put('CouponAmount_1',$couponAmount_1);

            Session::put('total_amount',$total_amount);
            Session::put('total_after_discount',$total_after_discount);
            Session::put('coupon_name',$data['coupon_name']);
            $message = 'Mã khuyến mãi áp dụng thành công!';
            Session::put('message','Mã khuyến mãi áp dụng thành công');
            return $message;
        } 
    }

}
