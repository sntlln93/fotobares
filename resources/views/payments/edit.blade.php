@extends('layouts.app')

@section('title', 'Modificar cuotas')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Modificar cuotas de {{ $sale->client->full_name }}</h1>
</div>

<div class="card">
    <div class="card-header">Formulario de modificación de cuotas</div>
    <div class="card-body">
        <form action="{{ route('recalculate', ['sale' => $sale->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @foreach ($sale->details as $detail)
            <div class="form-row mb-2">
                <div class="col-sm-12">
                    @include('_partials.detail')
                </div>
            </div>
            @endforeach

            <div id="payment-part" class="content" role="tabpanel" aria-labelledby="payment-part-trigger">
                <h1 class="h4 text-gray-800">Pago</h1>
                <div class="form-row mb-2">
                    <div class="col-12 col-md-8">
                        <label for="quota_id">Cantidad de cuotas</label>
                        <select class="custom-select @error('quota_id') is-invalid @enderror" id="quota_id"
                            name="quota_id">
                            <option></option>
                            @foreach ($quotas as $quota)
                            <option value="{{ $quota->id }}" data-total="{{ $quota->quantity * $quota->quota_amount }}">
                                {{"$quota->quantity cuotas | Valor de la cuota: $$quota->quota_amount" }}
                            </option>
                            @endforeach
                        </select>
                        @error('quota_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="quotaValidation">Total</label>
                        <input class="form-control" id="total" disabled>
                    </div>
                </div>

                <h1 class="h4 mt-5 text-gray-800">Fechas</h1>
                <div class="form-row mb-2">
                    <div class="col-12 col-md-6">
                        <label for="deliver_date">Día de entrega</label>
                        <input type="date" id="deliver_date" class="form-control"
                            value="{{ $sale->deliver_on->format('Y-m-d') }}" disabled>
                    </div>


                    <div class="col-12 col-md-6">
                        <label for="hourValidation">Hora aproximada <small>(opcional)</small></label>
                        <input type="text" class="form-control @error('hour') is-invalid @enderror" id="hourValidation"
                            name="hour" placeholder="La hora a la que más probablemente encuentres a tu cliente en casa"
                            value="{{ old('hour') }}">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Modificar cuotas</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')

<script>
    document.querySelector("#quota_id").addEventListener("change", (event) => {
        document.querySelector("#total").value = `$${event.target.options[event.target.selectedIndex].dataset.total}`;
    });
</script>

@endsection