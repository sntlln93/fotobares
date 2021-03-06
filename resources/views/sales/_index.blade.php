<tr>
    <td>{{ $sale->id }}</td>
    <td><a href="{{ route('clients.show', ['client' => $sale->client->id]) }}">{{ $sale->client->full_name }}</a>
    </td>
    <td>{{ $sale->formatted_deliver_on }}</td>
    <td>{{ $sale->formatted_delivered_at }}</td>
    <td><a href="{{ route('employees.show', ['employee' => $sale->seller_id]) }}">{{ $sale->seller->full_name }}</a>
    </td>
    <td>{{ $sale->created_at->diffForHumans() }}</td>
    <td>
        @can('perform-action-on-sale')
        <a href="{{ route('sales.show', ['sale' => $sale->id]) }}" class="btn btn-sm btn-info"><i
                class="fas fa-eye"></i></a>
        @endcan
        <a href="{{ route('postpone.form', ['sale' => $sale]) }}" class="btn btn-warning btn-sm"><i
                class="fas fa-clock"></i></a>
    </td>
</tr>