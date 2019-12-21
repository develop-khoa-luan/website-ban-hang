<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use ArrayObject;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
session_start();

use Cart;

class CartController extends Controller
{
    public function save_cart(Request $request){
        $product_Id = $request->product_id_hidden;
        $quanlity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$product_Id)->first();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quanlity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['option']['image'] = $product_info->product_image;
        Cart::add($data);
        $cart_count = Cart::content()->count();
        return response()->json(['cart_count'=>$cart_count]);
    }

    public function save_cart_with_size(Request $request){
        $product_Id = $request->product_id_hidden;
        $quanlity = $request->qty;
        $size = $request->product_size;
        $product_info = DB::table('tbl_product')->where('product_id',$product_Id)->first();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quanlity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        $data['options']['size'] = $size;
        Cart::add($data);
        $cart_count = Cart::content()->count();
        Session::put('cart_count', $cart_count);
        return response()->json(['cart_count'=>$cart_count]);
    }


    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();

        $get_cart = Cart::content();

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $selling_product = DB::table('tbl_order_detail')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
        ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
        ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
        ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
        ->get();

        $product_detail = array();
        foreach($get_cart as $cart){
            $get_product_detail = DB::table('tbl_product_detail')->where('product_id', $cart->id)->get();
            array_push($product_detail, $get_product_detail);
        }

        return view('pages.cart.show_cart')->with('all_slide', $all_slide)->with('selling_product', $selling_product)->with('category', $cate_product)->with('brand', $brand_product)->with('all_product_detail', $product_detail);
    }

    public function delete_to_cart($rowId){ 
        Cart::remove($rowId);
        return Redirect::to('/show-cart');

    }

    public function update_cart_quanlity(Request $request){
        $rowId1 = $request->rowId_cart;
        $qty1 = $request->cart_qty;
        Cart::update($rowId1,$qty1);
        return Redirect::to('/show-cart');
    }
}
