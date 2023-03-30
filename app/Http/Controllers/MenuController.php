<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:menu', ['only' => ['index']]);
    // }
    public function index()
    {
        $menu = Menu::all();
        return view('menu.index_menu')->with('menu',$menu);      
    }
    public function listado_menu()
    {
        $registros = DB::select("SELECT menu_id, menu_rutas, 
        'menus' as acciones  from menu");
       return $registros ;
    }
    public function inserta_menu(Request $request){
        //se insertan los datos en variable clientes 
        $Menu = new Menu();
        $Menu->menu_rutas = $request->get('menu_rutas');

        $Menu->save();

        return response([ 'success' => true, 'Menu'=>$Menu]);
    }

    public function edita_menu(Request $request )    {
        $id = $request->get('menu_id');
        $Menu = Menu::find($id);
        return $Menu;
    }
    public function actualiza_menu(Request $request)    {
        $id = $request->get('menu_id');
        $Menu = Menu::find($id);
        $Menu->menu_ruta = $request->get('menu_rutas');
        $Menu->save();
        
        return response([ 'success' => true, 'Menu'=>$Menu ]);
    }
}