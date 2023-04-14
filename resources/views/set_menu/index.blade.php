@extends('layouts.app')
@extends('setmenu')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'menu | roles')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end mt-4">
            <button id="btnnuevomenu_roles" class="btn btn-success"><i class="fa-sharp fa-solid fa-plus">
                </i> Agregar rol | menu</button>
        </div>
        <div class="row">
            <div class="card mt-3">
                <div class="card-body">
                    <table id="menu" class="table table-striped shadow-lg mt-4" style="width:100%">
                        <thead class="bg-primary  text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Rol ID</th>
                                <th scope="col">Menu ID</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Nuevo menu_roles -->
    <div class="modal fade" id="nuevomenu_roles" name="nuevomenu_roles" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo menu_roles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="">
                            @csrf
                            <div class="d-flex justify-content-start">
                                <div class="col-6 me-2">
                                    <label for="role_id" class="form-label">ID del rol</label>
                                    <input type="text" class="form-control" id="rolIDNuevo" name="rolIDNuevo"
                                        tabindex="1" placeholder="Inserta el ID del rol" value="" required>
                                </div>
                                <div class="col-6 me-2">
                                    <label for="menu_id" class="form-label">ID del menu</label>
                                    <input type="text" class="form-control" id="menuIDNuevo" name="menuIDNuevo"
                                        tabindex="1" placeholder="Inserta el ID del menu" value="" required>
                                </div>
                            </div>
                        </form>

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
    <!-- Modal edita Menu -->
    <div class="modal fade" id="editamenu_roles" name="editamenu_roles" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edita menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="">
                            @csrf
                            <div class="d-flex justify-content-start">
                                <div class="col-sm-1 me-2">
                                    <fieldset disabled>
                                        <label for="menu_roles_ID" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id_edit" name='id_edit'
                                            tabindex="1" placeholder="" value="" required>
                                    </fieldset>
                                </div>
                                <div class="col-2 me-2">
                                    <label for="role_id" class="form-label">ID del rol</label>
                                    <input type="text" class="form-control" id="rolIDedit" name="rolIDedit"
                                        tabindex="1" placeholder="Inserta el ID del rol" value="" required>
                                </div>
                                <div class="col-4 me-2">
                                    <label for="menu_id" class="form-label">ID del menu</label>
                                    <input type="text" class="form-control" id="menuIDedit" name="menuIDedit"
                                        tabindex="1" placeholder="Inserta el ID del menu" value="" required>
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
            $tbl_listado = $('#menu').DataTable({
                ajax: {
                    "url": "{{ route('listado_menu_roles') }}",
                    "type": "GET",
                    "info": true,
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "dataSrc": ""
                },
                "columns": [
                    {data: 'menu_roles_ID'},
                    {data: 'role_id'},
                    {data: 'menu_id'},
                ],
                "columnDefs": [{
                    "targets": 3,
                    "sorteable": false,
                    "render": function(data, type, full, meta) {
                        return '<span   class="btnconsultamenu text-primary " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Consultar"> <i class="fas fa-search fa-lg"> </i></span>' +
                            '<span   class="btneditarmenu_roles text-success " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Editar"> <i class="fas fa-pencil fa-lg"> </i></span>';
                    }
                }, ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        })
        // ////////////  Agregar menu_roles /////////////////////
        // Configuracion del modal 
        $(function() {
            $('#nuevomenu_roles').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });

        // Muestra modal al dar click nuevo menu
        $(function() {
            $(document).on('click', '#btnnuevomenu_roles', function() {
                $('#nuevomenu_roles').modal('show');
            });
        });
        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarnuevomodal', function() {
                $rolIDNuevo = $('#rolIDNuevo').val();
                $menuIDNuevo = $('#menuIDNuevo').val();
                console.log($rolIDNuevo);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('inserta_menu_roles') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {

                        rolIDNuevo: $rolIDNuevo,
                        menuIDNuevo: $menuIDNuevo,
                    },
                    success: function(data) {
                        console.log(data);
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.info('Se registro el menu');
                        $('#nuevomenu').modal('hide');
                        window.location.href = "set_menu";

                    }
                });
            });
        });
        /////////



        //////////////  Editar menu_roles  //////////////////////////
        // Configuracion del modal editar
        $(function() {
            $('#editamenu_roles').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });
        // Muestra modal al dar click
        $(function() {
            $(document).on('click', '.btneditarmenu_roles', function() {
                $indice_registro = $tbl_listado.row($(this).parents('tr')).index();
                $id = $tbl_listado.cell($indice_registro, 0).data();
                // console.log($id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('edita_menu_roles') }}",
                    method: "GET",
                    dataType: 'JSON',
                    data: {
                        menu_roles_ID: $id
                    },
                    success: function(data) {
                        // console.log(data);
                        $id_edit = document.querySelector('#id_edit');
                        $id_edit.setAttribute("value", data.menu_roles_ID);

                        $rolIDedit = document.querySelector('#rolIDedit');
                        $rolIDedit.setAttribute("value", data.role_id);

                        $menuIDedit = document.querySelector('#menuIDedit');
                        $menuIDedit.setAttribute("value", data.menu_id);
                    }
                });

                $('#editamenu_roles').modal('show');
            });
        });

        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarmodeledit', function() {
                $menu_roles_ID = $('#id_edit').val();
                $role_id = $('#rolIDedit').val();
                $menu_id = $('#menuIDedit').val();


                //console.log(data);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('actualiza_menu_roles') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {
                        menu_roles_ID: $menu_roles_ID,
                        role_id: $role_id,
                        menu_id: $menu_id,
                    },
                    success: function(data) {
                        // console.log(data);
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.info('Se Actualizo el menu');
                        $('#editamenu').modal('hide');
                        window.location.href = "set_menu";
                    }
                });

            });
        });
        /////
    </script>
    <script src="https://kit.fontawesome.com/5a948d3270.js" crossorigin="anonymous"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

@endsection
