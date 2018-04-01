<?php

use Illuminate\Database\Seeder;

class ParticipantImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $participant_images = array(
            array('id' => '2adb9574-221a-47af-a8bb-30f3a26dce3a', 'participant_id' => '0511d212-47ef-40ea-bdbb-e0573b8e3921', 'created_at' => '2018-03-10 12:46:00', 'updated_at' => '2018-03-10 12:46:00'),
            array('id' => 'c579315e-e383-4149-a01d-56995184f11d', 'participant_id' => '0511d212-47ef-40ea-bdbb-e0573b8e3921', 'created_at' => '2018-03-10 12:46:00', 'updated_at' => '2018-03-10 12:46:00'),
            array('id' => '40cbf965-2589-4a86-aae9-0f0e2974d30b', 'participant_id' => '7fc26b0b-a568-4164-9d81-81305d973fb8', 'created_at' => '2018-03-10 12:09:00', 'updated_at' => '2018-03-10 12:09:00'),
            array('id' => 'e8185cf8-1224-4b41-8af0-160144a9a857', 'participant_id' => '7fc26b0b-a568-4164-9d81-81305d973fb8', 'created_at' => '2018-03-10 13:18:00', 'updated_at' => '2018-03-10 13:18:00')
        );

        DB::table('participant_images')->insert($participant_images);
    }
}