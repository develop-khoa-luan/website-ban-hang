<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Size;

session_start();

class ProductController extends Controller
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

    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_name', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_name', 'asc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->orderby('tbl_product.product_id', 'desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->new_image;
        $product_id = DB::table('tbl_product')->insertGetId($data);
        $count_product_detail = $request->count_product_detail;
        if ($count_product_detail > 0) {
            for ($i = 1; $i <= $count_product_detail; $i++) {
                $product_detail_data = array();
                $product_size = "product_size_" . $i;
                $product_quantity = "product_quantity_" . $i;
                $product_detail_data['product_id'] = $product_id;
                $product_detail_data['product_size'] = $request->$product_size;
                $product_detail_data['product_quantity'] = $request->$product_quantity;
                DB::table('tbl_product_detail')->insert($product_detail_data);
            }
        }
        Session::put('message', 'Thêm sản phẩm thành công.');
        return Redirect::to('add-product');
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Hiển thị sản phẩm thành công.');
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Không hiển thị sản phẩm thành công.');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_name', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_name', 'asc')->get();
        $all_product_detail = DB::table('tbl_product_detail')->where('product_id', $product_id)->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $count_detail = count($all_product_detail);
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product)->with('all_product_detail', $all_product_detail)->with('count_detail', $count_detail);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_image'] = $request->new_image;
        $data['product_status'] = $request->product_status;
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        $count_product_detail = $request->count_product_detail;
        DB::table('tbl_product_detail')->where('product_id', $product_id)->delete();
        for ($i = 1; $i <= $count_product_detail; $i++) {
            $product_detail_data = array();
            $product_size = "product_size_" . $i;
            $product_quantity = "product_quantity_" . $i;
            $product_detail_data['product_id'] = $product_id;
            $product_detail_data['product_size'] = $request->$product_size;
            $product_detail_data['product_quantity'] = $request->$product_quantity;
            DB::table('tbl_product_detail')->insert($product_detail_data);
        }
        Session::put('message', 'Cập nhật sản phẩm thành công.');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        DB::table('tbl_product_detail')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công.');
        return Redirect::to('all-product');
    }

    // end Admin Management


    public function details_product($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();

        $all_product_detail = DB::table('tbl_product_detail')->where('product_id', $product_id)->get();

        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.product_id', $product_id)->get();

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }
        //get recommend from apriori data

        //attributes
        $recommend_products = [];
        $list_string_id = '';

        $get_apriori_data = DB::table('tbl_data_apriori')->where('product_1', $product_id)->where('product_2', 0)
        ->where('recommend_2', 0)->orderBy('recommend_1', 'desc')->get();

        foreach ($get_apriori_data as $key => $value) {
            $list_string_id = $list_string_id.$value->recommend_1.',';
        }
        $list_id = explode(',', $list_string_id);

        $recommend_products = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->whereIn('tbl_product.product_id', $list_id)->where('tbl_product.product_status', 1)->orderBy('tbl_product.created_at', 'desc')->paginate(3);

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $selling_product = DB::table('tbl_order_detail')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
        ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
        ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
        ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
        ->get();

        Session::put('all_product_detail',$all_product_detail);

        return view('pages.product.show_details')->with('all_slide', $all_slide)->with('selling_product', $selling_product)->with('category', $cate_product)->with('brand', $brand_product)->with('details_product', $details_product)
        ->with('related_product', $recommend_products)->with("all_product_detail", $all_product_detail);
    }
}
