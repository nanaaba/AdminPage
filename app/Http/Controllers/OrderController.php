<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller {

    public function showpending() {

        return view('pending');
    }
    
     public function showshipped() {

        return view('shipped');
    }
    
     public function showprocessed() {

        return view('processed');
    }
    
     public function showdeleivered() {

        return view('deleivered');
    }

}
