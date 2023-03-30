<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12">
                    <form action="{{ route('cotizaciones.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="folio">Folio</label>
                            <input type="text" class="form-control" name="folio" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="razonsocial">Razon Social</label>
                            <input type="text" class="form-control" name="razonsocial" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" name="fecha">
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" class="form-control" name="total" required maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="vendedor">Vendedor</label>
                            <input type="text" class="form-control" name="vendedor" required maxlength="50">
                        </div>
                        <div class="form-group mb-2">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" name="estado" required maxlength="50">
                        </div>
                        <div class="modal-footer d-flex justify-content-end mt-2">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-success me-3" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
