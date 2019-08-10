<?php

use Illuminate\Database\Seeder;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => Str::random(10),
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'description' => Str::random(10),
        ]);
    }
}
