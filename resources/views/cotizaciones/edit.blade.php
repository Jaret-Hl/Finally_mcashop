@extends('layouts.app')

@section('title', 'Cotizaciones edit')

@section('content')
    <section class="home">
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('cotizaciones.index') }}">
                    Header
                </a>
            </div>
        </nav>
        <div class="container">
            <h1 class="text-center">Editar cliente</h1>
            <!-- DATOS DE ENCABEZADO -->
            <div class="row card mt-3">

                <div class="card-body">
                <form action="{{ route('cotizaciones.update', $cotizaciones->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-2">
                                <label for="folio">Folio</label>
                                <input type="number" class="form-control" name="folio" required maxlength="50"
                                    value="{{ $cotizaciones->Folio }}">
                            </div>
                            <div class="form-group col-4">
                                <label for="razonsocial">Razon Social</label>
                                <input type="text" class="form-control" name="razonsocial" required maxlength="50"
                                    value="{{ $cotizaciones->Razonsocial }}">
                            </div>
                            <div class="form-group col-2">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" name="fecha"
                                    value="{{ $cotizaciones->Fecha }}">
                            </div>

                            <div class="form-group col-2">
                                <label for="total">Total</label>
                                <input type="number" class="form-control" name="total" required maxlength="10"
                                    value="{{ $cotizaciones->Total }}">
                            </div>
                            <div class="form-group col-2">
                                <label for="vendedor">Vendedor</label>
                                <input type="text" class="form-control" name="vendedor" required maxlength="50"
                                    value="{{ $cotizaciones->Vendedor }}">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">

                            <div class="form-group mb-2 col-6">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" name="estado" required maxlength="50"
                                    value="{{ $cotizaciones->Estado }}">
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <a href="javascript:history.back()" class="me-2">Ir a listado</a>
                                <input type="reset" class="btn btn-danger me-2" value="Cancelar">
                                <input type="submit" class="btn btn-primary me-2" value="Guardar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>

    @endsection
