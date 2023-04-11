<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\setMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class setMenuController extends Controller
{
    public function index()
    {
        $nombre = Auth::user()->id;
        $rol_id=$this->GetRole($nombre);
        $menus = Menu::join('menu','menu.menu_id', '=', 'menu_roles.menu_id')
                    ->orderBy('role_id')
                    ->where('role_id',$rol_id)
                    ->get();

        return view('setmenu', compact('menus'));
        // return $menus;
    }
    public function GetRole($nombre){
        $registros = DB::select("SELECT role_id 
        FROM permisosyroles.model_has_roles,users 
        where  model_id=id and model_id=".$nombre);
        $role_id=$registros[0]->role_id;
       return $role_id ;
    }

    public function listado_menu(){
        $registros = DB::select("SELECT menu_id, menu_rutas, title, 'menus' as acciones  from menu");
       return $registros ;
    }
    public function inserta_menu(Request $request){
        $menus = new setMenuModel();
        $menus->menu_rutas = $request->menu_rutasNuevo;
        // $menus->title = $request->get('titleNuevo');

        $menus->save();

        return response([ 'success' => true, 'menus'=>$menus]);
    }
}
