<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->sales() as $sale){
            Sale::create($sale);
        }
    }

    private function sales(){
        return [
            ['client_id' => '1', 'seller_id' => 1, 'deliver_on' => '2021-05-22', 'delivered_at' => Carbon::now()],
            ['client_id' => '2', 'seller_id' => 1, 'deliver_on' => '2021-10-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '3', 'seller_id' => 2, 'deliver_on' => '2017-01-01', 'delivered_at' => Carbon::now()],
            ['client_id' => '4', 'seller_id' => 2, 'deliver_on' => '2017-01-01', 'delivered_at' => Carbon::now()],
            ['client_id' => '5', 'seller_id' => 2, 'deliver_on' => '2021-07-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '6', 'seller_id' => 3, 'deliver_on' => '2017-01-01', 'delivered_at' => Carbon::now()],
            ['client_id' => '7', 'seller_id' => 2, 'deliver_on' => '2021-10-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '8', 'seller_id' => 2, 'deliver_on' => '2021-05-22', 'delivered_at' => Carbon::now()],
            ['client_id' => '9', 'seller_id' => 1, 'deliver_on' => '2017-01-01', 'delivered_at' => Carbon::now()],
            ['client_id' => '10', 'seller_id' => 2, 'deliver_on' => '2021-05-17', 'delivered_at' => Carbon::now()],
            ['client_id' => '11', 'seller_id' => 2, 'deliver_on' => '2021-08-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '12', 'seller_id' => 2, 'deliver_on' => '2021-05-16', 'delivered_at' => Carbon::now()],
            ['client_id' => '13', 'seller_id' => 2, 'deliver_on' => '2021-05-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '14', 'seller_id' => 2, 'deliver_on' => '2021-07-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '15', 'seller_id' => 1, 'deliver_on' => '2021-05-20', 'delivered_at' => Carbon::now()],
            ['client_id' => '16', 'seller_id' => 1, 'deliver_on' => '2021-07-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '17', 'seller_id' => 3, 'deliver_on' => '2017-01-01', 'delivered_at' => Carbon::now()],
            ['client_id' => '18', 'seller_id' => 3, 'deliver_on' => '2021-07-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '19', 'seller_id' => 3, 'deliver_on' => '2021-05-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '20', 'seller_id' => 1, 'deliver_on' => '2021-05-25', 'delivered_at' => Carbon::now()],
            ['client_id' => '21', 'seller_id' => 1, 'deliver_on' => '2021-05-15', 'delivered_at' => Carbon::now()],
            ['client_id' => '22', 'seller_id' => 1, 'deliver_on' => '2021-06-07', 'delivered_at' => Carbon::now()],
            ['client_id' => '23', 'seller_id' => 1, 'deliver_on' => '2021-10-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '24', 'seller_id' => 2, 'deliver_on' => '2021-05-20', 'delivered_at' => Carbon::now()],
            ['client_id' => '25', 'seller_id' => 2, 'deliver_on' => '2021-05-20', 'delivered_at' => Carbon::now()],
            ['client_id' => '26', 'seller_id' => 2, 'deliver_on' => '2017-01-01', 'delivered_at' => Carbon::now()],
            ['client_id' => '27', 'seller_id' => 3, 'deliver_on' => '2021-05-10', 'delivered_at' => Carbon::now()],
            ['client_id' => '28', 'seller_id' => 3, 'deliver_on' => '2017-01-01', 'delivered_at' => Carbon::now()],
            ['client_id' => '29', 'seller_id' => 3, 'deliver_on' => '2021-06-10', 'delivered_at' => Carbon::now()],
            ['client_id' => '30', 'seller_id' => 2, 'deliver_on' => '2021-06-16', 'delivered_at' => Carbon::now()],
            ['client_id' => '31', 'seller_id' => 2, 'deliver_on' => '2021-05-25', 'delivered_at' => Carbon::now()],
            ['client_id' => '32', 'seller_id' => 2, 'deliver_on' => '2021-05-20', 'delivered_at' => Carbon::now()],
            ['client_id' => '33', 'seller_id' => 2, 'deliver_on' => '2021-06-05', 'delivered_at' => Carbon::now()],
            ['client_id' => '34', 'seller_id' => 2, 'deliver_on' => '2021-05-17', 'delivered_at' => Carbon::now()],
        ];
    }
}
