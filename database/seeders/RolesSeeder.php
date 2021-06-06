<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'id' => 1, 'name' => 'Naudotojas' ],
            [ 'id' => 2, 'name' => 'Administratorius']
        ];

        DB::table('roles')->insert($roles);
    }
}
