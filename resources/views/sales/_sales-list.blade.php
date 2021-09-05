@forelse ($sales as $sale)
<li class="list-group-item d-flex align-items-center flex-wrap">

    <div class="d-flex flex-column">
        <p class="mb-0">
            <b>Cliente:</b>
            <a href="{{ route('clients.show', ['client' => $sale->client_id]) }}">{{ $sale->client->full_name }}</a>
            @if($sale->delivered_at) <span class="badge badge-info">entregado</span> @endif
        </p>
        <p class="mb-0">
            <b>Producto:</b>
            @foreach ($sale->details as $detail)
            <span class="badge text-white {{ $detail->color }}">{{ $detail->product->name }}
                {{ $detail->description ? '('.$detail->description.')' : '(-)'}}</span>
            @endforeach
        </p>
        <p class="mb-0">
            <b>Vendedor:</b>
            {{ $sale->seller->full_name }}
        </p>
        <p class="mb-2">
            <b>Fecha:</b>
            {{ $sale->created_at->diffForHumans() }}
        </p>
    </div>
    <div class="
                            ml-auto
                            d-flex
                            align-items-end
                            p-2
                            bg-success
                            rounded
                        ">
        <p class="text-white my-auto">
            <b>${{ $sale->details->sum('amount') }}</b>
        </p>
    </div>
</li>
@empty
<li class="list-group-item">
    Todavía no hay ventas para mostrar. Genera una
    <a href="{{ route('sales.create') }}">acá</a>.
</li>
@endforelse