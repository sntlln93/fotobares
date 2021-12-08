@extends('layouts.app')

@section('title', 'Modificar fecha de cobro')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Modificar fecha de cobro de Pago {{ $order }} de {{
            $sale->payments->count() }}</h6>
        {{ $sale->client->full_name }}
    </div>
    <div class="card-body">
        <form action="{{ route('postponed', ['payment' => $nextPayment]) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="amount">Nuevo vencimiento</label>
                    <input type="date" class="form-control" value="{{ $nextPayment->due_date->format('Y-m-d') }}"
                        name="due_date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="hourValidation">Hora aproximada <small>(opcional)</small></label>
                    <input type="text" class="form-control @error('hour') is-invalid @enderror" id="hourValidation"
                        name="hour" value="{{ old('hour', $nextPayment->hour) }}"
                        placeholder="La hora a la que más probablemente encuentres a tu cliente en casa">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    @if(!$nextPayment->previous_id)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="update_deliver_on" name="update_deliver_on"
                            value="true" checked>
                        <label class="form-check-label" for="update_deliver_on">Actualizar fecha de entrega</label>
                    </div>
                    @endif
                    @if($sale->delivered_at === null)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="update_following_payments"
                            name="update_following_payments" value="true" checked>
                        <label class="form-check-label" for="update_following_payments">Actualizar día de cobro de
                            los
                            siguientes
                            pagos</label>
                    </div>
                    @endif
                </div>
            </div>

            @if($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <div class="d-flex">
                <button class="btn btn-primary ml-auto mr-0" type="submit">Posponer pago</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/views/products/create.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
@endsection