<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run()
    {
        \DB::table('regions')->insert([
            0 => [
                'id'    => 1,
                'name'  => 'Брестская область',
                'lat'   => '52.089307',
                'lng'   => '23.764971',
            ],
            1 => [
                'id'         => 2,
                'name'       => 'Витебская область',
                'lat'   => '55.190168',
                'lng'   => '30.206927',
            ],
            2 => [
                'id'         => 3,
                'name'       => 'Гомельская область',
                'lat'   => '52.423291',
                'lng'   => '30.993418',
            ],
            3 => [
                'id'         => 4,
                'name'       => 'Гродненская область',
                'lat'   => '53.650425',
                'lng'   => '23.820788',
            ],
            4 => [
                'id'         => 5,
                'name'       => 'Минская область',
                'lat'   => '53.892722',
                'lng'   => '27.558522',
            ],
            5 => [
                'id'         => 6,
                'name'       => 'Могилевская область',
                'lat'   => '53.885350',
                'lng'   => '30.334581',
            ],
        ]);
    }
}
