<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cart;

class APIController extends Controller
{
    function count_cart(){
        $count_cart = Cart::content()->count();
        return response()->json(['count_cart'=>$count_cart]);
    }
}
