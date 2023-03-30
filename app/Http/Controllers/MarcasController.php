<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Storage;

class MarcasController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Marcas', ['only' => ['index']]);
    }
    public function index()
    {
        $marcas = Marcas::all();
        return view('cat_marcas.index_marcas')->with('marcas',$marcas);      
    }
    public function listado_marcas()
    {
        $registros = DB::select("SELECT mar_id, mar_nombre, mar_estatus, mar_url, 
        mar_logotipo, mar_publicado, mar_urlbanner, 'MARCAS' as acciones  from cat_marcas");
       return $registros ;
    }

    public function inserta_marca(Request $request){
    }
    public function store(Request $request){

        $mar_urlbanner = $request->file('mar_urlbanner')->getClientOriginalName();
        $mar_public = $request->file('mar_urlbanner')->store('public/images');
        
        //OBTENCION DEL NOMBRE ORIGINAL DEL LOGOTIPO
        $mar_logotipo = $request->file('mar_logotipo')->getClientOriginalName();
        //RUTA DONDE SE GUARDARA EL LOGOTIPO
        $mar_publicado = $request->file('mar_logotipo')->store('public/images');
        //CREA UN ACCESO DIRECTO PARA OBTENER LA RUTA STORAGE EN EL DATATABLE
        $urlpublic = Storage::url($mar_public);
        $url = Storage::url($mar_publicado);
        //OBTENCION DE LOS DATOS DEL FORMULARIO
        $mar_nombre = $request -> get('mar_nombre');
        $mar_url = $request -> get('mar_url');
        //SE GUARDAN LOS DATOS EN LA BASE DE DATOS
        $save = new Marcas();
        $save->mar_nombre= $mar_nombre;
        $save->mar_url= $mar_url;
        $save-> mar_urlbanner = 'Banner'.$mar_urlbanner;
        $save->mar_public = $urlpublic;
        $save->mar_estatus = 'NORMAL';
        $save->mar_logotipo = 'Logotipo'.$mar_logotipo;
        $save->mar_publicado = $url;
        $save->save();
        return response()->json($url && $urlpublic);
    }

    public function edita_marca(Request $request )    {
        $id = $request->get('mar_id');
        $proveedores = Marcas::find($id);
        return $proveedores;
    }

    public function actualiza_marca(Request $request){
        $id = $request->get('mar_id');
        $marcas = Marcas::find($id);
        $marcas->mar_nombre = $request->mar_nombre;
        $marcas->mar_url = $request->mar_url;
        $marcas->mar_logotipo = $request->mar_logotipo;
        $marcas->save();
        
        return response([ 'success' => true, 'marcas'=>$marcas ]);
    }
    public function marca_show($id){
        
        $marcashow = Marcas::find($id);
        return view('cat_marcas.marca_show', compact('marcashow'));
    }
}
