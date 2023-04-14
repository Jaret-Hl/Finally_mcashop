<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function GetRole($nombre){
        $registros = DB::select("SELECT role_id 
        FROM mcash.model_has_roles,users 
        where  model_id=id and model_id=".$nombre);
        $role_id=$registros[0]->role_id;
       return $role_id ;
    }
    public function index()
    {
        $nombre = Auth::user()->id;
        $rol_id=$this->GetRole($nombre);
        $menus = Menu::join('menu','menu.menu_id', '=', 'menu_roles.menu_id')
                    ->orderBy('role_id')
                    ->where('role_id',$rol_id)
                    ->get();
        return view('home',compact('menus'));
    }
}
