<?php

use Illuminate\Database\Seeder;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('participants')->insert([
            [
                'id' => '0511d212-47ef-40ea-bdbb-e0573b8e3921',
                'first_name' => 'Adrián',
                'last_name' => 'Robotka',
                'email' => 'robotka.adrian@gmail.com',
                'birth' => '1999-04-15',
                'company' => 'Ferenc Földes Secondary School',
                'work_title' => 'Student',
                'created_at' => '2018-03-10 12:07:00',
                'updated_at' => '2018-03-10 12:07:00'
            ],
            [
                'id' => '7fc26b0b-a568-4164-9d81-81305d973fb8',
                'first_name' => 'István Adrián',
                'last_name' => 'Robotka',
                'email' => 'ROBOTKA.ADRIAN#spam@gmail.com',
                'birth' => '2018-03-10',
                'company' => 'asd',
                'work_title' => '123',
                'created_at' => '2018-03-10 12:46:00',
                'updated_at' => '2018-03-10 14:33:00'
            ]


        ]);
    }
}