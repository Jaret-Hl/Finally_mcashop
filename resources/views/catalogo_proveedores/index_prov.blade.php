@extends('layouts.app')
@extends('setmenu')


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

@endsection

@section('title', 'Catalogo Proveedores')

@section('content')
    <div class="container">
        <h4 class="text-start mt-2">Catálogo proveedores</h4>
        <div class="d-flex justify-content-end mt-4">
            <button id="btnnuevoproveedor" class="btn btn-success"><i class="fa-sharp fa-solid fa-plus"></i> Agregar
                Proveedores</button>
        </div>

        <div class="row">

            <div class="card mt-3">
                <div class="card-body">
                    <table id="proveedores" class="table table-striped shadow-lg mt-4" style="width:100%">
                        <thead class="bg-primary  text-white">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Razon Social</th>
                                <th scope="col">Contacto</th>
                                <th scope="col">RFC</th>
                                <th scope="col">Sitio Web</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Fecha Alta</th>
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
    <div class="modal fade" id="nuevoproveedor" name="nuevoproveedor" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div class="container-fluid">
                        <form>
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="d-flex">

                                <div class="form-group col-4 me-2">
                                    <label for="pro_contacto" class="form-label">Contacto</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        value="{{ old('pro_contacto') }}" autofocus id="pro_contacto" name="pro_contacto"
                                        placeholder="Inserta nombre completo" onkeyup="cleanspan(this);">
                                    {{-- {!! $errors->first('pro_contacto', '<small class="text-danger">:message</small>') !!} --}}
                                    <span class="text-danger" id="contactoError"></span>
                                </div>
                                <div class="form-group col-3 me-2">
                                    <label for="pro_razon_social" class="form-label">Razon Social</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_razon_social" value="{{ old('pro_razon_social') }}" name="pro_razon_social"
                                        tabindex="1" placeholder="" onkeyup="cleanspan(this);">
                                    <span class="text-danger" id="razonsocialError"></span>

                                </div>
                                <div class="form-group col-2 me-2">
                                    <label for="pro_rfc" class="form-label">RFC</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_rfc" name="pro_rfc" tabindex="1" placeholder="Tu RFC*"
                                        value="{{ old('pro_rfc') }}" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="rfcError"></span>

                                </div>
                                <div class="form-group col-2 me-2">
                                    <label for="pro_sitioweb" class="form-label">Sitio Web</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_sitioweb" name="pro_sitioweb" tabindex="1" placeholder="Inserta el sitio*"
                                        value="{{ old('pro_sitioweb') }}" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="sitiowebError"></span>

                                </div>
                            </div>
                            <div class="d-flex justify-content-start mt-2">
                                <div class="form-group col-sm-1 me-2">
                                    <label for="pro_creditodias" class="form-label">Credito dias</label>
                                    <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_creditodias" name="pro_creditodias" tabindex="1" placeholder="*"
                                        value="" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="creditodiasError"></span>

                                </div>
                                <div class="form-group col-sm-2 me-2">
                                    <label for="pro_creditomonto" class="form-label">Monto de credito</label>
                                    <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_creditomonto" name="pro_creditomonto" tabindex="1" placeholder=""
                                        value="" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="montocreditoError"></span>

                                </div>
                                <div class="form-group col-sm-3 me-2">
                                    <label for="pro_email" class="form-label">Email</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_email" name="pro_email" tabindex="1" placeholder="Tu Email*"
                                        value="" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="emailError"></span>

                                </div>
                                <div class="form-group col-sm-2 me-2">
                                    <label for="pro_fechaalta" class="form-label">Fecha</label>
                                    <input type="date" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_fechaalta" name="pro_fechaalta" tabindex="1" placeholder=""
                                        value="" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="fechaError"></span>

                                </div>
                                <div class="form-group col-sm-1 me-2">
                                    <label for="pro_dias_vencimiento" class="form-label">Vencimiento</label>
                                    <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_dias_vencimiento" name="pro_dias_vencimiento"
                                        tabindex="1" placeholder="No. Dias" value=""  onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="vencimientoError"></span>

                                </div>
                                <div class="form-group col-sm-2">
                                    <label for="pro_subtipo" class="form-label">Subtipo</label>
                                    <select id="pro_subtipo" value="{{ old('pro_subtipo') }}" 
                                        class="form-select bg-warning bg-opacity-25  border-info"
                                        aria-label="Default select example">

                                        <option selected value="BIENES">BIENES</option>
                                        <option value="SERVICIOS">SERVICIOS</option>
                                    </select>
                                    <span class="text-danger" id="subError"></span>
                                </div>
                            </div>
                            <hr>
                            {{-- /////////INFORMACION DE DIRECCION --}}
                            

                            <h5 class="text-center"> Tu dirección</h5>
                            <div class="d-flex">
                                <div class="form-group col-sm-4 me-2">
                                    <label for="prodir_calle" class="form-label">Calle</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_calle" name="prodir_calle" tabindex="1" placeholder=""
                                        value="{{ old('prodir_calle') }}" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="calleError"></span>
                                </div>
                                <div class="form-group col-sm-1 me-2">
                                    <label for="prodir_numext" class="form-label">Numero</label>
                                    <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_numext" name="prodir_numext" tabindex="1" placeholder=""
                                        value="{{ old('prodir_numext') }}" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="numextError"></span>                                        
                                </div>
                                <div class="form-group col-sm-1 me-2">
                                    <label for="prodir_numint" class="form-label">Interior</label>
                                    <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_numint" name="prodir_numint" tabindex="1" placeholder=""
                                        value="{{ old('prodir_numint') }}" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="numintError"></span>
                                </div>
                                <div class="form-group col-sm-3 me-2">
                                    <label for="prodir_colonia" class="form-label">Colonia</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_colonia" name="prodir_colonia" tabindex="1" placeholder=""
                                        value="{{ old('prodir_colonia') }}" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="coloniaError"></span>
                                </div>
                                {{-- <div class="form-group col-sm-2 me-2">
                                    <label for="pro_nombre" class="form-label">Nombre de almacen</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="pro_nombre" name="pro_nombre"
                                        tabindex="1"placeholder="" value="" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="Error"></span>
                                </div> --}}
                            </div>
                            <div class="d-flex">
                                <div class="form-group col-sm-3 me-2">
                                    <label for="prodir_municipio" class="form-label">Municipio</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_municipio" name="prodir_municipio" tabindex="1" placeholder=""
                                        value="{{ old('prodir_municipio') }}" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="municipioError"></span>
                                </div>
                                <div class="form-group col-sm-2 me-2">
                                    <label for="prodir_estado" class="form-label">Estado</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_estado" name="prodir_estado" tabindex="1" placeholder=""
                                        value="" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="estadoError"></span>
                                </div>
                                <div class="form-group col-sm-2 me-2">
                                    <label for="prodir_pais" class="form-label">Pais</label>
                                    <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_pais" name="prodir_pais" tabindex="1" placeholder="" value=""
                                        onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="paisError"></span>
                                </div>
                                <div class="form-group col-sm-2 me-2">
                                    <label for="prodir_codigopostal" class="form-label">Codigo Postal</label>
                                    <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                        id="prodir_codigopostal" name="prodir_codigopostal" tabindex="1" placeholder=""
                                        value="" onkeyup="cleanspan(this);">
                                        <span class="text-danger" id="codigopostalError"></span>
                                </div>

                            </div>
                            {{-- boton de guardar --}}
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-success btn-submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- EDITAR CLIENTE --}}
    <div class="modal fade" id="editarproveedor" name="editarproveedor" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-start">

                            <div class="col-sm-1 me-2">
                                <fieldset disabled>
                                    <label for="pro_id" class="form-label">id</label>
                                    <input type="text" class="form-control" id="id_edit" name='id_nuevo'
                                        tabindex="1" placeholder="" value="" required>
                                </fieldset>
                            </div>
                            <div class="col-4 me-2">
                                <label for="pro_contacto" class="form-label">Contacto</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="contacto_edit" name="contacto_edit" tabindex="1"
                                    placeholder="Inserta nombre completo" value="" required>
                            </div>
                            <div class="col-2 me-2">
                                <label for="pro_razon_social" class="form-label">Razon Social</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="razonsocial_edit" name="razonsocial_edit" tabindex="1" placeholder=""
                                    value="" required>
                            </div>
                            <div class="col-sm-2 me-2">
                                <label for="pro_rfc" class="form-label">RFC</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="rfc_edit" name="rfc_edit" tabindex="1" placeholder="Tu RFC*" value=""
                                    required>
                            </div>
                            <div class="col-sm-2 me-2">
                                <label for="pro_sitioweb" class="form-label">Sitio Web</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="sitioweb_edit" name="sitioweb_edit" tabindex="1"
                                    placeholder="Inserta el sitio*" value="" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <div class="col-sm-2 me-2">
                                <label for="pro_creditodias" class="form-label">Credito dias</label>
                                <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="credito_edit" name="credito_edit" tabindex="1" placeholder="*" value=""
                                    required>
                            </div>
                            <div class="col-sm-2 me-2">
                                <label for="pro_creditomonto" class="form-label">Monto de credito</label>
                                <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="monto_edit" name="monto_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                            <div class="col-sm-3 me-2">
                                <label for="pro_email" class="form-label">Email</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="email_edit" name="email_edit" tabindex="1" placeholder="Tu Email*"
                                    value="" required>
                            </div>
                            <div class="col-sm-2 me-2">
                                <label for="pro_fechaalta" class="form-label">Fecha</label>
                                <input type="date" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="fecha_edit" name="vendedor_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start">
                            <div class="col-sm-2 me-2">
                                <label for="pro_dias_vencimiento" class="form-label">Dias de vencimiento</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="diasvencimiento_edit" name="diasvencimiento_edit" tabindex="1"placeholder=""
                                    value="" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="pro_subtipo" class="form-label">Subtipo</label>
                                <select id="subtipo_edit" class="form-select bg-warning bg-opacity-25  border-info"
                                    aria-label="Default select example">

                                    <option selected value="BIENES">BIENES</option>
                                    <option value="SERVICIOS">SERVICIOS</option>
                                </select>
                            </div>

                        </div>

                        <hr>

                        {{-- /////////INFORMACION DE DIRECCION --}}
                        <h5 class="text-center"> Tu dirección</h5>
                        <div class="d-flex">
                            <div class="col-sm-4 me-2">
                                <label for="prodir_calle" class="form-label">Calle</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="calle_edit" name="calle_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                            <div class="col-sm-1 me-2">
                                <label for="prodir_numext" class="form-label">Numero</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="numext_edit" name="numext_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                            <div class="col-sm-1 me-2">
                                <label for="prodir_numint" class="form-label">Interior</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="numint_edit" name="numint_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                            <div class="col-sm-3 me-2">
                                <label for="prodir_colonia" class="form-label">Colonia</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="colonia_edit" name="colonia_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-sm-3 me-2">
                                <label for="prodir_municipio" class="form-label">Municipio</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="municipio_edit" name="municipio_edit" tabindex="1" placeholder=""
                                    value="" required>
                            </div>
                            <div class="col-sm-2 me-2">
                                <label for="prodir_estado" class="form-label">Estado</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="estado_edit" name="estado_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                            <div class="col-sm-2 me-2">
                                <label for="prodir_pais" class="form-label">Pais</label>
                                <input type="text" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="pais_edit" name="pais_edit" tabindex="1" placeholder="" value=""
                                    required>
                            </div>
                            <div class="col-sm-2 me-2">
                                <label for="prodir_codigopostal" class="form-label">Codigo Postal</label>
                                <input type="number" class="form-control bg-warning bg-opacity-25  border-info"
                                    id="codigopostal_edit" name="codigopostal_edit" tabindex="1" placeholder=""
                                    value="" required>
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
            function cleanspan(obj){
            var strLength = obj.value.length;
            if(strLength > 0){                
                $span = document.getElementById("contactoError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("razonsocialError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("rfcError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("sitiowebError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("creditodiasError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("montocreditoError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("emailError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("fechaError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("vencimientoError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("subError").textContent ='';                               
            }
            // Direccion datos
            if(strLength > 0){                
                $span = document.getElementById("calleError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("numextError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("numintError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("coloniaError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("municipioError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("estadoError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("paisError").textContent ='';                               
            }
            if(strLength > 0){                
                $span = document.getElementById("codigopostalError").textContent ='';                               
            }
        }
            //guardar registro 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".btn-submit").click(function(e) {

                e.preventDefault();

                var procontacto = $("#pro_contacto").val();
                var prorazon_social = $("#pro_razon_social").val();
                var prorfc = $("#pro_rfc").val();
                var prositioweb = $("#pro_sitioweb").val();
                var proemail = $("#pro_email").val();
                var profechaalta = $("#pro_fechaalta").val();
                var procreditodias = $("#pro_creditodias").val();
                var procreditomonto = $("#pro_creditomonto").val();
                var prodiasvencimiento = $("#pro_dias_vencimiento").val();
                var prosubtipo = $("#pro_subtipo").val();
                // ///datos direccion
                var prodircalle = $("#prodir_calle").val();
                var prodirnumext = $("#prodir_numext").val();
                var prodirnumint = $("#prodir_numint").val();
                var prodircolonia = $("#prodir_colonia").val();
                var prodirmunicipio = $("#prodir_municipio").val();
                var prodirestado = $("#prodir_estado").val();
                var prodirpais = $("#prodir_pais").val();
                var prodircodigopostal = $("#prodir_codigopostal").val();

                $.ajax({
                    type: 'get',
                    url: "{{ route('inserta_nuevo_proveedor') }}",
                    data: {
                        procontacto: procontacto,
                        prorazonsocial: prorazon_social,
                        prorfc: prorfc,
                        prositioweb: prositioweb,
                        proemail: proemail,
                        profechaalta: profechaalta,
                        procreditodias: procreditodias,
                        procreditomonto: procreditomonto,
                        prodiasvencimiento: prodiasvencimiento,
                        prosubtipo: prosubtipo,
                        // ///data direccion
                        prodircalle:prodircalle,
                        prodirnumext:prodirnumext   ,
                        prodirnumint:prodirnumint ,
                        prodircolonia:prodircolonia ,
                        prodirmunicipio:prodirmunicipio ,
                        prodirestado:prodirestado ,
                        prodirpais:prodirpais,
                        prodircodigopostal:prodircodigopostal
                    },

                    success: function(data) {
                        // console.log(data.error[0]);
                        
                        $listado = data.error;
                        $.each($listado, function(index, value) {
                        console.log(value);
                        $posicion =   value.indexOf('procontacto');
                        if($posicion>0){
                            document.getElementById("contactoError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prorazonsocial');
                        if($posicion>0){
                            document.getElementById("razonsocialError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prorfc');
                        if($posicion>0){
                            document.getElementById("rfcError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prositioweb');
                        if($posicion>0){
                            document.getElementById("sitiowebError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('procreditodias');
                        if($posicion>0){
                            document.getElementById("creditodiasError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('procreditomonto');
                        if($posicion>0){
                            document.getElementById("montocreditoError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('proemail');
                        if($posicion>0){
                            document.getElementById("emailError").textContent ='El campo email debe ser una dirección de correo válida.';
                        }
                        $posicion =   value.indexOf('profechaalta');
                        if($posicion>0){
                            document.getElementById("fechaError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prodiasvencimiento');
                        if($posicion>0){
                            document.getElementById("vencimientoError").textContent ='Campo requerido';
                        }
                        // $posicion =   value.indexOf('prosubtipo');
                        // if($posicion>0){
                        //     document.getElementById("subError").textContent ='Campo requerido';
                        //}
                       
                        $posicion =   value.indexOf('prodircalle');
                        if($posicion>1){
                            document.getElementById("calleError").textContent ='El campo calle solo puede contener letras.';
                        }
                        $posicion =   value.indexOf('prodirnumext');
                        if($posicion>0){
                            document.getElementById("numextError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prodirnumint');
                        if($posicion>0){
                            document.getElementById("numintError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prodircolonia');
                        if($posicion>0){
                            document.getElementById("coloniaError").textContent ='Campo requerido';
                        }
                        
                        $posicion =   value.indexOf('prodirmunicipio');
                        if($posicion>1){
                            document.getElementById("municipioError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prodirestado');
                        if($posicion>0){
                            document.getElementById("estadoError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prodirpais');
                        if($posicion>0){
                            document.getElementById("paisError").textContent ='Campo requerido';
                        }
                        $posicion =   value.indexOf('prodircodigopostal');
                        if($posicion>0){
                            document.getElementById("codigopostalError").textContent ='Campo requerido';
                        }
                    });
                    alert($listado);
                    // location.reload($posicion);
                        
                        
                        
                        
                        
                    }
                });

            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        </script>
        <script>
            $(document).ready(function() {
                $tbl_listado = $('#proveedores').DataTable({
                    ajax: {
                        "url": "{{ route('listado_proveedores') }}",
                        "type": "GET",
                        "headers": {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        "dataSrc": ""
                    },
                    "columns": [{
                            data: 'pro_id'
                        },
                        {
                            data: 'pro_razon_social'
                        },
                        {
                            data: 'pro_contacto'
                        },
                        {
                            data: 'pro_rfc'
                        },
                        {
                            data: 'pro_sitioweb'
                        },
                        {
                            data: 'pro_estatus'
                        },
                        {
                            data: 'pro_fechaalta'
                        },
                        {
                            data: 'acciones'
                        }
                    ],

                    "columnDefs": [{
                        "targets": 7,
                        "sorteable": false,
                        "render": function(data, type, full, meta) {
                            return '<span   class="btnconsultaproveedor text-primary " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Consultar"> <i class="fas fa-search fa-lg"> </i></span>' +
                                '<span   class="btneditarproveedor text-success " style ="cursor:pointer;" data-bs-toggle ="tooltip" data-bs-placement ="top" title ="Editar"> <i class="fas fa-pencil fa-lg"> </i></span>';
                        }
                    }],
                    
                });
            })


            // //////// BOTON DE CONSULTA DEL CLIENTE ///////////

            $(document).on('click', '.btnconsultaproveedor', function() {
                $datos = $tbl_listado.row($(this).parents('tr')).data();
                $indice = $tbl_listado.row($(this).parents('tr')).index();
                $cli_id = $datos['cli_id'];
                $(location).prop('href', 'http://127.0.0.1:8000/proveedor_show/' + $cli_id);
            });

            // ////////////  Agregar cliente /////////////////////
            // Configuracion del modal 
            $(function() {
                $('#nuevoproveedor').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: false,
                    focus: true,
                    refresh: true
                });
            });

            // Muestra modal al dar click nuevo cliente
            $(function() {
                $(document).on('click', '#btnnuevoproveedor', function() {
                    $('#nuevoproveedor').modal('show');
                });
            });

            //////////////  Editar cliente  //////////////////////////
            // Configuracion del modal editar
            $(function() {
                $('#editarproveedor').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: false,
                    focus: true,
                    refresh: true
                });
            });

            // Muestra modal al dar click
            $(function() {
                $(document).on('click', '.btneditarproveedor', function() {
                    $indice_registro = $tbl_listado.row($(this).parents('tr')).index();
                    $id = $tbl_listado.cell($indice_registro, 0).data();
                    // console.log($id);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: "{{ route('edita_proveedor') }}",
                        method: "GET",
                        dataType: 'JSON',
                        data: {
                            pro_id: $id
                        },
                        success: function(data) {
                            console.log(data);
                            $id_edit = document.querySelector('#id_edit');
                            $id_edit.setAttribute("value", data.pro_id);

                            $contacto_edit = document.querySelector('#contacto_edit');
                            $contacto_edit.setAttribute("value", data.pro_contacto);

                            $razonsocial_edit = document.querySelector('#razonsocial_edit');
                            $razonsocial_edit.setAttribute("value", data.pro_razon_social);

                            $rfc_edit = document.querySelector('#rfc_edit');
                            $rfc_edit.setAttribute("value", data.pro_rfc);

                            $sitioweb_edit = document.querySelector('#sitioweb_edit');
                            $sitioweb_edit.setAttribute("value", data.pro_sitioweb);

                            $credito_edit = document.querySelector('#credito_edit');
                            $credito_edit.setAttribute("value", data.pro_creditodias);

                            $monto_edit = document.querySelector('#monto_edit');
                            $monto_edit.setAttribute("value", data.pro_creditomonto);

                            $email_edit = document.querySelector('#email_edit');
                            $email_edit.setAttribute("value", data.pro_email);

                            $fecha_edit = document.querySelector('#fecha_edit');
                            $fecha_edit.setAttribute("value", data.pro_fechaalta);

                            $diasvencimiento_edit = document.querySelector('#diasvencimiento_edit');
                            $diasvencimiento_edit.setAttribute("value", data.pro_dias_vencimiento);



                            ////// MUESTRA DATOS DE DIRECCION FISCAL EN EL MODAL
                            //aqui iria el ajax
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                url: "{{ route('edita_proveedor_direccion') }}",
                                method: "GET",
                                dataType: 'JSON',
                                data: {
                                    pro_id: $id
                                },
                                success: function(data) {
                                    console.log(data);
                                    $calle_edit = document.querySelector('#calle_edit');
                                    $calle_edit.setAttribute("value", data
                                        .prodir_calle);

                                    $prodir_numext = document.querySelector(
                                        '#numext_edit');
                                    $prodir_numext.setAttribute("value", data
                                        .prodir_numext);

                                    $prodir_numint = document.querySelector(
                                        '#numint_edit');
                                    $prodir_numint.setAttribute("value", data
                                        .prodir_numint);

                                    $prodir_colonia = document.querySelector(
                                        '#colonia_edit');
                                    $prodir_colonia.setAttribute("value", data
                                        .prodir_colonia);

                                    $prodir_municipio = document.querySelector(
                                        '#municipio_edit');
                                    $prodir_municipio.setAttribute("value", data
                                        .prodir_municipio);

                                    $prodir_estado = document.querySelector(
                                        '#estado_edit');
                                    $prodir_estado.setAttribute("value", data
                                        .prodir_estado);

                                    $prodir_pais = document.querySelector('#pais_edit');
                                    $prodir_pais.setAttribute("value", data
                                        .prodir_pais);

                                    $prodir_codigopostal = document.querySelector(
                                        '#codigopostal_edit');
                                    $prodir_codigopostal.setAttribute("value", data
                                        .prodir_codigopostal);

                                }
                                //cierre de edita_cliente_direccion
                            });
                            // cierre del ajax
                        }
                    });

                    $('#editarproveedor').modal('show');
                });
            });

            // Guardar Registro
            $(function() {
                $(document).on('click', '#btnguardarmodeledit', function() {
                    $pro_id = $('#id_edit').val();
                    $pro_contacto = $('#contacto_edit').val();
                    $pro_razon_social = $('#razonsocial_edit').val();
                    $pro_rfc = $('#rfc_edit').val();
                    $pro_sitioweb = $('#sitioweb_edit').val();
                    $pro_creditodias = $('#credito_edit').val();
                    $pro_creditomonto = $('#monto_edit').val();
                    $pro_email = $('#email_edit').val();
                    $pro_fechaalta = $('#fecha_edit').val();
                    $pro_dias_vencimiento = $('#diasvencimiento_edit').val();
                    $pro_subtipo = $('#subtipo_edit').val();

                    //------->variables de direccion prodir user actualizar<-------

                    $prodir_calle = $('#calle_edit').val();
                    $prodir_numext = $('#numext_edit').val();
                    $prodir_numint = $('#numint_edit').val();
                    $prodir_colonia = $('#colonia_edit').val();
                    $prodir_municipio = $('#municipio_edit').val();
                    $prodir_estado = $('#estado_edit').val();
                    $prodir_pais = $('#pais_edit').val();
                    $prodir_codigopostal = $('#codigopostal_edit').val();
                    //console.log(data);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: "{{ route('actualiza_proveedor') }}",
                        method: "GET",
                        dataType: 'JSON',
                        //   dataSrc: "",
                        data: {
                            pro_id: $pro_id,
                            pro_contacto: $pro_contacto,
                            pro_razon_social: $pro_razon_social,
                            pro_rfc: $pro_rfc,
                            pro_sitioweb: $pro_sitioweb,
                            pro_email: $pro_email,
                            pro_fechaalta: $pro_fechaalta,
                            pro_creditodias: $pro_creditodias,
                            pro_creditomonto: $pro_creditomonto,
                            pro_dias_vencimiento: $pro_dias_vencimiento,
                            pro_subtipo: $pro_subtipo

                        },
                        success: function(data) {
                            // alert('clienteactualizado');
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                url: "{{ route('actualiza_proveedor_direccion') }}",
                                method: "GET",
                                dataType: 'JSON',
                                //   dataSrc: "",
                                data: {
                                    pro_id: $pro_id,
                                    prodir_calle: $prodir_calle,
                                    prodir_numext: $prodir_numext,
                                    prodir_numint: $prodir_numint,
                                    prodir_colonia: $prodir_colonia,
                                    prodir_municipio: $prodir_municipio,
                                    prodir_estado: $prodir_estado,
                                    prodir_pais: $prodir_pais,
                                    prodir_codigopostal: $prodir_codigopostal,
                                },

                                success: function(data) {

                                    console.log(data);
                                    toastr.options.showMethod = 'slideDown';
                                    toastr.options.hideMethod = 'slideUp';
                                    toastr.info('Se Actualizo el proveedor');
                                    $('#editar').modal('hide');
                                    window.location.href = "catalogo_proveedores";

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
