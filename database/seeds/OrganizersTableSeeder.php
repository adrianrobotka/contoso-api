<?php

use Illuminate\Database\Seeder;

class OrganizersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizers')->insert([
            [
                'first_name' => "Adrián",
                'last_name' => "Robotka",
                'email' => 'robotka.adrian@gmail.com',
                'password' => bcrypt('secret'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'first_name' => "Ádám",
                'last_name' => "Lencsés",
                'email' => 'l.adam987@gmail.com',
                'password' => bcrypt('secret'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'first_name' => "Viktor",
                'last_name' => "Bagány",
                'email' => 'baganyviktor@gmail.com',
                'password' => bcrypt('secret'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ]
        ]);
    }
}
