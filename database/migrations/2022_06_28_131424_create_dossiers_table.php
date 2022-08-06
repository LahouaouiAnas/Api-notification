<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->string('project_title');
            $table->boolean('arret');
            $table->bigInteger('statue_id')->unsigned();
            $table->foreign('statue_id')->references('id')->on('statues');
            $table->text('motif_arret')->nullable();
            $table->date('date_de_depot')->nullable();
            $table->bigInteger('researcher_id')->unsigned();
            $table->foreign('researcher_id')->references('id')->on('researchers')->onDeleteCascade();
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
        Schema::dropIfExists('dossiers');
    }
}
