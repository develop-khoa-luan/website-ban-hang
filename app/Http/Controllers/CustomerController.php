<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

use Cart;

class CustomerController extends Controller
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

    public function all_customer(){
        $this->AuthLogin();
        $all_customer = DB::table('tbl_customer')->get();

        $list_customer = view('admin.all_customer')->with('all_customer',$all_customer);
        return view('admin_layout')->with('admin.all_customer', $list_customer);
    }

    public function view_customer($customer_id){
        $this->AuthLogin();
        $view_each_customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->get();

        $all_order = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->select('tbl_order.*')
        ->where('tbl_customer.customer_id',$customer_id)
        ->orderby('tbl_order.order_id', 'asc')
        ->get();

        $manager_view_customer = view('admin.view_customer')->with('view_each_customer',$view_each_customer)->with('all_order', $all_order);
        return view('admin_layout')->with('admin.view_customer', $manager_view_customer);
    }

    public function view_customer_order_detail($order_id){
        $this->AuthLogin();
        $order_by_id_customer = DB::table('tbl_order')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->select('tbl_order.*', 'tbl_shipping.*')->where('order_id', $order_id)->first();
        
        $all_order_detail_view_customer = DB::table('tbl_order_detail')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
        ->where('order_id', $order_id)
        ->orderby('order_detail_id', 'asc')->select('tbl_order_detail.*')->get();

        $count_quantity_view_customer = DB::table('tbl_order_detail')->where('order_id', $order_id)->orderby('order_detail_id', 'asc')->sum('product_sales_quantity');

        $manager_order_by_id_customer = view('admin.view_customer_order_detail')->with('order_by_id_customer', $order_by_id_customer)
            ->with('all_order_detail_view_customer', $all_order_detail_view_customer)
            ->with('count_quantity_view_customer', $count_quantity_view_customer);
        return view('admin_layout')->with('admin.view_customer_order_detail', $manager_order_by_id_customer);

        // $manager_view_customer_order_detail = view('admin.view_customer_order_detail')->with('manager_order_by_id_customer',$manager_order_by_id_customer)->with('all_order_detail_view_customer', $all_order_detail_view_customer);
        // return view('admin_layout')->with('admin.view_customer_order_detail', $manager_view_customer_order_detail);
    }
}


    
