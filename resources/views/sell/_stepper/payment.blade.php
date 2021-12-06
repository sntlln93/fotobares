<div class="form-row mb-2">
    <div class="col-12 col-md-8">
        <label for="quota_id">Cantidad de cuotas</label>
        <select class="custom-select @error('quota_id') is-invalid @enderror" id="quota_id" name="quota_id" @if(!
            old('product_id')) disabled @endif>
            <option></option>
        </select>
        @error('quota_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-12 col-md-4">
        <label for="quotaValidation">Total</label>
        <input class="form-control" id="total" disabled>
    </div>

    <div class="col-12">
        <label for="payment_description">Descripción
            <small>(opcional)</small></label>
        <input type="text" class="form-control @error('payment_description') is-invalid @enderror"
            id="payment_description" name="payment_description" placeholder="Ingresá información referida a los pagos"
            value="{{ old('payment_description') }}">
    </div>
</div>

<h1 class="h4 mt-5 text-gray-800">Fechas</h1>
<div class="form-row mb-2">
    <div class="col-12 col-md-6">
        <label for="deliver_date">Día de entrega</label>
        <input type="date" class="form-control @error('deliver_date') is-invalid @enderror" id="deliver_date"
            name="deliver_date" placeholder="Indicá qué fecha realizas la entrega"
            min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}" value="{{ old('deliver_date') }}">
        @error('deliver_date')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>


    <div class="col-12 col-md-6">
        <label for="hourValidation">Hora aproximada <small>(opcional)</small></label>
        <input type="text" class="form-control @error('hour') is-invalid @enderror" id="hourValidation" name="hour"
            placeholder="La hora a la que más probablemente encuentres a tu cliente en casa" value="{{ old('hour') }}">
    </div>
</div>