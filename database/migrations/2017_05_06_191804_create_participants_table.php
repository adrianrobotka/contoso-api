<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /*
     * Name of the database table
     */
    protected $tableName = "participants";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->char('id', 36)->unique()->comment('Id from FaceAPI');
            $table->string('first_name', 200);
            $table->string('last_name', 200);
            $table->string('email', 200)->unique();
            $table->date('birth');
            $table->string('company', 200);
            $table->string('work_title', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
