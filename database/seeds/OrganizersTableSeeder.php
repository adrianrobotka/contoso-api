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
                'first_name' => "Ágnes",
                'last_name' => "Suszter",
                'email' => 'agnessuszter@gmail.com',
                'password' => bcrypt('secret'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'first_name' => "Jury",
                'last_name' => "Jury",
                'email' => 'jury@contoso.tld',
                'password' => bcrypt('secret'),
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ]

        ]);
    }
}
