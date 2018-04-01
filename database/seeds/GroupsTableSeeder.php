<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'name' => 'normál',
                'description' => 'normál résztvevő'
            ],
            [
                'name' => 'VIP',
                'description' => 'VIP résztvevő'
            ],
            [
                'name' => '1. osztály',
                'description' => '1. osztályú résztvevő'
            ],
        ]);
    }
}