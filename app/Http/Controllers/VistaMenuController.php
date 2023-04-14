<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VistaMenuController extends Controller
{
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
        FROM permisosyroles.model_has_roles,users 
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
