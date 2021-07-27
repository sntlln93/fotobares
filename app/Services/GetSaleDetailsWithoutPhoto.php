<?php

namespace App\Services;

use App\Models\SaleDetail;
use App\Models\Photo;

class GetSaleDetailsWithoutPhoto
{
    public function get()
    {
        $sale_details_id = Photo::pluck('sale_detail_id');

        return SaleDetail::query()
            ->whereNotIn('id', $sale_details_id);
    }
}
