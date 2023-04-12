<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\setMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:menu', ['only' => ['index']]);
    // }
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

        return view('menu', compact('menus'));
        // return $menus;
    }
    public function listado_menu(){
        $registros = DB::select("SELECT menu_id, menu_rutas, title, 'menus' as acciones  from menu");
       return $registros ;
    }
    public function inserta_menu(Request $request){
        $validator = Validator::make($request->all(), [
            'menu_rutas' => 'required|unique:menu',
            'title' => 'required|unique:menu',
        ]);
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
        $menus = new setMenuModel();

        $menus->menu_rutas  = $request->menu_rutas;
        $menus->title  = $request->title;
        
        $menus->save();

        return response([ 'success' => true, 'menus'=>$menus]);
    }

    public function edita_menu(Request $request){
        $id = $request->get('menu_id');
        $menus = setMenuModel::find($id);
        return $menus;
    }
    public function actualiza_menu(Request $request)    {
        $id = $request->get('menu_id');
        $menus = setMenuModel::find($id);
        $menus->menu_rutas = $request->get('menu_rutas');
        $menus->title = $request->get('title');
        $menus->save();
        
        return response([ 'success' => true, 'menus'=>$menus ]);
    }
}
