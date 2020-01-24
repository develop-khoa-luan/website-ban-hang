<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Session;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Size;

session_start();

class AprioriController extends Controller
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

    public function run_apriori (){
         $this->AuthLogin();
         $all_order = DB::table('tbl_order')->select('order_id')->get();//lấy hết order lên
         $list_itemset = array();
         $all_itemsets = array();
         $string_list = "";
         foreach ($all_order as $key => $value) {//loop order để lấy các order detail
            $all_order_detail = DB::table('tbl_order_detail')->select('product_id')
            ->where('order_id', $value->order_id)->orderBy('product_id', 'asc')->get('product_id');
            $string_list = ""; //nối các giá trị thành 1 string dạng (2, 3, 4, 5)
            $last_string = "";//không lấy giá trị bị trùng, vd(2,2,2)-> (2)
            foreach ($all_order_detail as $key => $value) {//nối các product id thành 1 string
                if($last_string != $value->product_id){
                    if($string_list == ""){
                        $string_list = $value->product_id;
                    }else{
                        $string_list = $string_list . ", ". $value->product_id;
                    }
                    $last_string = $value->product_id;
                }else{
                break;
                }
            }
            array_push($all_itemsets, $string_list);
        }
        foreach ($all_itemsets as $key => $value) {//không lấy các giá trị chỉ có một tham số
            if(strstr($value, ',')){
                array_push($list_itemset, $value);
            }
        }
        return view ('admin.run_apriori')->with('itemsets', $list_itemset);
    }

    public function save_apriori(Request $request){
        $data_apriori = $request->data_apriori;
        $decode_json = 0;
        DB::table('tbl_data_apriori')->delete();
         foreach ($data_apriori as $key => $data) {
             $decode_json = json_decode($data, true);
             Log::info($decode_json);
             DB::table('tbl_data_apriori')->insert($decode_json);
         }
        return $data_apriori;
    }
    
    public function apriori (){
        $this->AuthLogin();
        $all_data_apriori = DB::table('tbl_data_apriori')->get();
        $all_product = DB::table('tbl_product')->get();
        foreach ($all_data_apriori as $key => $value) {
            if($value->product_1 == 0){
                $value->product_1 = "";
            }
            if($value->product_2 == 0){
                $value->product_2 = "";
            }
            if($value->product_3 == 0){
                $value->product_3 = "";
            }
            if($value->product_4 == 0){
                $value->product_4 = "";
            }
            if($value->recommend_1 == 0){
                $value->recommend_1 = "";
            }
            if($value->recommend_2 == 0){
                $value->recommend_2 = "";
            }
            if($value->recommend_3 == 0){
                $value->recommend_3 = "";
            }
            if($value->recommend_4 == 0){
                $value->recommend_4 = "";
            }
        }
        foreach ($all_product as $key => $product) {
            foreach ($all_data_apriori as $key => $value) {
                if($product->product_id == $value->product_1){
                    $value->product_1 = '['.$product->product_name.']';
                }
                if($product->product_id == $value->product_2){  
                    $value->product_2 = ', ['.$product->product_name.']';
                }
                if($product->product_id == $value->product_3){
                    $value->product_3 = ', ['.$product->product_name.']';
                }
                if($product->product_id == $value->product_4){
                    $value->product_4 = ', ['.$product->product_name.']';
                }
                if($product->product_id == $value->recommend_1){
                    $value->recommend_1 = '['.$product->product_name.']';
                }
                if($product->product_id == $value->recommend_2){
                    $value->recommend_2 = ', ['.$product->product_name.']';
                }
                if($product->product_id == $value->recommend_3){
                    $value->recommend_3 = ', ['.$product->product_name.']';
                }
                if($product->product_id == $value->recommend_4){
                    $value->recommend_4 = ', ['.$product->product_name.']';
                }
            }
        }
       return view ('admin.apriori')->with('data_apriori', $all_data_apriori);
   }

}
