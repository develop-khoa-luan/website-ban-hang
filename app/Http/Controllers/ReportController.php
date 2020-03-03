<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Faker\Provider\cs_CZ\DateTime;
use Session;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
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

    public function reports()
    {
        return view('admin.reports');
    }

    public function reports_detail(Request $request)
    {
        $report_type = $request->report_type;
        $report_detail_1 = $request->report_detail_1;
        $report_detail_2 = $request->report_detail_2;
        $report_detail_3 = $request->report_detail_3;
        $report_detail_4 = $request->report_detail_4;
        $current_month = date('m');
        $current_year = date('Y');
        //margin reports
        if ($report_type == 'doanh-thu') {
            //per month
            if ($report_detail_1 == 'theo-thang') {
                $avg_earning_per_month = DB::table('tbl_order')
                    ->select(DB::raw('sum(order_total) as sum_total, MONTH(updated_at) as time'))
                    ->where('order_status', '=', 'Xác nhận thanh toán')->whereYear('updated_at', $current_year)
                    ->groupBy(DB::raw('YEAR(updated_at) ASC, MONTH(updated_at) ASC'))->get();
                return response()->json([
                    'data' => $avg_earning_per_month,
                    'status' => 'doanh-thu',
                    'message' => 'doanh-thu-thang'
                ]);
            }
            //per day
            if ($report_detail_1 == 'theo-ngay') {
                $avg_earning_per_day = DB::table('tbl_order')
                    ->select(DB::raw('sum(order_total) as sum_total, DAY(updated_at) as time'))
                    ->where('order_status', '=', 'Xác nhận thanh toán')->whereMonth('updated_at', $current_month)
                    ->groupBy(DB::raw('DAY(updated_at) ASC'))->get();
                return response()->json([
                    'data' => $avg_earning_per_day,
                    'status' => 'doanh-thu',
                    'message' => 'doanh-thu-ngay'
                ]);
            }
        }
        //customer report
        if ($report_type == 'khach-hang') {
            //per month
            if ($report_detail_1 == 'theo-thang') {
                $sum_customer_per_month = DB::table('tbl_customer')
                    ->select(DB::raw('count(customer_id) as sum_times, MONTH(created_at) as time'))
                    ->whereMonth('created_at', $current_month)->whereYear('created_at', $current_year)
                    ->groupBy(DB::raw('YEAR(created_at) ASC, MONTH(created_at) ASC'))->get();
                return response()->json([
                    'data' => $sum_customer_per_month,
                    'status' => 'khach-hang',
                    'message' => 'Khách hàng đăng kí theo năm'
                ]);
            }
            //per day
            if ($report_detail_1 == 'theo-ngay') {
                $sum_customer_per_day = DB::table('tbl_customer')
                    ->select(DB::raw('count(customer_id) as sum_times, DAY(created_at) as time'))
                    ->whereMonth('created_at', $current_month)
                    ->groupBy(DB::raw('DAY(created_at) ASC'))->get();
                return response()->json([
                    'data' => $sum_customer_per_day,
                    'status' => 'khach-hang',
                    'message' => 'Khách hàng đăng kí theo tháng'
                ]);
            }
        }
        //product report
        // SELECT
        //     COUNT(`tbl_order_detail`.`product_id`) AS COUNT,
        //     `tbl_product`.*
        // FROM
        //     `tbl_order_detail`
        // INNER JOIN `tbl_product` ON `tbl_product`.`product_id` = `tbl_order_detail`.`product_id`
        // WHERE
        //     `tbl_order_detail`.`created_at` > "2019-01-01 00:00:00" AND `tbl_order_detail`.`created_at` < "2019-12-31 00:00:00"
        // GROUP BY
        //     `tbl_order_detail`.`product_id`
        // ORDER BY
        //     `count`
        // DESC
        // LIMIT 10
        if ($report_type == 'san-pham') {
            $report_detail_3 = $report_detail_3 . ' 00:00:00';
            $report_detail_4 = $report_detail_4 . ' 00:00:00';
            //sản phẩm bán chạy
            if ($report_detail_1 == 'san-pham-ban-chay') {
                $top_product = DB::table('tbl_order_detail')
                    ->select(DB::raw('SUM(tbl_order_detail.product_sales_quantity) as count_product'), 'tbl_product.*')
                    ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_detail.product_id')
                    ->where('tbl_order_detail.created_at', '>=', $report_detail_3)->where('tbl_order_detail.created_at', '<=', $report_detail_4)
                    ->groupBy('tbl_order_detail.product_id')->orderBy('count_product', 'DESC')
                    ->take($report_detail_2)->get();
                return response()->json([
                    'data' => $top_product,
                    'status' => 'san-pham-ban-chay',
                    'message' => 'Sản phẩm '
                ]);
            }
            //sản phầm sắp hết hàng
            if ($report_detail_1 == 'san-pham-sap-het-hang') {
                $lack_product = DB::table('tbl_product_detail')
                    ->select(DB::raw('sum(tbl_product_detail.product_quantity) as count_quantity'), 'tbl_product.*')
                    ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_product_detail.product_id')
                    ->groupBy('tbl_product_detail.product_id')->orderBy('tbl_product.product_id', 'ASC')->get();
                $product_nearly_soldout = array();
                foreach ($lack_product as $key => $value) {
                    if($value->count_quantity<=$report_detail_2){
                        array_push($product_nearly_soldout, $value);
                    }
                }
                return response()->json([
                    'data' => $product_nearly_soldout,
                    'status' => 'san-pham-het-hang',
                    'message' => 'Khách hàng đăng kí theo tháng'
                ]);
            }
        }
        if ($report_type == 'hoa-don') {
            //per month
            if ($report_detail_1 == 'theo-thang') {
                $count_order = DB::table('tbl_order')
                    ->select(DB::raw('count(order_id) as sum_times, MONTH(updated_at) as time'))
                    ->whereYear('updated_at', $current_year)
                    ->groupBy(DB::raw('YEAR(updated_at) ASC, MONTH(updated_at) ASC'))->get();
                return response()->json([
                    'data' => $count_order,
                    'status' => 'hoa-don',
                    'message' => 'Thống kê hóa đơn trong năm'
                ]);
            }
            //per day
            if ($report_detail_1 == 'theo-ngay') {
                $count_order = DB::table('tbl_order')
                    ->select(DB::raw('count(order_total) as sum_times, DAY(updated_at) as time'))
                    ->whereMonth('updated_at', $current_month)
                    ->groupBy(DB::raw('DAY(updated_at) ASC'))->get();
                return response()->json([
                    'data' => $count_order,
                    'status' => 'hoa-don',
                    'message' => 'Thống kê hóa đơn trong tháng'
                ]);
            }
            }
    }
}
