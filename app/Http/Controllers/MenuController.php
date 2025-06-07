<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function submenu1(Request $request)
    {
        return view('menu.submenu1');
    }
    public function submenu1_1(Request $request)
    {
        return view('menu.submenu1_1');
    }
}
