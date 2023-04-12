@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'menu')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end mt-4">
            <button id="btnnuevomenu" class="btn btn-success"><i class="fa-sharp fa-solid fa-plus">
                </i> Agregar menu</button>
        </div>
        <div class="row">
            <div class="card mt-3">
                <div class="card-body">
                    <table id="menu" class="table table-striped shadow-lg mt-4" style="width:100%">
                        <thead class="bg-primary  text-white">
                            <tr>
                                <th scope="col">menu_ID</th>
                                <th scope="col">Nombre de la ruta</th>
                                <th scope="col">Titulo</th>
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
    <!-- Modal Nuevo Menu -->
    <div class="modal fade" id="nuevomenu" name="nuevomenu" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                        <div class="d-flex justify-content-start">
                            <div class="col-6 me-2">
                                <label for="menu_ruta" class="form-label">Nombre de la ruta</label>
                                <input type="text" class="form-control" id="menu_rutasNuevo" name="menu_rutasNuevo"
                                    tabindex="1" placeholder="Inserta el nombre de la ruta" value="" required>
                            </div>
                            <div class="col-4 me-2">
                                <label for="title" class="form-label">Titulo de la ruta</label>
                                <input type="text" class="form-control" id="titleNuevo" name="titleNuevo" tabindex="1"
                                    placeholder="Inserta el titulo de la ruta" value="" required>
                            </div>
                        </div>
                        
                    </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btncerrarmodal" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" id="btnguardarnuevomodal" class="btn btn-primary">Guardar</button> --}}
                    <button class="btn btn-success btn-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edita Menu -->
    <div class="modal fade" id="editamenu" name="editamenu" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edita menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            @csrf

                            <div class="d-flex justify-content-start">
                                <div class="col-sm-1 me-2">
                                    <fieldset disabled>
                                        <label for="menu_id" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id_edit" name='id_edit'
                                            tabindex="1" placeholder="" value="" required>
                                    </fieldset>
                                </div>
                                <div class="col-6 me-2">
                                    <label for="menu_rutas" class="form-label">Nombre de la ruta</label>
                                    <input type="text" class="form-control" id="menu_rutasEdit" name="menu_rutasEdit"
                                        tabindex="1" placeholder="Inserta el nombre de la ruta" value="" required>
                                    <span class="text-danger" id="nombrError"></span>

                                </div>
                                <div class="col-6 me-2">
                                    <label for="title" class="form-label">Titulo de la ruta</label>
                                    <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                        tabindex="1" placeholder="Inserta el titulo de la ruta" value=""
                                        required>
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
    <script type="text/javascript">
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        $(".btn-submit").click(function(e){
        
            e.preventDefault();
         
            var menu_rutas = $("#menu_rutasNuevo").val();
            var title = $("#titleNuevo").val();
         
            $.ajax({
               type:'GET',
               url:"{{ route('inserta_menu') }}",
               data:{title:title, menu_rutas:menu_rutas},
               success:function(data){
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                        location.reload();
                    }else{
                        printErrorMsg(data.error);
                    }
               }
            });
        
        });
      
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
      
    </script>
    <script>
                $(document).ready(function() {
            $tbl_listado = $('#menu').DataTable({
                ajax: {
                    "url": "{{ route('listado_menu') }}",
                    "type": "GET",
                    "info": true,
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "dataSrc": ""
                },
                "columns": [
                    {data: 'menu_id'},
                    {data: 'menu_rutas'},
                    {data: 'title'},
                    {data: 'acciones'},
                ],
                "columnDefs": [{
                    "targets": 3,
                    "sorteable": false,
                    "render": function(data, type, full, meta) {
                        return '<span   class="btnconsultamenu text-primary " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Consultar"> <i class="fas fa-search fa-lg"> </i></span>' +
                            '<span   class="btneditarmenu text-success " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Editar"> <i class="fas fa-pencil fa-lg"> </i></span>';
                    }
                }, ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        })
        // //////// BOTON DE CONSULTA DEL menu ///////////
        $(document).on('click', '.btnconsultamenu', function() {
            $datos = $tbl_listado.row($(this).parents('tr')).data();
            $indice = $tbl_listado.row($(this).parents('tr')).index();

            $(location).prop('href', 'http://127.0.0.1:8000/menu_show/');
        });

        // ////////////  Agregar menu /////////////////////
        // Configuracion del modal 
        $(function() {
            $('#nuevomenu').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });

        // Muestra modal al dar click nuevo menu
        $(function() {
            $(document).on('click', '#btnnuevomenu', function() {
                $('#nuevomenu').modal('show');
            });
        });
        
        /////////

        //////////////  Editar cliente  //////////////////////////
        // Configuracion del modal editar
        $(function() {
            $('#editamenu').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });
        // Muestra modal al dar click
        $(function() {
            $(document).on('click', '.btneditarmenu', function() {
                $indice_registro = $tbl_listado.row($(this).parents('tr')).index();
                $id = $tbl_listado.cell($indice_registro, 0).data();
                // console.log($id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('edita_menu') }}",
                    method: "GET",
                    dataType: 'JSON',
                    data: {
                        menu_id: $id
                    },
                    success: function(data) {
                        // console.log(data);
                        $id_edit = document.querySelector('#id_edit');
                        $id_edit.setAttribute("value", data.menu_id);

                        $menu_rutasEdit = document.querySelector('#menu_rutasEdit');
                        $menu_rutasEdit.setAttribute("value", data.menu_rutas);

                        $titleEdit = document.querySelector('#titleEdit');
                        $titleEdit.setAttribute("value", data.title);
                    }
                });

                $('#editamenu').modal('show');
            });
        });

        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarmodeledit', function() {
                $menu_id = $('#id_edit').val();
                $menu_rutas = $('#menu_rutasEdit').val();
                $title = $('#titleEdit').val();


                //console.log(data);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('actualiza_menu') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {
                        menu_id: $menu_id,
                        menu_rutas: $menu_rutas,
                        title: $title,
                    },
                    success: function(data) {
                        // console.log(data);
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.info('Se Actualizo el menu');
                        $('#editamenu').modal('hide');
                        window.location.href = "menu";
                    }
                });

            });
        });
        /////
    </script>
    <script src="https://kit.fontawesome.com/5a948d3270.js" crossorigin="anonymous"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>


@endsection
