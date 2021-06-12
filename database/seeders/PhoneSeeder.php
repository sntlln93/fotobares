<?php

namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Seeder;
use App\Models\Client;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phone::insert([
            ['phoneable_id' => 1, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4369389'],
            ['phoneable_id' => 2, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4373841'],
            ['phoneable_id' => 3, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4254155'],
            ['phoneable_id' => 4, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4318392'],
            ['phoneable_id' => 5, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4628518'],
            ['phoneable_id' => 6, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4763410'],
            ['phoneable_id' => 7, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4386219'],
            ['phoneable_id' => 8, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4308705'],
            ['phoneable_id' => 9, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4588534'],
            ['phoneable_id' => 10, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4386219'],
            ['phoneable_id' => 11, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '111339'],
            ['phoneable_id' => 12, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4565952'],
            ['phoneable_id' => 14, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4799199'],
            ['phoneable_id' => 14, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4400914'],
            ['phoneable_id' => 15, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4884798'],
            ['phoneable_id' => 16, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4558376'],
            ['phoneable_id' => 17, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4252548'],
            ['phoneable_id' => 18, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4526987'],
            ['phoneable_id' => 19, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4911258'],
            ['phoneable_id' => 20, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '115897'],
            ['phoneable_id' => 21, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4404024'],
            ['phoneable_id' => 22, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4283420'],
            ['phoneable_id' => 23, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4202100'],
            ['phoneable_id' => 24, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4887542'],
            ['phoneable_id' => 25, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4603892'],
            ['phoneable_id' => 26, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4941388'],
            ['phoneable_id' => 27, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4355061'],
            ['phoneable_id' => 28, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4239468'],
            ['phoneable_id' => 29, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4938790'],
            ['phoneable_id' => 30, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4527758'],
            ['phoneable_id' => 31, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4920837'],
            ['phoneable_id' => 32, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4234652'],
            ['phoneable_id' => 33, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4145609'],
            ['phoneable_id' => 34, 'phoneable_type' => Client::class, 'area_code' => '380', 'number' => '4388152'],
        ]);
    }
}
