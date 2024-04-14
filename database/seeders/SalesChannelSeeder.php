<?php

namespace Database\Seeders;

use App\Models\SalesChannel;
use Illuminate\Database\Seeder;

class SalesChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!SalesChannel::count()) {
            $data = [];
            $date = date('Y-m-d H:i:s');
            foreach ([
                'Distributor & franchise',
                'E-commerce & mordern trade',
                'Sub-distributor & daily outlet',
                'Horeca & canteens',
                'Gt market retailer',
            ] as $item) {
                $data[] = [
                    'name' => $item,
                    'created_at' => $date,
                    'updated_at' => $date
                ];
            }
            SalesChannel::insert($data);
        }
    }
}
