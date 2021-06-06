<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'id' => 1, 'name' => 'Pusryčiai' ],
            [ 'id' => 2, 'name' => 'Pietūs'],
            [ 'id' => 3, 'name' => 'Vakarienė'],
            [ 'id' => 4, 'name' => 'Desertai'],
            [ 'id' => 5, 'name' => 'Gėrimai'],
            [ 'id' => 6, 'name' => 'Kita'],
        ];

        DB::table('categories')->insert($categories);
    }
}
