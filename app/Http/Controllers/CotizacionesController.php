<?php

namespace App\Http\Controllers;

use App\Models\Cotizaciones;
use App\Models\setMenuModel;
use Illuminate\Http\Request;

class CotizacionesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:cotizaciones-list|cotizaciones-create|cotizaciones-edit|cotizaciones-delete', ['only' => ['index','show']]);
         $this->middleware('permission:cotizaciones-create', ['only' => ['create','store']]);
         $this->middleware('permission:cotizaciones-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:cotizaciones-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = setMenuModel::all();
        $cotizaciones = Cotizaciones::latest()->paginate(5);
        return view('cotizaciones.index',compact('cotizaciones','menus'));
            // ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cotizaciones.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'folio' => 'required',
            'pago' => 'required',
        ]);
    
        Cotizaciones::create($request->all());
    
        return redirect()->route('cotizaciones.index')
                        ->with('success','Product created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizaciones $cotizaciones)
    {
        return view('cotizaciones.show',compact('cotizaciones'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizaciones $product)
    {
        return view('cotizaciones.edit',compact('cotizaciones'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizaciones  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizaciones $cotizaciones)
    {
         request()->validate([
            'folio' => 'required',
            'pago' => 'required',
        ]);
    
        $cotizaciones->update($request->all());
    
        return redirect()->route('cotizaciones.index')
                        ->with('success','c updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizaciones  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizaciones $cotizaciones)
    {
        $cotizaciones->delete();
    
        return redirect()->route('cotizaciones.index')
                        ->with('success','Product deleted successfully');
    }
}