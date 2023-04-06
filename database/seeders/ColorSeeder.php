<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            [
                'name' => 'Yellow'
            ],
            [
                'name' => 'Orange'
            ],
            [
                'name' => 'Red'
            ],
            [
                'name' => 'Purple'
            ],
            [
                'name' => 'Blue'
            ],
            [
                'name' => 'Green'
            ],
            [
                'name' => 'Brown'
            ],
            [
                'name' => 'Pink'
            ],
            [
                'name' => 'Beige'
            ],
            [
                'name' => 'Gray'
            ],
        ]);
    }
}
