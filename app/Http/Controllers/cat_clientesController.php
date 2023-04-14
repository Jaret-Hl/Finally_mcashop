<?php

namespace App\Http\Controllers;

use App\Models\Cat_clientes;
use App\Models\Cat_Clientes_Direccion;
use App\Models\setMenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class cat_clientesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:cat_clientes', ['only' => ['index']]);
    }
    public function index()
    {
        $menus = setMenuModel::all();
        $clientes = Cat_clientes::all();
        return view('cat_clientes.index_clientes',compact('clientes','menus'));
 
    }

    public function listado_clientes()
    {
        $registros = DB::select("SELECT cli_id, cli_razon_social, cli_rfc, cli_telefono, cli_contacto, cli_tipocliente, 
        cli_estado, cli_email, 'CTES' as acciones  from cat_clientes");
       return $registros ;
    }


    static public function combo()    {
        $registros = DB::select("SELECT concat(cli_id, '|  ', cli_razon_social) as clientes from cat_clientes");
        return $registros ;
    }
    public function inserta_cliente(Request $request)    {
        //se insertan los datos en variable clientes 
        $clientes = new Cat_clientes();
        $clientes->cli_contacto = $request->get('cli_contacto');
        $clientes->cli_razon_social = $request->get('cli_razon_social');
        $clientes->cli_tipocliente = $request->get('cli_tipocliente');
        $clientes->cli_rfc = $request->get('cli_rfc');
        $clientes->cli_telefono = $request->get('cli_telefono');
        $clientes->cli_celular = $request->get('cli_celular');
        $clientes->cli_email = $request->get('cli_email');
        $clientes->cli_estado = 'NORMAL';
        $clientes->cli_fecha = $request->get('cli_fecha');
        $clientes->cli_diascredito = $request->get('cli_diascredito');
        $clientes->cli_montocredito = $request->get('cli_montocredito');

        $clientes->save();

        


        



        return response([ 'success' => true, 'cliente']);
    }

    public function edita_cliente(Request $request )    {
        $id = $request->get('cli_id');
        $clientes = Cat_clientes::find($id);
        return $clientes;
    }

    public function actualiza_cliente(Request $request)    {
        $id = $request->get('cli_id');
        $clientes = Cat_clientes::find($id);
        $clientes->cli_contacto = $request->get('cli_contacto');
        $clientes->cli_razon_social = $request->get('cli_razon_social');
        $clientes->cli_tipocliente = $request->get('cli_tipocliente');
        $clientes->cli_rfc = $request->get('cli_rfc');
        $clientes->cli_telefono = $request->get('cli_telefono');
        $clientes->cli_celular = $request->get('cli_celular');
        $clientes->cli_email = $request->get('cli_email');
        $clientes->cli_estado = $request->get('cli_estado');
        $clientes->cli_fecha = $request->get('cli_fecha');
        $clientes->cli_diascredito = $request->get('cli_diascredito');
        $clientes->cli_montocredito = $request->get('cli_montocredito');
       
        

        $clientes->save();
        
        return response([ 'success' => true, 'cliente'=>$clientes ]);
    }

    public function cliente_show ( $id){
        
        $clientesh = Cat_clientes::find($id);
        return view('cat_clientes.cliente_show', compact('clientesh'));
    }


    public function edita_cliente_direccion(Request $request )    {
        $id = $request->get('cli_id');
        $direcciones = Cat_Clientes_Direccion::where('clidir_cli_id', $id)
                                ->where('clidir_tipo', 'FISCAL')
                                ->get();
        return $direcciones;
    }

    public function actualiza_cliente_direccion(Request $request){
        $id = $request->get('cli_id');
        //modificacion de cliente direccion fiscal
        $clidir_fiscal = Cat_Clientes_Direccion::where('clidir_cli_id', $id)
                            ->where('clidir_tipo', 'FISCAL')
                            ->first(); // este punto es el mas importante a cambiar
        $clidir_fiscal->clidir_calle = $request->get('clidir_calle');
       
        $clidir_fiscal->clidir_numint = $request->get('clidir_numint');
        $clidir_fiscal->clidir_numext = $request->get('clidir_numext');
        $clidir_fiscal->clidir_colonia = $request->get('clidir_colonia');
        $clidir_fiscal->clidir_municipio = $request->get('clidir_municipio');
        $clidir_fiscal->clidir_estado = $request->get('clidir_estado');
        $clidir_fiscal->clidir_pais = $request->get('clidir_pais');
        $clidir_fiscal->clidir_codigopostal = $request->get('clidir_codigopostal');

        $clidir_fiscal->save();

        
        //modificacion de cliente direccion ENVIO
        $clidir_envio = Cat_Clientes_Direccion::where('clidir_cli_id', $id)
                            ->where('clidir_tipo', 'ENVIO')
                            ->where('clidir_nombre', 'DIRECCION FISCAL')
                            ->first(); // este punto es el mas importante a cambiar

        $clidir_envio->clidir_calle = $request->get('clidir_calle');
        $clidir_envio->clidir_numint = $request->get('clidir_numint');
        $clidir_envio->clidir_numext = $request->get('clidir_numext');
        $clidir_envio->clidir_colonia = $request->get('clidir_colonia');
        $clidir_envio->clidir_municipio = $request->get('clidir_municipio');
        $clidir_envio->clidir_estado = $request->get('clidir_estado');
        $clidir_envio->clidir_pais = $request->get('clidir_pais');
        $clidir_envio->clidir_codigopostal = $request->get('clidir_codigopostal');
        

        $clidir_envio->save();
        return response([ 'success' => true, 'clientedir'=>$clidir_fiscal ]);


    }

    public function destroy($id)
    {
        //
    }

    public function inserta_nueva_direccion(Request $request){
    //     $clientes = new Cat_clientes();
    //     $idnuevo = $clientes->cli_id;
    //    //direccion fiscal
    //     $clidir_fiscal = new Cat_Clientes_Direccion();
    //     $clidir_fiscal->clidir_calle = $request->get('clidir_calle');
    //     // $clidir_fiscal->clidir_numint = $request->get('clidir_numint');
    //     // $clidir_fiscal->clidir_numext = $request->get('clidir_numext');
    //     // $clidir_fiscal->clidir_colonia = $request->get('clidir_colonia');
    //     // $clidir_fiscal->clidir_municipio = $request->get('clidir_municipio');
    //     // $clidir_fiscal->clidir_estado = $request->get('clidir_estado');
    //     // $clidir_fiscal->clidir_pais = $request->get('clidir_pais');
    //     // $clidir_fiscal->clidir_codigopostal = $request->get('clidir_codigopostal');
    //     $clidir_fiscal->clidir_cli_id = $idnuevo;
    //     //direccion fiscal clidir_tipo
    //     $clidir_fiscal->clidir_tipo = 'ENVIO';
    //     $clidir_fiscal->save();
    }
}
