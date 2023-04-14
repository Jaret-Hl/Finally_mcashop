<?php

namespace App\Http\Controllers;

use App\Models\catalogo_direccion_proveedores;
use App\Models\catalogo_proveedores;
use App\Models\setMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use Validator;

class catalogo_proveedoresController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Proveedores', ['only' => ['index_prov']]);
    }
    public function index_prov()
    {
        $menus = setMenuModel::all();
        $proveedores = catalogo_proveedores::all();
        return view('catalogo_proveedores.index_prov',compact('proveedores','menus'));
 
    }
    public function listado_proveedores()
    {
        $registros = DB::select("SELECT pro_id, pro_razon_social, pro_contacto, pro_rfc, pro_sitioweb,
        pro_estatus, pro_email, pro_fechaalta, 'PROVS' as acciones  from cat_proveedores");
       return $registros ;
    }

    
public function valida_nuevo_proveedor(){
    
}
    public function inserta_nuevo_proveedor(Request $request)    {
        $validator = Validator::make($request->all(), [
            'procontacto' => 'alpha:ascii|min:3|max:10',
            'prorazonsocial'=> 'required|min:6|max:20',
            'prorfc'=> 'required|min:0|max:6',
            'prositioweb'=> 'required|min:6|max:255',
            'proemail' => 'required|email',
            'profechaalta'=> 'required',
            'procreditodias'=> 'required|max:2',
            'procreditomonto'=> 'required|min:2|max:9',
            'prodiasvencimiento' => 'required|min:1|max:2',
            'prosubtipo'=> 'required',
            // //datos direccion
            'prodircalle'=>'alpha:ascii',
            'prodirnumint'=>'required|string',
            'prodirnumext'=>'required',
            'prodircolonia'=>'required',
            'prodirmunicipio'=>'required',
            'prodirestado'=>'required|alpha:ascii',
            'prodirpais'=>'required|alpha:ascii',
            'prodircodigopostal'=>'required|max:5',

        ]);
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
    //     //se insertan los datos en variable proveedores 
        $proveedores = new catalogo_proveedores();
        $proveedores->pro_contacto = $request->procontacto;
        $proveedores->pro_razon_social = $request->prorazonsocial;
        $proveedores->pro_rfc = $request->prorfc;
        $proveedores->pro_sitioweb = $request->prositioweb;
        $proveedores->pro_email = $request->proemail;
        $proveedores->pro_fechaalta = $request->profechaalta;
        $proveedores->pro_creditodias = $request->procreditodias;
        $proveedores->pro_creditomonto = $request->procreditomonto;
        $proveedores->pro_estatus = 'NORMAL';
        $proveedores->pro_dias_vencimiento = $request->prodiasvencimiento;
        $proveedores->pro_subtipo = $request->prosubtipo;

        $proveedores->save();
    //     //datos de direccion con id nuevo
        $idnuevo = $proveedores->pro_id;
    //    //direccion fiscal
        $prodirecciones = new catalogo_direccion_proveedores();
        $prodirecciones->prodir_calle = $request->prodircalle;
        $prodirecciones->prodir_numint = $request->prodirnumint;
        $prodirecciones->prodir_numext = $request->prodirnumext;
        $prodirecciones->prodir_colonia = $request->prodircolonia;
        $prodirecciones->prodir_municipio = $request->prodirmunicipio;
        $prodirecciones->prodir_estado = $request->prodirestado;
        $prodirecciones->prodir_pais = $request->prodirpais;
        $prodirecciones->prodir_codigopostal = $request->prodircodigopostal;
        $prodirecciones->prodir_tipo ='ENVIO';
        $prodirecciones->prodir_pro_id = $idnuevo;
        $prodirecciones->save();

    return response()->json(['success' => 'Proveedor creado correctamente.']);
    }

    public function edita_proveedor(Request $request )    {
        $id = $request->get('pro_id');
        $proveedores = catalogo_proveedores::find($id);
        return $proveedores;
    }

    public function actualiza_proveedor(Request $request)    {
        $id = $request->get('pro_id');
        $proveedores = catalogo_proveedores::find($id);
        $proveedores->pro_contacto = $request->get('pro_contacto');
        $proveedores->pro_razon_social = $request->get('pro_razon_social');
        $proveedores->pro_rfc = $request->get('pro_rfc');
        $proveedores->pro_sitioweb = $request->get('pro_sitioweb');
        $proveedores->pro_email = $request->get('pro_email');
        $proveedores->pro_fechaalta = $request->get('pro_fechaalta');
        $proveedores->pro_creditodias = $request->get('pro_creditodias');
        $proveedores->pro_creditomonto = $request->get('pro_creditomonto');
        $proveedores->pro_dias_vencimiento = $request->get('pro_dias_vencimiento');

       
        

        $proveedores->save();
        
        return response([ 'success' => true, 'proveedores'=>$proveedores ]);
    }

    public function edita_proveedor_direccion(Request $request){
        $id = $request->get('pro_id');
        $Direccionproveedor = catalogo_direccion_proveedores::find($id);
        return $Direccionproveedor;
    }

    public function actualiza_proveedor_direccion(Request $request){
        $id = $request->get('pro_id');
        $proveedor_direcciones = catalogo_direccion_proveedores::find($id);
        $proveedor_direcciones->prodir_calle = $request->get('prodir_calle');
       
        $proveedor_direcciones->prodir_numint = $request->get('prodir_numint');
        $proveedor_direcciones->prodir_numext = $request->get('prodir_numext');
        $proveedor_direcciones->prodir_colonia = $request->get('prodir_colonia');
        $proveedor_direcciones->prodir_municipio = $request->get('prodir_municipio');
        $proveedor_direcciones->prodir_estado = $request->get('prodir_estado');
        $proveedor_direcciones->prodir_pais = $request->get('prodir_pais');
        $proveedor_direcciones->prodir_codigopostal = $request->get('prodir_codigopostal');

        $proveedor_direcciones->save();
        return response([ 'success' => true, 'ProveedorDireccion'=>$proveedor_direcciones ]);

    }

    public function proveedor_show ( $id){
        
        $proveedorshow = catalogo_proveedores::find($id);
        return view('catalogo_proveedores.proveedor_show', compact('proveedorshow'));
    }
}
