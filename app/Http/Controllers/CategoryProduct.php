<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
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

    public function add_category_product(){
        $this -> AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this -> AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
        $this -> AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công.');
        return Redirect::to('add-category-product');

    }

    public function unactive_category_product ($category_product_id){
        $this -> AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công.');
        return Redirect::to('all-category-product');
    }

    public function active_category_product ($category_product_id){
        $this -> AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công.');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this -> AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $this -> AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công.');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        $this -> AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công.');
        return Redirect::to('all-category-product');
    }

    // end Category Admin page

    public function show_category_home($category_id){

        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.category_id',$category_id)->orderBy('tbl_product.created_at', 'desc')->paginate(9);

        $category_by_id_cover = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.category_id',$category_id)->get();

        $category_by_id_1 = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->select('tbl_category_product.category_id')
        ->where('tbl_product.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        
        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $all_slide_cover = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();
        
        $selling_product = DB::table('tbl_order_detail')
         ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
         ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
         ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
         ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
         ->get();

        Session::put('category_by_id_1',$category_by_id_1);
        Session::put('category_by_id_cover',$category_by_id_cover);

        // Session::forget('category_by_id');

        // dd($all_slide);

        return view('pages.category.show_category')->with('all_slide', $all_slide)->with('selling_product', $selling_product)
        ->with('all_slide_cover', $all_slide_cover)->with('category', $cate_product)->with('brand', $brand_product)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name);    
    }
}
