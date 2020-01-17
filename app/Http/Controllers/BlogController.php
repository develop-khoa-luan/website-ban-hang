<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BlogController extends Controller
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

    public function all_blog(){
        $this->AuthLogin();
        $all_blog = DB::table('tbl_blogs')->join('tbl_admin','tbl_blogs.author_id','=','tbl_admin.admin_id')
        ->select('tbl_blogs.*', 'tbl_admin.admin_name')->get();
        return view('admin.all_blog')->with('all_blog', $all_blog);
    }

    public function get_add_blog(){
        $this->AuthLogin();
        return view('admin.add_blog');
    }

    public function post_add_blog(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['title'] = $request->title;
        $data['alias'] = $request->alias;
        $data['featured_image'] = $request->featured_image;
        $data['content'] = $request->content;
        $data['status'] = $request->status;
        $data['category'] = "null";
        $data['blog_like_count'] = "0";
        $data['blog_dislike_count'] = "0";
        $data['blog_comment_count'] = "0";
        $data['author_id'] = Session::get('admin_id');
        $blog_id = DB::table('tbl_blogs')->insertGetId($data);
        Session::put('message', 'Thêm sản phẩm thành công.');
        return Redirect::to('add-blog');
    }

    public function get_edit_blog_detail($blog_id){
        $this->AuthLogin();
        $get_blog_detail = DB::table('tbl_blogs')->where('id', $blog_id)->first();
        return view('admin.edit_blog')->with('blog_detail', $get_blog_detail);
    }

    public function post_edit_blog_detail(Request $request, $blog_id){
        $this->AuthLogin();
        $data = array();
        $data = array();
        $data['title'] = $request->title;
        $data['alias'] = $request->alias;
        $data['featured_image'] = $request->featured_image;
        $data['content'] = $request->content;
        $data['status'] = $request->status;
        $data['author_id'] = Session::get('admin_id');
        DB::table('tbl_blogs')->where('id', $blog_id)->update($data);
        return Redirect::to('all-blog');
    }


    public function delete_blog($blog_id)
    {
        $this->AuthLogin();
        DB::table('tbl_blogs')->where('id', $blog_id)->delete();
        Session::put('message', 'Xóa bản tin thành công.');
        return Redirect::to('all-blog');
    }

    public function unactive_blog($blog_id)
    {
        $this->AuthLogin();
        DB::table('tbl_blogs')->where('id', $blog_id)->update(['status' => 0]);
        Session::put('message', 'Ẩn bản tin thành công.');
        return Redirect::to('all-blog');
    }

    public function active_blog($blog_id)
    {
        $this->AuthLogin();
        DB::table('tbl_blogs')->where('id', $blog_id)->update(['status' => 1]);
        Session::put('message', 'Hiển thị bản tin thành công.');
        return Redirect::to('all-blog');
    }

    public function blogs(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();
        $all_blog = DB::table('tbl_blogs')->join('tbl_admin','tbl_blogs.author_id','=','tbl_admin.admin_id')
        ->select('tbl_blogs.*', 'tbl_admin.admin_name')->where('status', 1)
        ->orderBy('updated_at', 'DESC')->get();

        $all_slide = DB::table('tbl_slide')->where('tbl_slide.slide_status', '1')->get();

        $selling_product = DB::table('tbl_order_detail')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
        ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
        ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
        ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
        ->get();

        return view('pages.blog.blog')->with('all_slide', $all_slide)->with('selling_product', $selling_product)->with('category', $cate_product)->with('brand', $brand_product)
        ->with('all_blog', $all_blog);
    }

    public function blog_detail($blog_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_name', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_name', 'asc')->get();
        $blog = DB::table('tbl_blogs')->join('tbl_admin','tbl_blogs.author_id','=','tbl_admin.admin_id')
        ->select('tbl_blogs.*', 'tbl_admin.admin_name')->where('id', $blog_id)->first();
        $selling_product = DB::table('tbl_order_detail')
        ->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')
        ->groupBy('tbl_order_detail.product_name')->orderby('sum_a','desc')
        ->select('tbl_order_detail.product_name','tbl_product.product_price','tbl_product.product_image','tbl_product.product_id')
        ->selectRaw('COUNT(tbl_order_detail.product_id) AS sum_a')->limit(3)
        ->get();
        return view('pages.blog.blog_detail')->with('selling_product', $selling_product)->with('category', $cate_product)->with('brand', $brand_product)
        ->with('blog', $blog);
    }
}
