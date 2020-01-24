<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

use Cart;

class ContactController extends Controller
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

    public function save_contact_info(Request $request){
        $data = array();
        $data['contact_name'] = $request->contact_name;
        $data['contact_email'] = $request->contact_email;
        $data['contact_subject'] = $request->contact_subject;
        $data['contact_message'] = $request->contact_message;
        DB::table('tbl_contact_info')->insert($data);
        Session::put('message','Gửi thông tin liên hệ thành công.');
        return Redirect::to('contact');

    }

    public function all_contact_info(){
        $this->AuthLogin();
        $all_contact_info = DB::table('tbl_contact_info')->get();
        $manager_contact = view('admin.all_contact_info')->with('all_contact_info',$all_contact_info);
        return view('admin_layout')->with('admin.all_contact_info', $manager_contact);       
    }
}
