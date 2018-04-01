<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /*
     * Name of the database table
     */
    protected $tableName = "logs";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->char('participant_id', 36)->nullable();
            $table->enum('event',
                [
                    'no-identity', // no identity
                    'indefinite-enter', // multiple candidates
                    'valid-enter', // one valid candidate
                    'selected-enter', // client selected candidate after multiple candidate
                ]);
            $table->float('confidence')->nullable();
            $table->string('gate', 150)->nullable();
            $table->text('comment')->nullable();

            $table->timestamps();

            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');

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
