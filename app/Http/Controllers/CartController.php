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

    public function SelectionSortAscending($mang)
    {
        // Đếm tổng số phần tử của mảng
        $sophantu = count($mang);
    
        // Lặp để sắp xếp
        for ($i = 0; $i < $sophantu - 1; $i++)
        {
            // Tìm vị trí phần tử nhỏ nhất
            $min = $i;
            for ($j = $i + 1; $j < $sophantu; $j++){
                if ($mang[$j] < $mang[$min]){
                    $min = $j;
                }
            }
    
            // Sau khi có vị trí nhỏ nhất thì hoán vị
            // với vị trí thứ $i
            $temp = $mang[$i];
            $mang[$i] = $mang[$min];
            $mang[$min] = $temp;
        }
    
        // Trả về mảng đã sắp xếp
        return $mang;
    }

    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();

        $get_cart = Cart::content();

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $selling_product = DB::table('tbl_order_detail')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
        ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
        ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
        ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
        ->get();

        $product_detail = array();
        $product_order_id = array();
        foreach($get_cart as $cart){
            $get_product_detail = DB::table('tbl_product_detail')->where('product_id', $cart->id)->get();
            array_push($product_detail, $get_product_detail);
            array_push($product_order_id, $cart->id);
        }

        $product_order_id_asc = $this->SelectionSortAscending($product_order_id);


        $product_1 = 0;
        $product_2 = 0;
        $product_3 = 0;
        $product_4 = 0;

        foreach ($product_order_id_asc as $key => $value) {
            switch ($key) {
                case 0:
                    $product_1 = $value;
                    break;
                case 1:
                    $product_2 = $value;
                    break;
                case 2:
                    $product_3 = $value;
                    break;
                case 3:
                    $product_4 = $value;
                    break;
                default:
                    break;
            }
        }

        $recommend_products = [];
        $list_string_id = '';

        $get_apriori_data = DB::table('tbl_data_apriori')->where('product_1', $product_1)
        ->where('product_2', $product_2)->where('product_3', $product_3)->where('product_4', $product_4)
        ->where('recommend_2', 0)->orderBy('recommend_1', 'desc')->get();
        
        foreach ($get_apriori_data as $key => $value) {
            $list_string_id = $list_string_id.$value->recommend_1.',';
        }
        $list_id = explode(',', $list_string_id);

        $recommend_products = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->whereIn('tbl_product.product_id', $list_id)->orderBy('tbl_product.created_at', 'desc')->paginate(3);;

        return view('pages.cart.show_cart')->with('all_slide', $all_slide)->with('selling_product', $selling_product)
        ->with('category', $cate_product)->with('brand', $brand_product)
        ->with('all_product_detail', $product_detail)->with('related_product', $recommend_products);
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
