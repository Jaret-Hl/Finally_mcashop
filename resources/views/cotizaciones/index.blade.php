@extends('layouts.app')
@extends('setmenu')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'Cotizaciones')

@section('content')
    <section class="home">

        <div class="container">
            <div class="text-center mt-5">
                <h1 class="title">Lista de cotizaciones</h1>
            </div>

            <div class="d-flex justify-content-end">
                <!-- <a class="btn btn-primary mb-5" href="">Nueva cotizacion</a> -->
                <a class="btn btn-primary mb-3" href="{{ route('cotizaciones.create') }}">Nueva cotizacion</a>
            </div>
            <div class="d-flex justify-content-end">
                <a class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addNew" >New Cotizacion Modal</a>

            </div>

            <!-- BOTONES DE ESTATUS -->
            <div class="d-flex justify-content-end mb-4">
                <a class="px-1" href="">
                    <img src="assets/status/cancel.svg" alt="" value="cancelado" />
                </a>
                <a class="px-1" href="">
                    <img src="assets/status/rechaz.svg" alt="" />
                </a>
                <a class="px-1" href="">
                    <img src="assets/status/process.svg" alt="" />
                </a>
                <a class="px-1" href="">
                    <img src="assets/status/accept.svg" alt="" />
                </a>
                <a class="px-1" href="">
                    <img src="assets/status/all.svg" alt="" />
                </a>
            </div>
            <!-- contenedor -->


            <table class="table table-striped" id="cotizacioness">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Folio</th>
                        <th scope="col">#</th>
                        <th scope="col">Razon Social</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col">Pago</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- se recorre el arreglo de manera controlada --}}
                    @foreach ($cotizaciones as $cot)
                        <tr>
                            <td>{{ $cot->id }}</td>
                            <td>{{ $cot->Folio }}</td>
                            <td>{{ $cot->id_cte }}</td>
                            <td>{{ $cot->Razonsocial }}</td>
                            <td>{{ $cot->Fecha }}</td>
                            <td>{{ $cot->Total }}</td>
                            <td>{{ $cot->Pago }}</td>
                            <td>{{ $cot->Vendedor }}</td>
                            <td>{{ $cot->Estado }}</td>
                            <td>
                                <a href="{{route('cotizaciones.edit', $cot->id)}}" class="btn btn-secondary" value="Editar">Editar</a>
                                <a href="#">
                                    <img src="assets/imprimir.svg" alt="" />
                                </a>
                                <form action="{{route('cotizaciones.destroy',$cot->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
    
                                        {{-- <img type="submit" src="assets/eliminar.svg" alt="" value="Eliminar"/> --}}
                                        <input type="submit" class="btn btn-danger" value="Eliminar">
                                        <i type="submit" class="fa-solid fa-trash" value="Eliminar"></i>
                                 </form>
                                

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </section>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        //Le da formato a la tabla de datos
        $('#cotizacioness').DataTable({

            "language": {
                url:'//cdn.datatables.net/plug-ins/1.13.1/i18n/es-MX.json'
            }

        });
    </script>
@endsection
