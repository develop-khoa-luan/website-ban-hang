<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


}
