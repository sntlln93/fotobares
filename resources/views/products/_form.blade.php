<div class="form-row">
    <label for="name">Nombre del producto</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $product->name) }}">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>
<div class="form-row">
    <label for="quotas">Cantidad de cuotas</label>
    <input type="number" id="quotas" class="form-control @error('quotas') is-invalid @enderror" min="1"
        value="{{ count(old('quotas', $product->quotas)) }}">
    @error('quotas') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<br>
<h1 class="h4 text-gray-800">Valor de las cuotas</h1>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cantidad de cuotas</th>
                <th>Valor por cuota</th>
            </tr>
        </thead>
        <tbody>
            @forelse (old('quotas', $product->quotas) as $quota)
            <tr>
                <td>
                    <input class="form-control @error('quotas[{{ $loop->index }}][quantity]') is-invalid @enderror"
                        type="number" readonly value="{{ $loop->iteration }}"
                        name="quotas[{{ $loop->index }}][quantity]">
                </td>
                <td>
                    <input type="number"
                        class="form-control @error('quotas[{{ $loop->index }}][quota_amount]') is-invalid @enderror"
                        value="{{ is_array($quota) ? $quota['quota_amount'] : $quota->quota_amount }}"
                        name="quotas[{{ $loop->index }}][quota_amount]">
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    <input class="form-control @error('quotas[0][quantity]') is-invalid @enderror" type="number"
                        readonly value="{{ $product->name }}" name="quotas[0][quantity]">
                </td>
                <td>
                    <input type="number" class="form-control @error('quotas[0][quota_amount]') is-invalid @enderror"
                        name="quotas[0][quota_amount]">
                </td>
            </tr>
            @endforelse
        </tbody>
        @if($errors->any())
        <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>