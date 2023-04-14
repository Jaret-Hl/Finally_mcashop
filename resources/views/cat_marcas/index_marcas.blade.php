@extends('layouts.app')
@extends('setmenu')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

@endsection

@section('title', 'catMarcas ')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-end mt-4">
            <button id="btnnuevamarca" class="btn btn-success"><i class="fa-sharp fa-solid fa-plus">
                </i> Agregar Marca</button>
        </div>

        <div class="row">

            <div class="card mt-3">
                <div class="card-body">
                    <table id="marcas" class="table table-striped shadow-lg mt-4" style="width:100%">
                        <thead class="bg-primary  text-white">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">URL</th>
                                <th scope="col">Logotipo</th>
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



    <!-- Modal nuevo marca -->
    <div class="modal fade" id="nuevamarca" name="nuevamarca" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <form method="POST" enctype="multipart/form-data" id="image-upload"
                                action="javascript:void(0)">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <input type="text" class="form-control mt-2" id="mar_nombre" name="mar_nombre"
                                                placeholder="Inserta nombre de la marca" required>
                                            <input type="text" class="form-control mt-2" id="mar_url" name="mar_url"
                                                placeholder="URL de la marca*" required>
                                                <label for="">Logotipo</label>
                                            <input class="form-control mt-2" type="file" name="mar_logotipo" placeholder="Choose image"
                                                id="mar_logotipo" accept="image/*">

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <img id="preview-image-before-upload"
                                            src="https://neliosoftware.com/es/wp-content/uploads/sites/3/2019/09/bloque-tipo-imagen.png"
                                            height="200" alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Banner</label>
                                            <input class="form-control mt-2" type="file" name="mar_urlbanner" placeholder="Choose image"
                                                id="mar_urlbanner" accept="image/*">

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <img id="preview-image-before-uploads"
                                            src="https://neliosoftware.com/es/wp-content/uploads/sites/3/2019/09/bloque-tipo-imagen.png"
                                            height="200" alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="btncerrarmodal" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edita marca -->
    <div class="modal fade" id="editarmarca" name="editarmarca" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edita Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form>
                            @csrf

                            <div class="d-flex justify-content-start">
                                <div class="col-sm-1 me-2">
                                    <fieldset disabled>
                                        <label for="mar_id" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id_edit" name='id_edit'
                                            tabindex="1" placeholder="" value="" required>
                                    </fieldset>
                                </div>
                                <div class="col-6 me-2">
                                    <label for="mar_nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="mar_nombreedit" name="mar_nombreedit"
                                        tabindex="1" placeholder="Inserta nombre de la marca" value="" required>
                                </div>

                            </div>
                            <div class="d-flex">
                                <div class="col-sm-6 me-2">
                                    <label for="mar_url" class="form-label">URL</label>
                                    <input type="text" class="form-control" id="mar_urledit" name="mar_urledit"
                                        tabindex="1" placeholder="URL de la marca*" value="" required>
                                </div>
                                <div class="col-sm-6 me-2">
                                    <label for="mar_logotipo" class="form-label">Logotipo</label>
                                    <input type="text" class="form-control" id="mar_logotipoedit"
                                        name="mar_logotipoedit" tabindex="1" placeholder="Inserta tu logotipo*"
                                        value="" required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    {{-- //guardar imagen en registro --}}
        <script type="text/javascript">
        $(document).ready(function(e) {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $('#mar_logotipo').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                // console.log(reader[0]);
            });
            $('#mar_urlbanner').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-uploads').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                console.log(reader[0]);
            });
            $('#image-upload').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                
                $.ajax({
                    type: 'POST',
                    url: "{{ url('upload') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('Marca creada correctamente');
                        window.location.href = "cat_marcas";
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
    <script>
        
        $(document).ready(function() {
                $tbl_listado = $('#marcas').DataTable({
                    ajax: {
                        "url": "{{ route('listado_marcas') }}",
                        "type": "GET",
                        "info": true,
                        "headers":{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        "dataSrc": ""
                        },
                        "columns": [
                        {data: 'mar_id'},
                        {data: 'mar_nombre'},
                        {data: 'mar_estatus'},
                        {data: 'mar_url'},
                        {data: 'mar_publicado',
                        "render": function(data, type, row) {
                                    var data_n = data.split("/public");
                                    // console.log(data_n[0]);
                                    return '<img src="'+data_n[0]+'" class="img-fluid img-thumbnail" width="100px">';
                                }},
                        {data: 'acciones'}],
                        "columnDefs": [{
                            "targets": 5,"sorteable": false,"render": function(data, type, full, meta) {
                                    return '<span   class="btnconsultamarca text-primary " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Consultar"> <i class="fas fa-search fa-lg"> </i></span>' +
                                            '<span   class="btneditarmarca text-success " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Editar"> <i class="fas fa-pencil fa-lg"> </i></span>';
                                            }
                                        }],
                });
            })

        // //////// BOTON DE CONSULTA DEL MARCA ///////////

        $(document).on( 'click', '.btnconsultamarca', function () {
            $datos =  $tbl_listado.row( $(this).parents('tr') ).data();
            $indice =  $tbl_listado.row( $(this).parents('tr') ).index();
            $mar_id = $datos['mar_id'];      
            $(location).prop('href', 'http://127.0.0.1:8000/marca_show/'+$mar_id);
        });

        // ////////////  Agregar MARCA /////////////////////
        // Configuracion del modal 
        $(function() {
            $('#nuevamarca').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });

        // Muestra modal al dar click nuevA MARCA
        $(function() {
            $(document).on('click', '#btnnuevamarca', function() {
                $('#nuevamarca').modal('show');
            });
        });


        //////////////  Editar MARCA  //////////////////////////
        // Configuracion del modal editar
        $(function() {
            $('#editarmarca').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });

        // Muestra modal al dar click
        $(function() {
            $(document).on('click', '.btneditarmarca', function() {
                $indice_registro = $tbl_listado.row($(this).parents('tr')).index();
                $id = $tbl_listado.cell($indice_registro, 0).data();
                // console.log($id);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: "{{ route('edita_marca') }}",
                    method: "GET",
                    dataType: 'JSON',
                    data: {mar_id: $id  },
                    success: function(data) {
                        // console.log(data);
                        $id_edit = document.querySelector('#id_edit');
                        $id_edit.setAttribute("value", data.mar_id);

                        

                        $mar_nombreedit  = document.querySelector('#mar_nombreedit');
                        $mar_nombreedit.setAttribute("value",data.mar_nombre);

                        $mar_urledit  = document.querySelector('#mar_urledit');
                        $mar_urledit.setAttribute("value",data.mar_url);

                        $mar_logotipoedit  = document.querySelector('#mar_logotipoedit');
                        $mar_logotipoedit.setAttribute("value",data.mar_logotipo);                                        
                    }
                });

                $('#editarmarca').modal('show');
            });
        });

        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarmodeledit', function() {
                $mar_id = $('#id_edit').val();
                $mar_nombre = $('#mar_nombreedit').val();
                $mar_url = $('#mar_urledit').val();
                $mar_logotipo = $('#mar_logotipoedit').val();


                //console.log(data);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: "{{ route('actualiza_marca') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {
                        mar_id: $mar_id,
                        mar_nombre: $mar_nombre,
                        mar_url: $mar_url,
                        mar_logotipo: $mar_logotipo,
                    },
                            success: function(data) {

                                // console.log(data);
                                toastr.options.showMethod = 'slideDown';
                                toastr.options.hideMethod = 'slideUp';
                                toastr.info('Se Actualizo la marca');
                                $('#editarmarca').modal('hide');
                                window.location.href = "cat_marcas";

                            }
                        
                    });
                
                
            });
        });
        /////
    </script>
    <script src="https://kit.fontawesome.com/5a948d3270.js" crossorigin="anonymous"></script>
    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    

@endsection
