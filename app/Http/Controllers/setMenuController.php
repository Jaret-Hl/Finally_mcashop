<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\setMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    public function index_menu_roles()
    {
        $menu_roles = Menu::all();
        // return view('set_menu.index')->with('menu_roles',$menu_roles); 
        return view('set_menu.index', compact('menu_roles'));

    }
    
    public function GetRole($nombre){
        $registros = DB::select("SELECT role_id 
        FROM mcash.model_has_roles,users 
        where  model_id=id and model_id=".$nombre);
        $role_id=$registros[0]->role_id;
       return $role_id ;
    }

    public function listado_menu_roles(){
        $registros = DB::select("SELECT menu_roles_ID, menu_id, role_id, 'menu_roles' as acciones  from menu_roles");
       return $registros ;
    }
    public function inserta_menu_roles(Request $request){
        
        $menus_roles = new Menu();

        $menus_roles->role_id = $request->get('rolIDNuevo');
        $menus_roles->menu_id = $request->get('menuIDNuevo');

        $menus_roles->save();

        return response([ 'success' => true, 'menus_roles'=>$menus_roles]);
    }

    public function edita_menu_roles(Request $request){
        $id = $request->get('menu_roles_ID');
        $menus = Menu::find($id);
        return $menus;
    }
    public function actualiza_menu_roles(Request $request)    {
        $id = $request->get('menu_roles_ID');
        $menus_roles = Menu::find($id);
        $menus_roles->role_id = $request->get('role_id');
        $menus_roles->menu_id= $request->get('menu_id');
        $menus_roles->save();
        
        return response([ 'success' => true, 'menus_roles'=>$menus_roles ]);
    }
}
