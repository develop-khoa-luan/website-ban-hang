<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Cart;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index (){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();

        $cart_count = Cart::count();


        $all_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('tbl_product.updated_at', 'desc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_product_t = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('product_id', 'desc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_product_asc_t = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('product_id', 'asc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_product_desc_t = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('product_id', 'desc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        // $selling_product = DB::table('tbl_product')->join('tbl_order_detail','tbl_product.product_id','=','tbl_order_detail.product_id')
        // ->select('tbl_order_detail.product_name')->sum('tbl_order_detail.product_id')->groupBy('tbl_order_detail.product_name')
        // ->get();

         $selling_product = DB::table('tbl_order_detail')
         ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
         ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
         ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
         ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
         ->get();

        // dd($selling_product);
        // dd($all_product_asc_t);

        Session::put('all_product',$all_product);
        Session::put('all_product_t',$all_product_t);
        Session::put('all_product_asc_t',$all_product_asc_t);
        Session::put('all_product_desc_t',$all_product_desc_t);


        return view('pages.home')->with('all_slide', $all_slide)->with('selling_product', $selling_product)->with('category', $cate_product)->with('count_cart', $cart_count)->with('brand', $brand_product)->with('all_product', $all_product);
    }

    public function price_home_asc(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();

        $cart_count = Cart::count();


        $all_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('product_id', 'desc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_product_asc = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('product_price', 'asc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $selling_product = DB::table('tbl_order_detail')
         ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
         ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
         ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
         ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
         ->get();

        Session::put('all_product_asc',$all_product_asc);

        return view('pages.home_price_asc')->with('all_slide', $all_slide)->with('selling_product', $selling_product)->with('all_product_asc', $all_product_asc)->with('category', $cate_product)->with('count_cart', $cart_count)->with('brand', $brand_product)->with('all_product', $all_product);
    }

    public function price_home_desc(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();

        $cart_count = Cart::count();


        $all_product = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('product_id', 'desc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_product_desc = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('product_status', '1')->orderby('product_price', 'desc')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $selling_product = DB::table('tbl_order_detail')
         ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
         ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
         ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
         ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
         ->get();

        Session::put('all_product_desc',$all_product_desc);

        return view('pages.home_price_desc')->with('all_slide', $all_slide)->with('selling_product', $selling_product)->with('all_product_desc', $all_product_desc)->with('category', $cate_product)->with('count_cart', $cart_count)->with('brand', $brand_product)->with('all_product', $all_product);
    }


    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();
        $search_product = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->where('product_name', 'like', '%'.$keywords.'%')->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $selling_product = DB::table('tbl_order_detail')
         ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
         ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
         ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
         ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
         ->get();

        return view('pages.product.search')->with('category', $cate_product)->with('selling_product', $selling_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }

    public function contact(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();

        $cart_count = Cart::count();

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $selling_product = DB::table('tbl_order_detail')
         ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
         ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
         ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
         ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
         ->get();

        return view('pages.contact.contact')->with('all_slide', $all_slide)->with('selling_product', $selling_product)->with('category', $cate_product)->with('count_cart', $cart_count)->with('brand', $brand_product);
    }

}
