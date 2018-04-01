<?php

use Illuminate\Database\Migrations\Migration;

class CreateParticipantOverviewTable extends Migration
{
    /*
     * Name of the database table
     */
    protected $tableName = "participant_overview";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW " . $this->tableName . " AS
            SELECT 
                participants.*,
                groups.name as group_name
            FROM participants 
            INNER JOIN groups ON groups.id = participants.group_id
            ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW " . $this->tableName);
    }

}
