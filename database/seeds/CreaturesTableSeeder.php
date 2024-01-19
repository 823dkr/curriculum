<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('creatures')->insert([
            'name' => 'ノーマル',
            'sex' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
    }
}
