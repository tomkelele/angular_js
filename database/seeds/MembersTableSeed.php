<?php

use Illuminate\Database\Seeder;

class MembersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'name' => 'Kobe Bryant',
            'address' => 'Los Angeles Lakers',
            'photo' => 'kobebryant.png',
            'age'	=> '25',
            'gender'	=> 0
        ]);
        DB::table('members')->insert([
            'name' => 'Micheal Jordan',
            'address' => 'Chicago Bulls',
            'photo' => 'jordan.png',
            'age'	=> '25',
            'gender'	=> 0
        ]);
    }
}
