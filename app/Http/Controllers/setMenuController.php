<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class setMenuController extends Controller
{
    public function index()
    {
        $nombre = Auth::user()->id;
        $rol_id=$this->GetRole($nombre);
        // $menus = Menu::orderBy('order')->Role($rol_id)->get();

        // return view('setmenu', compact('menus'));
        return $rol_id;
    }
    public function GetRole($nombre){
        $registros = DB::select("SELECT role_id 
        FROM permisosyroles.model_has_roles,users 
        where  model_id=id and model_id=".$nombre);
       return $registros ;
    }
}
