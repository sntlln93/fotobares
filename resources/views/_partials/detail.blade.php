@if(isset($detail->sale_id))
<a href="{{ route('sales.show', ['sale' => $detail->sale_id]) }}">
    @endif

    <span class="badge badge-light border--transparent">{{
        $detail->product_name }}
        {{ $detail->description ? '('.$detail->description.')' : '(-)'}}
        @include('_partials.color')
    </span>
    @if(isset($detail->sale_id))
</a>
@endif