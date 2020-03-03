<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Size;

session_start();

class AdminController extends Controller
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

    public function index (){

        return view ('admin_login');
    }


    public function info_admin($admin_id){
        $this->AuthLogin();
        $info_admin = DB::table('tbl_admin')->where('admin_id',$admin_id)->first();
        // dd($get_info);
        $manager_info_admin = view('admin.get_info_admin')->with('info_admin',$info_admin);
        return view('admin_layout')->with('admin.get_info_admin', $manager_info_admin);
    }

    public function show_dashboard(){
        $this -> AuthLogin();
        $current_month = date('m');
        $current_year = date('Y');

        $earning_current_month = DB::table('tbl_order')->whereMonth('updated_at', $current_month)->whereYear('updated_at', $current_year)
        ->where('order_status', '=', 'Xác nhận thanh toán')->sum('order_total');
        //dd($earning_current_month);
        $avg_earning_per_month = DB::table('tbl_order')
        ->select(DB::raw('sum(order_total) as avg_total, MONTH(updated_at) as month'))
        ->where('order_status', '=', 'Xác nhận thanh toán')->whereYear('created_at', $current_year)
        ->groupBy(DB::raw('YEAR(updated_at) ASC, MONTH(updated_at) ASC'))->get();

        $sum_avg = 0;
        foreach ($avg_earning_per_month as $key => $value) {
            $sum_avg = $sum_avg + $value->avg_total;
        };
            $avg_earning = $sum_avg/12;
        $bills_current_month = DB::table('tbl_order')->whereMonth('created_at', $current_month)->whereYear('created_at', $current_year)
        ->count('order_id');

        $bills_pending = DB::table('tbl_order')->where('order_status', '=', 'Đang chờ xử lý')
        ->count('order_id');


        $admin_id = Session::get('admin_id');
        $info_admin = DB::table('tbl_admin')->where('admin_id',$admin_id)->first();

        // dd($info_admin);

        return view('admin.dashboard')->with('info_admin',$info_admin)->with('earning_current_month',$earning_current_month)->with('avg_earning', $avg_earning)
        ->with('avg_earning_per_month', $avg_earning_per_month)->with('bills_current_month', $bills_current_month)
        ->with('bills_pending', $bills_pending)->with("currentMonth", $current_month)->with("currentYear", $current_year);

    }

    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();

        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Username hoặc Password nhập sai. Vui lòng nhập lại');
            return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this -> AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
