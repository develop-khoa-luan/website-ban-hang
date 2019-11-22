<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;

session_start();

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();

        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();

        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes'] = $request->shipping_notes;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }

    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/trang-chu');
    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }
    public function order_place(Request $request)
    {
        //get payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //Insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //Insert order_detail
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_detail_data = array();
            $order_detail_data['order_id'] = $order_id;
            $order_detail_data['product_id'] = $v_content->id;
            $order_detail_data['product_name'] = $v_content->name;
            $order_detail_data['product_price'] = $v_content->price;
            $order_detail_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_detail')->insert($order_detail_data);
        }

        if ($data['payment_method'] == 1) {
            $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
        } elseif ($data['payment_method'] == 2) {
            $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
        } else {
            $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
        }
    }
    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name')
            ->orderby('tbl_order.order_id', 'desc')
            ->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.all_product', $manager_order);
    }

    public function view_order($order_id)
    {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*')->where('order_id', $order_id)->first();
            
        $all_order_detail = DB::table('tbl_order_detail')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
        ->where('order_id', $order_id)->orderby('order_detail_id', 'asc')->select('tbl_order_detail.*', 'tbl_product.product_quantity')->get();

        $count_quantity = DB::table('tbl_order_detail')->where('order_id', $order_id)->orderby('order_detail_id', 'asc')->sum('product_sales_quantity');

        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id)
            ->with('order_detail', $all_order_detail)
            ->with('count_quantity', $count_quantity);
        return view('admin_layout')->with('admin.view_product', $manager_order_by_id);
    }
    public function update_order(Request $request, $order_id)
    {
        //dd($order_id);
        $this->AuthLogin();
        $get_order = DB::table('tbl_order')->where('order_id', $order_id)->first();
        $get_status = $get_order->order_status;
        $status = $request->order_status;
        $get_order_detail = DB::table('tbl_order_detail')->where('order_id', $order_id)->orderby('order_detail_id', 'asc')->get();
        switch ($get_status) {
            case "Đang chờ xử lý":
                switch ($status) {
                    case "Đang chờ xử lý":
                        Session::put('message', 'Cập nhập không thành công do đơn hàng đang ở trạng thái "Đang chờ xử lý"!');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    case "Xác nhận đơn hàng":
                        $data = array();
                        $data['order_status'] = $request->order_status;
                        foreach ($get_order_detail as $order_datail) {
                            DB::table('tbl_product')->where('product_id', $order_datail->product_id)->decrement('product_quantity', $order_datail->product_sales_quantity);
                        }
                        DB::table('tbl_order')->where('order_id', $order_id)->update($data);
                        Session::put('message', 'Cập nhật đơn hàng thành công! Đang chờ xử lý->Xác nhận đơn hàng');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    case "Xác nhận thanh toán":
                        $data = array();
                        $data['order_status'] = $request->order_status;
                        foreach ($get_order_detail as $order_datail) {
                            DB::table('tbl_product')->where('product_id', $order_datail->product_id)->decrement('product_quantity', $order_datail->product_sales_quantity);
                        }
                        DB::table('tbl_order')->where('order_id', $order_id)->update($data);
                        Session::put('message', 'Cập nhật đơn hàng thành công! Đang chờ xử lý->Xác nhận thanh toán');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    case "Hủy đơn hàng":
                        $data = array();
                        $data['order_status'] = $request->order_status;
                        DB::table('tbl_order')->where('order_id', $order_id)->update($data);
                        Session::put('message', 'Hủy đơn hàng thành công.');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    default:
                        Session::put('message', 'Hủy đơn hàng không thành công.');
                        return Redirect::to('/view-order/' . $order_id);
                }
                break;
            case "Xác nhận đơn hàng":
                switch ($status) {
                    case "Đang chờ xử lý":
                        $data = array();
                        $data['order_status'] = $request->order_status;
                        foreach ($get_order_detail as $order_datail) {
                            DB::table('tbl_product')->where('product_id', $order_datail->product_id)->increment('product_quantity', $order_datail->product_sales_quantity);
                        }
                        DB::table('tbl_order')->where('order_id', $order_id)->update($data);
                        Session::put('message', 'Cập nhật đơn hàng thành công! Xác nhận đơn hàng->Đang chờ xử lý');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    case "Xác nhận đơn hàng":
                        Session::put('message', 'Cập nhập không thành công do đơn hàng đang ở trạng thái "Xác nhận đơn hàng"!');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    case "Xác nhận thanh toán":
                        $data = array();
                        $data['order_status'] = $request->order_status;
                        DB::table('tbl_order')->where('order_id', $order_id)->update($data);
                        Session::put('message', 'Cập nhật đơn hàng thành công! Xác nhận đơn hàng->Xác nhận thanh toán');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    case "Hủy đơn hàng":
                        $data = array();
                        $data['order_status'] = $request->order_status;
                        foreach ($get_order_detail as $order_datail) {
                            DB::table('tbl_product')->where('product_id', $order_datail->product_id)->increment('product_quantity', $order_datail->product_sales_quantity);
                        }
                        DB::table('tbl_order')->where('order_id', $order_id)->update($data);
                        Session::put('message', 'Cập nhật đơn hàng thành công! Xác nhận đơn hàng->Hủy đơn hàng');
                        return Redirect::to('/view-order/' . $order_id);
                        break;
                    default:
                        Session::put('message', 'Hủy đơn hàng không thành công.');
                        return Redirect::to('/view-order/' . $order_id);
                }
                break;
            case "Xác nhận thanh toán":
                Session::put('message', 'Cập nhập không thành công do đơn hàng đã được thanh toán!');
                return Redirect::to('/view-order/' . $order_id);
                break;
            case "Hủy đơn hàng":
                Session::put('message', 'Cập nhập không thành công do đơn hàng đã bị hủy!');
                return Redirect::to('/view-order/' . $order_id);
                break;
            default:
                Session::put('message', 'Cập nhập không thành công!');
                return Redirect::to('/view-order/' . $order_id);
        }
    }

    // delete order
    public function delete_order($order_id)
    {
        $this->AuthLogin();
        DB::table('tbl_order')->where('order_id', $order_id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công.');
        return Redirect::to('manage-order');
    }
}
