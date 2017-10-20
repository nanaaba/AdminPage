<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {

    public function showcustomers() {

        return view('customers');
    }

    public function showsystemusers() {

        return view('systemusers');
    }

}
