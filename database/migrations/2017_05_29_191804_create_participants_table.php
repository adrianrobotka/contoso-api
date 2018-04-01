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
            $table->integer('group_id')->unsigned()->default(1);
            $table->string('first_name', 190);
            $table->string('last_name', 190);
            $table->string('email', 190)->unique();
            $table->date('birth');
            $table->string('company', 190);
            $table->string('work_title', 190);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

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
