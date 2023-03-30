@extends('layouts.app')

@section('title', 'Cotizaciones create')

@section('content')
    <section class="home">
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('cotizaciones.index') }}">
                    Header
                </a>
            </div>
        </nav>
        <!-- ENCABEZADO -->
        <div class="container">
            <div class="text-center mt-2">
                <h3 class="title">Nueva cotizacion</h3>
            </div>

            <!-- folio -->
            <section class="encabezado">
                <div class="d-flex col-3 mb-2">
                    <label class="form-label me-1">
                        <small> Folio de cotizacion </small>
                    </label>
                    <small>
                        <input type="text" class="form-control" placeholder="000" disabled />
                    </small>
                </div>
            </section>
            <hr />
            <div class="buttons">
                <a href="" type="button" class="btn btn-primary">Enviar</a>
                <a href="" type="button" class="btn btn-primary">Imprimir</a>
                <a href="" type="button" class="btn btn-secondary">PDF</a>
            </div>

            <!-- DATOS DE ENCABEZADO -->
            <div class="row mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="col-xl-12">
                            <form action="{{ route('cotizaciones.store') }}" method="POST">
                                @csrf
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                <div class="form-group">
                                    <label for="folio">Folio</label>
                                    <input type="text" class="form-control" name="folio" value="{{old('folio')}}" autofocus>
                                    {!!$errors->first('folio', '<small class="text-danger">:message</small>')!!}
                                </div>
                                <div class="form-group">
                                    <label for="razonsocial">Razon Social</label>
                                    <input type="text" class="form-control" name="razonsocial" value="{{old('razonsocial')}}" autofocus>
                                    {!!$errors->first('razonsocial', '<small class="text-danger">:message</small>')!!}
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" name="fecha" value="{{old('fecha')}}" autofocus>
                                </div>
                                {!!$errors->first('fecha', '<small class="text-danger">:message</small>')!!}

                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="number" class="form-control" name="total" value="{{old('total')}}" autofocus>
                                </div>
                                {!!$errors->first('total', '<small class="text-danger">:message</small>')!!}

                                
                                <div class="form-group">
                                    <label for="vendedor">Vendedor</label>
                                    <input type="text" class="form-control" name="vendedor" value="{{old('vendedor')}}" autofocus>
                                    {!!$errors->first('vendedor', '<small class="text-danger">:message</small>')!!}

                                </div>
                                <div class="form-group mb-2">
                                    <label for="estado">Estado</label>
                                    <input type="text" class="form-control" name="estado" value="{{old('estado')}}" autofocus>
                                    {!!$errors->first('estado', '<small class="text-danger">:message</small>')!!}

                                </div>
                                <div class="form-group d-flex justify-content-end mt-2">
                                    <a class="me-3" href="javascript:history.back()">Ir a listado</a>
                                    <input type="reset" class="btn btn-danger me-3" value="Cancelar">
                                    <button type="submit" class="btn btn-primary">Guardar</button>                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



@endsection
