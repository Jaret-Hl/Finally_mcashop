@extends('layouts.app')

@extends('setmenu')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

@endsection

@section('title', 'catclientes')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-end mt-4">
            <button id="btnnuevocliente" class="btn btn-success"><i class="fa-sharp fa-solid fa-plus"></i> Agregar
                cliente</button>
        </div>
        
        <div class="row">

            <div class="card mt-3">
                <div class="card-body">
                    <table id="clientes" class="table table-striped shadow-lg mt-4" style="width:100%">
                        <thead class="bg-primary  text-white">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Razon Social</th>
                                <th scope="col">RFC</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Email</th>
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



    <!-- Modal nuevo cliente -->
    <div class="modal fade" id="nuevocliente" name="nuevocliente" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo cliente</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                <div class="d-flex justify-content-start">

                    <div class="col-sm-1 me-2">
                        <fieldset disabled>
                            <label for="cli_id" class="form-label">id</label>
                            <input type="text" class="form-control" id="id_nuevo" name='id_nuevo'
                                tabindex="1" placeholder="" value="" required>
                        </fieldset>
                    </div>
                    <div class="col-4 me-2">
                        <label for="cli_contacto" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_nuevo" name="nombre_nuevo"
                            tabindex="1" placeholder="Inserta tu nombre completo" value="" required>
                    </div>
                    <div class="col-2 me-2">
                        <label for="cli_razon_social" class="form-label">Razon Social</label>
                        <input type="text" class="form-control" id="razonsocial_nuevo"
                            name="razonsocial_nuevo" tabindex="1" placeholder="" value=""
                            required>
                    </div>  
                    <div class="col-sm-2 me-2">
                        <label for="cli_rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control" id="rfc_nuevo" name="rfc_nuevo" tabindex="1" placeholder="Tu RFC*" value="" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="cli_tipocliente" class="form-label">Tipo de cliente</label>
                        <select id="tipo_nuevo" class="form-select" aria-label="Default select example">
                            
                            <option selected value="FISICA">Fisica</option>
                            <option value="MORAL">Moral</option>
                          </select>                   
                    </div>
                </div>
                
                <div class="d-flex justify-content-start">
                    <div class="col-sm-2 me-2">
                        <label for="cli_telefono" class="form-label">Telefono</label>
                        <input type="number" class="form-control" id="telefono_nuevo" name="telefono_nuevo" tabindex="1" placeholder="Tu Telefono*" value="" required>
                    </div>
                    <div class="col-sm-2 me-2">
                        <label for="cli_celular" class="form-label">Celular</label>
                        <input type="number" class="form-control" id="celular_nuevo" name="celular_nuevo" tabindex="1" placeholder="Tu Celular*" value="" required>
                    </div>
                    <div class="col-sm-3 me-2">
                        <label for="cli_email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email_nuevo" name="email_nuevo" tabindex="1" placeholder="Tu Email*" value="" required>
                    </div>
                    <div class="col-sm-2 me-2">
                        <label for="cli_fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha_nuevo" name="vendedor_nuevo"  tabindex="1" placeholder="" value="" required>
                    </div>
                </div>

                <div class="d-flex justify-content-start">
                    <div class="col-sm-2 me-2">
                        <label for="cli_diascredito" class="form-label">Dias Credito</label>
                        <input type="text" class="form-control" id="diascredito_nuevo" name="diascredito_nuevo" tabindex="1"placeholder="" value="" required>
                    </div>
                    <div class="col-sm-2 me-2">
                        <label for="cli_montocredito" class="form-label">Monto Credito</label>
                        <input type="text" class="form-control" id="montocredito_nuevo" name="montocredito_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>                    
                    <div class="col-sm-2 me-2">
                        <label for=" " class="form-label">Regimen Fiscal</label>
                        <input type="text" class="form-control" id="regfiscal_nuevo" name="regfiscal_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>
                </div>

                <hr>

                {{-- /////////INFORMACION DE DIRECCION --}}
                <h5 class="text-center"> Tu dirección</h5>
                <div class="d-flex">
                    <div class="col-sm-4 me-2">
                        <label for="clidir_calle" class="form-label">Calle</label>
                        <input type="text" class="form-control" id="calle_nuevo" name="calle_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>
                    <div class="col-sm-1 me-2">
                        <label for="clidir_numext" class="form-label">Numero</label>
                        <input type="text" class="form-control" id="numext_nuevo" name="numext_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>
                    <div class="col-sm-1 me-2">
                        <label for="clidir_numint" class="form-label">Interior</label>
                        <input type="text" class="form-control" id="numint_nuevo" name="numint_nuevo"  tabindex="1" placeholder="" value="" required>
                    </div>
                    <div class="col-sm-3 me-2">
                        <label for="clidir_colonia" class="form-label">Colonia</label>
                        <input type="text" class="form-control" id="colonia_nuevo" name="colonia_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>
                </div>
                
                <div class="d-flex">
                    <div class="col-sm-3 me-2">
                        <label for="clidir_municipio" class="form-label">Municipio</label>
                        <input type="text" class="form-control" id="municipio_nuevo" name="municipio_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>
                    <div class="col-sm-2 me-2">
                        <label for="clidir_estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado_nuevo" name="estado_nuevo"  tabindex="1" placeholder="" value="" required>
                    </div>
                    <div class="col-sm-2 me-2">
                        <label for="clidir_pais" class="form-label">Pais</label>
                        <input type="text" class="form-control" id="pais_nuevo" name="pais_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>
                    <div class="col-sm-2 me-2">
                        <label for="clidir_codigopostal" class="form-label">Codigo Postal</label>
                        <input type="number" class="form-control" id="codigopostal_nuevo" name="codigopostal_nuevo" tabindex="1" placeholder="" value="" required>
                    </div>
                    
                </div>
            </div>

            </div>

            <div class="modal-footer">
                <button type="button" id="btncerrarmodal" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
            <button type="button" id="btnguardarnuevomodal"
                class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>


      

{{-- EDITAR CLIENTE --}}
    <div class="modal fade" id="editarcliente" name="editarcliente" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="col-sm-1 me-2">
                            <fieldset disabled>
                                <label for="cli_id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id_edit" name ='id_edit' tabindex="1" placeholder="" value="" required>
                            </fieldset>
                        </div>
                        <div class="col-4 me-2">
                            <label for="cli_contacto" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_edit"  name="nombre_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-2 me-2">
                            <label for="cli_razon_social" class="form-label">Razon Social</label>
                            <input type="text" class="form-control" id="razonsocial_edit" name="razonsocial_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-2 me-2">
                            <label for="cli_rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="rfc_edit" name="rfc_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-2 me-2">
                            <label for="cli_tipocliente" class="form-label">Tipo de cliente</label>
                                <select id="tipo_nuevo" class="form-select" aria-label="Default select example">
                                    <option name="tipo_edit" id="tipo_edit" selected value="FISICA">Fisica</option>
                                    <option value="MORAL">Moral</option>
                                </select>  
                        </div>
                    </div>
    
                    <div class="d-flex">
                        <div class="col-sm-2 me-2">
                            <label for="cli_telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="telefono_edit" name="telefono_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-2 me-2">
                            <label for="cli_celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celular_edit" name="celular_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-3 me-2">
                            <label for="cli_email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email_edit" name="email_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        
                    </div>
    
                    <div class="d-flex">    
                        <div class="col-sm-2 me-2">
                            <label for="cli_diascredito" class="form-label">Dias Credito</label>
                            <input type="text" class="form-control" id="diascredito_edit" name="diascredito_edit" tabindex="1"placeholder="" value="" required>
                        </div>
                        <div class="col-sm-2 me-2">
                            <label for="cli_montocredito" class="form-label">Monto Credito</label>
                            <input type="text" class="form-control" id="montocredito_edit" name="montocredito_edit" tabindex="1" placeholder="" value="" required>
                        </div>                    
                        <div class="col-sm-2 me-2">
                            <label for=" " class="form-label">Regimen Fiscal</label>
                            <input type="text" class="form-control" id="regfiscal_edit" name="regfiscal_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                    </div>
                    <hr>
                    {{-- /////////INFORMACION DE DIRECCION --}}
                <h5 class="text-center"> Tu dirección</h5>
                    <div class="d-flex">
                        <div class="col-sm-4 me-2">
                            <label for="clidir_calle" class="form-label">Calle</label>
                            <input type="text" class="form-control" id="calle_edit" name="calle_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-1 me-2">
                            <label for="clidir_numext" class="form-label">Numero</label>
                            <input type="text" class="form-control" id="numext_edit" name="numext_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-1 me-2">
                            <label for="clidir_numint" class="form-label">Interior</label>
                            <input type="text" class="form-control" id="numint_edit" name="numint_edit"  tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-3 me-2">
                            <label for="clidir_colonia" class="form-label">Colonia</label>
                            <input type="text" class="form-control" id="colonia_edit" name="colonia_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                    </div>
    
                    <div class="d-flex">    
                        <div class="col-sm-3 me-2">
                            <label for="clidir_municipio" class="form-label">Municipio</label>
                            <input type="text" class="form-control" id="municipio_edit" name="municipio_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-2 me-2">
                            <label for="clidir_estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado_edit" name="estado_edit"  tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-2 me-2">
                            <label for="clidir_pais" class="form-label">Pais</label>
                            <input type="text" class="form-control" id="pais_edit" name="pais_edit" tabindex="1" placeholder="" value="" required>
                        </div>
                        <div class="col-sm-2 me-2">
                            <label for="clidir_codigopostal" class="form-label">Codigo Postal</label>
                            <input type="number" class="form-control" id="codigopostal_edit" name="codigopostal_nuevo" tabindex="1" placeholder="" value="" required>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex mt-2">
                        <div>
                            {{-- Direccion --}}
    <div class="d-flex justify-content-end mt-4">
        <button id="btnnuevadireccion" class="btn btn-success"><i class="fa-sharp fa-solid fa-plus"></i> Agregar
            otra di</button>
    </div>
    <div class="modal"  id="nuevadireccion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
              {{-- /////////INFORMACION DE DIRECCION --}}
              <h5 class="text-center"> Tu dirección</h5>
              <div class="d-flex">
                  <div class="col-sm-4 me-2">
                      <label for="clidir_calle" class="form-label">Calle</label>
                      <input type="text" class="form-control" id="calle_edit" name="calle_edit" tabindex="1" placeholder="" value="" required>
                  </div>
                  <div class="col-sm-1 me-2">
                      <label for="clidir_numext" class="form-label">Numero</label>
                      <input type="text" class="form-control" id="numext_edit" name="numext_edit" tabindex="1" placeholder="" value="" required>
                  </div>
                  <div class="col-sm-1 me-2">
                      <label for="clidir_numint" class="form-label">Interior</label>
                      <input type="text" class="form-control" id="numint_edit" name="numint_edit"  tabindex="1" placeholder="" value="" required>
                  </div>
                  <div class="col-sm-3 me-2">
                      <label for="clidir_colonia" class="form-label">Colonia</label>
                      <input type="text" class="form-control" id="colonia_edit" name="colonia_edit" tabindex="1" placeholder="" value="" required>
                  </div>
              </div>

              <div class="d-flex">    
                  <div class="col-sm-3 me-2">
                      <label for="clidir_municipio" class="form-label">Municipio</label>
                      <input type="text" class="form-control" id="municipio_edit" name="municipio_edit" tabindex="1" placeholder="" value="" required>
                  </div>
                  <div class="col-sm-2 me-2">
                      <label for="clidir_estado" class="form-label">Estado</label>
                      <input type="text" class="form-control" id="estado_edit" name="estado_edit"  tabindex="1" placeholder="" value="" required>
                  </div>
                  <div class="col-sm-2 me-2">
                      <label for="clidir_pais" class="form-label">Pais</label>
                      <input type="text" class="form-control" id="pais_edit" name="pais_edit" tabindex="1" placeholder="" value="" required>
                  </div>
                  <div class="col-sm-2 me-2">
                      <label for="clidir_codigopostal" class="form-label">Codigo Postal</label>
                      <input type="number" class="form-control" id="codigopostal_edit" name="codigopostal_nuevo" tabindex="1" placeholder="" value="" required>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btncerrarmodaldireccion" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
            <button type="button" id="btnguardarmodeldireccion" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>
                        </div>
                    </div>
                </div>  



                
                <div class="modal-footer">

                    <button type="button" id="btncerrarmodaledit" class="btn btn-secondary"
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
            $tbl_listado = $('#clientes').DataTable({
                ajax: {
                    "url": "{{ route('admin.listado_clientes') }}",
                    "type": "GET",
                    "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    "dataSrc": "" },
                "columns": [
                        {data: 'cli_id' },
                        {data: 'cli_razon_social' },
                        {data: 'cli_rfc' },
                        {data: 'cli_telefono'},
                        {data: 'cli_contacto'},
                        {data: 'cli_estado'},
                        {data: 'cli_email'},
                        {data: 'acciones'}
                        ],

                "columnDefs": [{
                    "targets": 7,
                    "sorteable": false,
                    "render": function(data, type, full, meta) {
                    return '<span   class="btnconsultacliente text-primary " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Consultar"> <i class="fas fa-search fa-lg"> </i></span>' +
                            '<span   class="btneditarcliente text-success " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Editar"> <i class="fas fa-pencil fa-lg"> </i></span>';
                              }
                    }],
                "language": { "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}
            });
        })

        // //////// BOTON DE CONSULTA DEL CLIENTE ///////////

        $(document).on( 'click', '.btnconsultacliente', function () {
            $datos =  $tbl_listado.row( $(this).parents('tr') ).data();
            $indice =  $tbl_listado.row( $(this).parents('tr') ).index();
            $cli_id = $datos['cli_id'];      
            $(location).prop('href', 'http://127.0.0.1:8000/cliente_show/'+$cli_id);
        });


        $(function() {
            $('#nuevadireccion').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });
        //// modal de direccion agregar
        $(function() {
            $(document).on('click', '#btnnuevadireccion', function() {
                $('#nuevadireccion').modal('show');
            });
        });
        //////////// guardar registro de direccion

$(function() {
            $(document).on('click', '#btnguardarnuevomodal', function() {
                
                //------->variables de direccion clidir user nuevo<-------
                $clidir_calle =  $('#calle_nuevo').val();
                $clidir_numext   =  $('#numext_nuevo').val();
                $clidir_numint =  $('#numint_nuevo').val();
                $clidir_colonia =  $('#colonia_nuevo').val();
                $clidir_municipio =  $('#municipio_nuevo').val();
                $clidir_estado =  $('#estado_nuevo').val();
                $clidir_pais =  $('#pais_nuevo').val();
                $clidir_codigopostal =  $('#codigopostal_nuevo').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('inserta_nueva_direccion') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {
                        cli_id: $cli_id,
                        //------->Datos de direccion clidir<-------
                        clidir_calle:$clidir_calle,
                        clidir_numext:$clidir_numext   ,
                        clidir_numint: $clidir_numint ,
                        clidir_colonia:  $clidir_colonia ,
                        clidir_municipio:$clidir_municipio ,
                        clidir_estado:$clidir_estado ,
                        clidir_pais:$clidir_pais,
                        clidir_codigopostal:$clidir_codigopostal,
                    },
                    success: function(data) {
                        // console.log(data);
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.info('Se registro Cliente');
                        $('#nuevadireccion').modal('hide');
                        window.location.href = "cat_clientes";

                    }
                });
            });
        });





        // ////////////  Agregar cliente /////////////////////
        // Configuracion del modal 
        $(function() {
            $('#nuevocliente').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });

        // Muestra modal al dar click nuevo cliente
        $(function() {
            $(document).on('click', '#btnnuevocliente', function() {
                $('#nuevocliente').modal('show');
            });
        });

        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarnuevomodal', function() {
                $cli_contacto = $('#nombre_nuevo').val();
                $cli_razon_social = $('#razonsocial_nuevo').val();
                $cli_tipocliente= $('#tipo_nuevo').val();
                $cli_rfc =  $('#rfc_nuevo').val();
                $cli_telefono   =  $('#telefono_nuevo').val();
                $cli_celular   =  $('#celular_nuevo').val();
                $cli_email =  $('#email_nuevo').val();
                $cli_fecha = $('#fecha_nuevo').val();
                $cli_diascredito =  $('#diascredito_nuevo').val();
                $cli_montocredito =  $('#montocredito_nuevo').val();
                //------->variables de direccion clidir user nuevo<-------
                $clidir_calle =  $('#calle_nuevo').val();
                $clidir_numext   =  $('#numext_nuevo').val();
                $clidir_numint =  $('#numint_nuevo').val();
                $clidir_colonia =  $('#colonia_nuevo').val();
                $clidir_municipio =  $('#municipio_nuevo').val();
                $clidir_estado =  $('#estado_nuevo').val();
                $clidir_pais =  $('#pais_nuevo').val();
                $clidir_codigopostal =  $('#codigopostal_nuevo').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{ route('inserta_cliente') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {

                        cli_contacto: $cli_contacto,
                        cli_razon_social: $cli_razon_social,
                        cli_tipocliente: $cli_tipocliente,
                        cli_rfc:    $cli_rfc ,
                        cli_telefono:    $cli_telefono   ,
                        cli_celular: $cli_celular,
                        cli_email:    $cli_email ,
                        cli_fecha: $cli_fecha,
                        cli_diascredito: $cli_diascredito  ,
                        cli_montocredito: $cli_montocredito,
                        //------->Datos de direccion clidir<-------
                        clidir_calle:$clidir_calle,
                        clidir_numext:$clidir_numext   ,
                        clidir_numint: $clidir_numint ,
                        clidir_colonia:  $clidir_colonia ,
                        clidir_municipio:$clidir_municipio ,
                        clidir_estado:$clidir_estado ,
                        clidir_pais:$clidir_pais,
                        clidir_codigopostal:$clidir_codigopostal,
                    },
                    success: function(data) {
                        // console.log(data);
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'slideUp';
                        toastr.info('Se registro Cliente');
                        $('#nuevocliente').modal('hide');
                        window.location.href = "cat_clientes";

                    }
                });
            });
        });
        /////////

        //////////////  Editar cliente  //////////////////////////
        // Configuracion del modal editar
        $(function() {
            $('#editarcliente').modal({
                backdrop: 'static',
                keyboard: false,
                show: false,
                focus: true,
                refresh: true
            });
        });

        // Muestra modal al dar click
        $(function() {
            $(document).on('click', '.btneditarcliente', function() {
                $indice_registro = $tbl_listado.row($(this).parents('tr')).index();
                $id = $tbl_listado.cell($indice_registro, 0).data();
                // console.log($id);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: "{{ route('edita_cliente') }}",
                    method: "GET",
                    dataType: 'JSON',
                    data: {cli_id: $id  },
                    success: function(data) {
                        // console.log(data);
                        $id_edit = document.querySelector('#id_edit');
                        $id_edit.setAttribute("value", data.cli_id);

                        $nombre_edit = document.querySelector('#nombre_edit');
                        $nombre_edit.setAttribute("value", data.cli_contacto);

                        $razonsocial_edit = document.querySelector('#razonsocial_edit');
                        $razonsocial_edit.setAttribute("value", data.cli_razon_social);

                        $rfc_edit  = document.querySelector('#rfc_edit');
                        $rfc_edit.setAttribute("value",data.cli_rfc);

                        $telefono_edit  = document.querySelector('#telefono_edit');
                        $telefono_edit.setAttribute("value",data.cli_telefono);

                        $celular_edit  = document.querySelector('#celular_edit');
                        $celular_edit.setAttribute("value",data.cli_celular);

                        $email_edit  = document.querySelector('#email_edit');
                        $email_edit.setAttribute("value",data.cli_email);

                        $tipo_edit  = document.querySelector('#tipo_edit');
                        $tipo_edit.setAttribute("value",data.cli_tipocliente);

                        $diascredito_edit  = document.querySelector('#diascredito_edit');
                        $diascredito_edit.setAttribute("value",data.cli_diascredito);

                        $montocredito_edit  = document.querySelector('#montocredito_edit');
                        $montocredito_edit.setAttribute("value",data.cli_montocredito);
                    


                          ////// MUESTRA DATOS DE DIRECCION FISCAL EN EL MODAL
                        $.ajax({    
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            url: "{{ route('edita_cliente_direccion') }}",
                            method: "GET",
                            dataType: 'JSON',
                            data: {cli_id: $id},
                            success: function(data) {
                                // console.log(data);
                                $clidir_calle = document.querySelector('#calle_edit');
                                $clidir_calle.setAttribute("value", data[0].clidir_calle);

                                $clidir_numext = document.querySelector('#numext_edit');
                                $clidir_numext.setAttribute("value", data[0].clidir_numext);

                                $clidir_numint = document.querySelector('#numint_edit');
                                $clidir_numint.setAttribute("value", data[0].clidir_numint);

                                $clidir_colonia = document.querySelector('#colonia_edit');
                                $clidir_colonia.setAttribute("value", data[0].clidir_colonia);

                                $clidir_municipio = document.querySelector('#municipio_edit');
                                $clidir_municipio.setAttribute("value", data[0].clidir_municipio);

                                $clidir_estado = document.querySelector('#estado_edit');
                                $clidir_estado.setAttribute("value", data[0].clidir_estado);
                                
                                $clidir_pais = document.querySelector('#pais_edit');
                                $clidir_pais.setAttribute("value", data[0].clidir_pais);

                                $clidir_codigopostal = document.querySelector('#codigopostal_edit');
                                $clidir_codigopostal.setAttribute("value", data[0].clidir_codigopostal);

                            }
                                //cierre de edita_cliente_direccion
                        });
                    }
                });

                $('#editarcliente').modal('show');
            });
        });

        // Guardar Registro
        $(function() {
            $(document).on('click', '#btnguardarmodeledit', function() {
                $cli_id = $('#id_edit').val();
                $cli_contacto = $('#nombre_edit').val();
                $cli_razon_social = $('#razonsocial_edit').val();
                $cli_rfc =  $('#rfc_edit').val();
                $cli_tipocliente =  $('#tipo_edit').val();
                $cli_telefono   =  $('#telefono_edit').val();
                $cli_celular   =  $('#celular_edit').val();
                $cli_email =  $('#email_edit').val();
                // $cli_estado =  $('#status_edit').val();
                $cli_diascredito =  $('#diascredito_edit').val();
                $cli_montocredito =  $('#montocredito_edit').val();

                //------->variables de direccion clidir user actualizar<-------

                $clidir_calle =  $('#calle_edit').val();
                $clidir_numext =  $('#numext_edit').val();
                $clidir_numint =  $('#numint_edit').val();
                $clidir_colonia =  $('#colonia_edit').val();
                $clidir_municipio =  $('#municipio_edit').val();
                $clidir_estado =  $('#estado_edit').val();
                $clidir_pais =  $('#pais_edit').val();
                $clidir_codigopostal =  $('#codigopostal_edit').val();
                

                //console.log(data);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: "{{ route('actualiza_cliente') }}",
                    method: "GET",
                    dataType: 'JSON',
                    //   dataSrc: "",
                    data: {
                        cli_id: $cli_id,
                        cli_contacto: $cli_contacto,
                        cli_razon_social: $cli_razon_social,
                        cli_tipocliente:    $cli_tipocliente   ,
                        cli_rfc:    $cli_rfc ,
                        cli_telefono:    $cli_telefono   ,
                        cli_celular: $cli_celular,
                        cli_email:    $cli_email ,
                        cli_diascredito: $cli_diascredito  ,
                        cli_montocredito: $cli_montocredito,
                    
                    },
                    success: function(data) {
                        // alert('clienteactualizado');
                        $.ajax({
                                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                                url: "{{ route('actualiza_cliente_direccion') }}",
                                method: "GET",
                                dataType: 'JSON',
                                //   dataSrc: "",
                                data: { 
                                    cli_id: $cli_id,
                                    clidir_calle:$clidir_calle,
                                    clidir_numext:$clidir_numext   ,
                                    clidir_numint: $clidir_numint ,
                                    clidir_colonia:  $clidir_colonia ,
                                    clidir_municipio:$clidir_municipio ,
                                    clidir_estado:$clidir_estado ,
                                    clidir_pais:$clidir_pais,
                                    clidir_codigopostal:$clidir_codigopostal,
                                },
                                
                            success: function(data) {

                                // console.log(data);
                                toastr.options.showMethod = 'slideDown';
                                toastr.options.hideMethod = 'slideUp';
                                toastr.info('Se Actualizo el cliente');
                                $('#editarcliente').modal('hide');
                                window.location.href = "cat_clientes";

                            }
                        });
                    }
                });
                
            });
        });
        /////
    </script>
    <script src="https://kit.fontawesome.com/5a948d3270.js" crossorigin="anonymous"></script>
    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    
@endsection
