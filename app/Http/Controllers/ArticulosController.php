<?php

namespace App\Http\Controllers;

use App\Models\Articulos;
use App\Models\setMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticulosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Articulos', ['only' => ['index']]);
    }
    public function index()
    {
        $menus = setMenuModel::all();
        
        $articulos = Articulos::all();
        // return view('Articulos.index_articulos')->with('articulos',$articulos);  
        return view('Articulos.index_articulos',compact('articulos','menus'));
 
            
    }
    public function listado_articulos()
    {
        $registros = DB::select("SELECT art_id, art_codigofabricante, art_skuproveedor, art_claveproveedor, 
        art_descripcion, art_pro_id, art_marcafabricante, 'Articles' as acciones  from cat_articulos");
       return $registros ;
    }
    public function inserta_articulo(Request $request){
        //se insertan los datos en variable clientes 
        $articulos = new Articulos();
        $articulos->art_codigofabricante = $request->get('art_codigofabricanteNuevo');
        $articulos->art_skuproveedor = $request->get('art_skuproveedorNuevo');

        $articulos->save();

        return response([ 'success' => true, 'articulos'=>$articulos]);
    }

    public function edita_articulo(Request $request )    {
        $id = $request->get('art_id');
        $articulos = Articulos::find($id);
        return $articulos;
    }
    public function actualiza_articulo(Request $request)    {
        $id = $request->get('art_id');
        $articulos = Articulos::find($id);
        $articulos->art_codigofabricante = $request->get('art_codigofabricante');
        $articulos->save();
        
        return response([ 'success' => true, 'articulos'=>$articulos ]);
    }
}
