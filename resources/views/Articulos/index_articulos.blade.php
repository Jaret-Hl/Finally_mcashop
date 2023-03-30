@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

@endsection

@section('title', 'catArticulos')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end mt-4">
            <button id="btnnuevoArticulo" class="btn btn-success"><i class="fa-sharp fa-solid fa-plus">
                </i> Agregar articulo</button>
        </div>
        <div class="row">
            <div class="card mt-3">
                <div class="card-body">
                    <table id="articulos" class="table table-striped shadow-lg mt-4" style="width:100%">
                        <thead class="bg-primary  text-white">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Codigo fabricante</th>
                                <th scope="col">sku prov</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Marca fab</th>
                                <th scope="col">Operación</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Nuevo Articulo -->
    <div class="modal fade" id="nuevoArticulo" name="nuevoArticulo" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Articulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        
                            @csrf
                            <div class="d-flex justify-content-start">
                                <div class="col-6 me-2">
                                    <label for="art_codigofabricante" class="form-label">Codigo del fabricante</label>
                                    <input type="text" class="form-control" id="art_codigofabricanteNuevo"
                                        name="art_codigofabricanteNuevo" tabindex="1"
                                        placeholder="Inserta codigo del fabricante" value="" required>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-6 me-2">
                                    <label for="art_skuproveedor" class="form-label">SKU Proveedor</label>
                                    <input type="text" class="form-control" id="art_skuproveedorNuevo"
                                        name="art_skuproveedorNuevo" tabindex="1"
                                        placeholder="Inserta codigo del fabricante" value="" required>
                                </div>
                                <div class="col-sm-6 me-2">
                                    <label for="mar_url" class="form-label">URL</label>
                                    <input type="text" class="form-control" id="" name="" tabindex="1"
                                        placeholder="URL de la marca*" value="" required>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btncerrarmodal" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnguardarnuevomodal" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal edita Articulo -->
<div class="modal fade" id="editaArticulo" name="editaArticulo" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edita Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form>
                        @csrf

                        <div class="d-flex justify-content-start">
                            <div class="col-sm-1 me-2">
                                <fieldset disabled>
                                    <label for="art_id" class="form-label">ID</label>
                                    <input type="text" class="form-control" id="id_edit" name ='id_edit' tabindex="1" placeholder="" value="" required>
                                </fieldset>
                            </div>
                            <div class="col-6 me-2">
                                <label for="art_codigofabricante" class="form-label">Codigo del fabricante</label>
                                <input type="text" class="form-control" id="art_codigofabricanteEdit"
                                    name="art_codigofabricanteEdit" tabindex="1"
                                    placeholder="Inserta codigo del fabricante" value="" required>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-sm-6 me-2">
                                <label for="mar_url" class="form-label">URL</label>
                                <input type="text" class="form-control" id="" name="" tabindex="1"
                                    placeholder="URL de la marca*" value="" required>
                            </div>
                            <div class="col-sm-6 me-2">
                                <label for="mar_logotipo" class="form-label">Logotipo</label>
                                <input type="text" class="form-control" id="" name="" tabindex="1"
                                    placeholder="Inserta tu logotipo*" value="" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btncerrarmodal" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnguardarmodeledit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $tbl_listado = $('#articulos').DataTable({
                ajax: {
                    "url": "{{ route('listado_articulos') }}",
                    "type": "GET",
                    "info": true,
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "dataSrc": ""
                },
                "columns": [
                    {data: 'art_id'},
                    {data: 'art_codigofabricante'},
                    {data: 'art_skuproveedor'},
                    {data: 'art_descripcion'},
                    {data: 'art_marcafabricante'},
                    {data: 'acciones'},
                ],
                "columnDefs": [{
                    "targets": 5,
                    "sorteable": false,
                    "render": function(data, type, full, meta) {
                        return '<span   class="btnconsultamarca text-primary " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Consultar"> <i class="fas fa-search fa-lg"> </i></span>' +
                            '<span   class="btneditarArticulo text-success " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Editar"> <i class="fas fa-pencil fa-lg"> </i></span>';
                    }
                }, ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        })

        // //////// BOTON DE CONSULTA DEL articulos ///////////
        $(document).on('click', '.btnconsultamarca', function() {
            $datos = $tbl_listado.row($(this).parents('tr')).data();
            $indice = $tbl_listado.row($(this).parents('tr')).index();
            $mar_id = $datos['mar_id'];
            $(location).prop('href', 'http://127.0.0.1:8000/marca_show/' + $mar_id);
        });

        // ////////////  Agregar articulos /////////////////////
        // Configuracion del modal 
        $(function() {
            $('#nuevoArticulo').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });

        // Muestra modal al dar click nuevo articulos
        $(function() {
            $(document).on('click', '#btnnuevoArticulo', function() {
                $('#nuevoArticulo').modal('show');
            });
        });
        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarnuevomodal', function() {
                $art_codigofabricanteNuevo = $('#art_codigofabricanteNuevo').val();
                $art_skuproveedorNuevo = $('#art_skuproveedorNuevo').val();
                // console.log(art_codigofabricanteNuevo);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('inserta_articulo') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {
                        
                        art_codigofabricanteNuevo: $art_codigofabricanteNuevo,
                        art_skuproveedorNuevo: $art_skuproveedorNuevo,
                    },
                    success: function(data) {
                        console.log(data);
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.info('Se registro el Articulo');
                        $('#nuevoArticulo').modal('hide');
                        window.location.href = "Articulos";

                    }
                });
            });
        });
        /////////

        //////////////  Editar cliente  //////////////////////////
        // Configuracion del modal editar
        $(function() {
            $('#editaArticulo').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });
        // Muestra modal al dar click
        $(function() {
            $(document).on('click', '.btneditarArticulo', function() {
                $indice_registro = $tbl_listado.row($(this).parents('tr')).index();
                $id = $tbl_listado.cell($indice_registro, 0).data();
                // console.log($id);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: "{{ route('edita_articulo') }}",
                    method: "GET",
                    dataType: 'JSON',
                    data: {art_id: $id  },
                    success: function(data) {
                        // console.log(data);
                        $id_edit = document.querySelector('#id_edit');
                        $id_edit.setAttribute("value", data.art_id);

                        $art_codigofabricanteEdit = document.querySelector('#art_codigofabricanteEdit');
                        $art_codigofabricanteEdit.setAttribute("value", data.art_codigofabricante);
                    }
                });

                $('#editaArticulo').modal('show');
            });
        });

        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarmodeledit', function() {
                $art_id = $('#id_edit').val();
                $art_codigofabricante = $('#art_codigofabricanteEdit').val();
                

                //console.log(data);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: "{{ route('actualiza_articulo') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {
                        art_id: $art_id,
                        art_codigofabricante:$art_codigofabricante,
                    },
                    success: function(data) {
                        // console.log(data);
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'slideUp';
                            toastr.info('Se Actualizo el articulo');
                            $('#editaArticulo').modal('hide');
                            window.location.href = "Articulos";
                    }
                });
                
            });
        });
        /////

    </script>
    <script src="https://kit.fontawesome.com/5a948d3270.js" crossorigin="anonymous"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>


@endsection
