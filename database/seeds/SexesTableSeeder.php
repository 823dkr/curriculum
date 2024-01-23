<?php

use Illuminate\Database\Seeder;

class SexesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'name' => '不明',
                'category' => 0,
            ],
            [
                'name' => 'オス',
                'category' => 1,
            ],
            [
                'name' => 'メス',
                'category' => 2,
            ],
        ];
        foreach ($params as $param) {
            DB::table('sexs')->insert($param);
        }
    }
}
