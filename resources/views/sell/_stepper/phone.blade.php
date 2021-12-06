<h1 class="h4 text-gray-800">
    Teléfonos
    <button id="addPhone" class="btn btn-sm btn-info">
        <i class="fas fa-plus"></i>
    </button>
</h1>
<div class="pt-4 pb-2 pl-2 table-responsive">
    <table class="table table-bordered mx-0">
        <thead>
            <tr>
                <th class="text-center">Característica</th>
                <th class="text-center text-nowrap">Número sin característica</th>
                <th class="text-center"><i class="fab fa-whatsapp"></i></th>
                <th class="text-center"><i class="fas fa-trash"></i></th>
            </tr>
        </thead>
        <tbody id="phonesContainer">
            <tr>
                <td>
                    <input value="{{ old('phones.0.area_code', '380') }}"
                        class="form-control @error('phones.0.area_code') is-invalid @enderror" id="phones.0.area_code"
                        name="phones[0][area_code]" type="number">
                </td>
                <td>
                    <input value="{{ old('phones.0.number') }}"
                        class="form-control w-100 @error('phones.0.number') is-invalid @enderror" id="phones.0.number"
                        name="phones[0][number]" type="number">

                </td>
                <td>
                    <div class="custom-control custom-switch h5">
                        <input @if(old('phones.0.has_whatsapp')=='on' ) checked @endif class="custom-control-input"
                            id="phones.0.has_whatsapp" name="phones[0][has_whatsapp]" type="checkbox">
                        <label class="custom-control-label" for="phones.0.has_whatsapp"></label>
                    </div>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger deleteRowButton" disabled>
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        @if($errors->first('phones.0.area_code') OR $errors->first('phones.0.number'))
        <tfoot>
            <tr>
                <td colspan="5">
                    <ul class="alert alert-danger">
                        @error('phones.0.area_code')
                        <li>
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        </li>
                        @enderror
                        @error('phones.0.number')
                        <li>
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        </li>
                        @enderror
                    </ul>
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>