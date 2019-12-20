<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
use DB;

class APIController extends Controller
{
    function count_cart(){
        $count_cart = Cart::content()->count();
        return response()->json(['count_cart'=>$count_cart]);
    }

    function get_quantity(Request $request){
        $product_id = $request->product_id;
        $product_size = $request->product_size;
        $product_detail = DB::table('tbl_product_detail')->where('product_id', $product_id)->where('product_size', $product_size)->first();
        return response()->json(['product_quantity'=>$product_detail->product_quantity]);
    }

    function get_product_detail(Request $request){
        $product_id = $request->product_id;
        $product_detail = DB::table('tbl_product_detail')->where('product_id', $product_id)->get();
        return response()->json(['product_detail'=>$product_detail]);
    }

    function get_product(Request $request){
        $product_id = $request->product_id;
        $product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.product_id', $product_id)->get();
        return response()->json(['product'=>$product]);
    }

    public function login_customer_modal(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return "Đăng nhập thành công!";
        } else {
            return "Sai tên đăng nhập hoặc mật khẩu!";
        }
    }

}
