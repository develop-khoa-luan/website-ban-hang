<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
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

    public function apriori (){
         $all_order = DB::table('tbl_order')->select('order_id')->get();//lấy hết order lên
         $list_itemset = array();
         $all_itemsets = array();
         $string_list = "";
         foreach ($all_order as $key => $value) {//loop order để lấy các order detail
            $all_order_detail = DB::table('tbl_order_detail')->select('product_id')
            ->where('order_id', $value->order_id)->orderBy('product_id')->get('product_id');
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
            if(strlen($value)>1){
                array_push($list_itemset, $value);
            }
        }
        //dd($list_itemset);
        return view ('admin.apriori')->with('itemsets', $list_itemset);
    }
}
