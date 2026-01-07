<form action="{{ route('frontend.terceros.recibos.store', $persona->id) }}" method="POST" id="form-recibo-tercero">
  @csrf

  <div class="col-12">
    <div class="form-group">
      <label for="medio_pago_id" class="form-label">Medio de pago</label>
      <select name="medio_pago_id" id="medio_pago_id" class="form-control form-select" required>
        <option value="">-- Seleccione --</option>
        @foreach($medioPagos as $medio)
          <option value="{{ $medio->id }}">
            {{ $medio->codigo }} - {{ $medio->descripcion }}
          </option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <label for="descripcion" class="form-label">Descripción</label>
      <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <label for="observacion" class="form-label">Observación (opcional)</label>
      <textarea name="observacion" id="observacion" class="form-control" rows="1"></textarea>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-6">
          <label for="fecha_emision" class="form-label">Fecha de emisión</label>
          <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" required>
        </div>

        <div class="col-6">
          <label for="fecha_pago" class="form-label">Fecha de pago</label>
          <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required value="{{ now()->format('Y-m-d') }}">
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="form-group">
      <div class="row">
        <div class="col-6">
          <label for="importe" class="form-label">Importe</label>
          <input type="number" step="0.01" min="0" name="importe" id="importe" class="form-control" required>
        </div>

        <div class="col-2">
          ¿Aplica retención?
          <div class="form-check">
            <input type="radio" name="retencion" id="retencion_si" class="form-check-input" value="1" checked>
            <label for="retencion_si" class="form-check-label">Si</label>
          </div>
          <div class="form-check">
            <input type="radio" name="retencion" id="retencion_no" class="form-check-input" value="0">
            <label for="retencion_no" class="form-check-label">No</label>
          </div>
        </div>

        <div class="col-4">
          <label for="importe_retenido" class="form-label">Importe retenido</label>
          <input type="number" step="0.01" name="importe_retenido" id="importe_retenido" class="form-control" readonly>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 text-end">
    <div class="form-group">
      <button type="submit" class="btn btn-success">Guardar</button>
    </div>
  </div>
</form>
