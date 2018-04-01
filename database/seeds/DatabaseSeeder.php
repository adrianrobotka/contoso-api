<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupsTableSeeder::class);
        $this->call(OrganizersTableSeeder::class);
        $this->call(ParticipantsTableSeeder::class);
        $this->call(ParticipantImagesTableSeeder::class);
    }
}
