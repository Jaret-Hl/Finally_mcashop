<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class setMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->get();

        return view('setmenu', compact('menus'));
    }
}
