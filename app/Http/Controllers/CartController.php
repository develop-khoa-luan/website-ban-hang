<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
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

    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();

        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
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
