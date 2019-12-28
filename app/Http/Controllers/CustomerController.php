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

    public function Custommer_Login(){
        $customer_id = Session::get('customer_id');
        if($customer_id){
            return Redirect::to('/trang-chu');
        }
        else{
            return Redirect::to('/login-checkout')->send();
        }
    }

    public function customer_management(){
        $this->Custommer_Login();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();
        $selling_product = DB::table('tbl_order_detail')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
        ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
        ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
        ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
        ->get();

        $customer_id = Session::get('customer_id');
        $view_customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->select('tbl_order.*')
        ->where('tbl_customer.customer_id',$customer_id)
        ->orderby('tbl_order.updated_at', 'desc')
        ->limit(10)->get();

        return view('pages.checkout.customer_management')->with('view_customer',$view_customer)->with('all_order', $all_order)
        ->with('category', $cate_product)->with('brand', $brand_product)->with('selling_product', $selling_product);
    }

    public function cus_view_order(Request $request)
    {
        $this->Custommer_Login();
        $order_id = $request->order_id;
        $customer_id = Session::get('customer_id');
        
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*')->where('order_id', $order_id)
            ->where('tbl_order.customer_id', $customer_id)->first();
            
        $all_order_detail = DB::table('tbl_order_detail')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
        ->where('order_id', $order_id)
        ->orderby('order_detail_id', 'asc')->select('tbl_order_detail.*','tbl_product.product_image')->get();

        $count_quantity = DB::table('tbl_order_detail')->where('order_id', $order_id)->orderby('order_detail_id', 'asc')->sum('product_sales_quantity');
        
        return response()->json([
            'order_by_id' => $order_by_id,
            'order_detail' => $all_order_detail,
            'count_quantity' => $count_quantity
        ]);
    }

    public function update_customer(Request $request){
        $this->Custommer_Login();
        $customer_id = Session::get('customer_id');

        $customer_email = $request->customer_email;
        $customer_name = $request->customer_name;
        $customer_phone = $request->customer_phone;
        $change_password = $request->change_password;
        $customer_ex_password = md5($request->customer_ex_password);
        $customer_new_password = $request->customer_new_password;

        $customer_detail = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
        if($change_password == 'yes'){
            if($customer_ex_password == $customer_detail->customer_password){
                $data_1 = array();
                $data_1['customer_name'] = $customer_name;
                $data_1['customer_phone'] = $customer_phone;
                $data_1['customer_password'] = md5($customer_new_password);
                DB::table('tbl_customer')->where('customer_id', $customer_id)->update($data_1);
                $request->session()->put('message_change_detail_customer', "Cập nhập thông tin và mật khẩu thành công!");
                return "Cập nhập thông tin và mật khẩu thành công!";
            }else{
                $request->session()->put('message_change_detail_customer', "Mật khẩu hiện tại không đúng!");
                return "Mật khẩu hiện tại không đúng!";
            }
        }elseif($change_password=='no'){
            $data_2 = array();
            $data_2['customer_name'] = $customer_name;
            $data_2['customer_phone'] = $customer_phone;
            DB::table('tbl_customer')->where('customer_id', $customer_id)->update($data_2);
            $request->session()->put('message_change_detail_customer', "Cập nhập thông tin thành công!");
            return "Cập nhập thông tin thành công!";
        }else{
            $request->session()->put('message_change_detail_customer', "Thay đổi không thành công!");
            return "Thay đổi không thành công!";
        }
    }

    function cus_delete_order($order_id, Request $request){
        $customer_id = Session::get('customer_id');
        $data = array();
        $data['order_status'] = 'Hủy đơn hàng';
        DB::table('tbl_order')->where('order_id', $order_id)->where('customer_id', $customer_id)->update($data);
        $request->session()->put('message_change_detail_customer', 'Hủy đơn hàng HD'.$order_id.' thành công!');
        return Redirect::to('customer-management');
    }

}


    
