<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:menu', ['only' => ['index']]);
    // }
    public function index()
    {
        $menus = Menu::orderBy('order')->get();

        return view('menu', compact('menus'));
    }
}
