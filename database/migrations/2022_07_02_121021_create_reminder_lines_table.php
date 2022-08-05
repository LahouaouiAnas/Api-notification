<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_lines', function (Blueprint $table) {
            $table->id();
            $table->date('premiere_notif_date');
            $table->date('deuxieme_notif_date');
            $table->bigInteger('dossier_id')->unsigned();
            $table->bigInteger('reminder_type_id')->unsigned();
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDeleteCascade();
            $table->foreign('reminder_type_id')->references('id')->on('reminder_types')->onDeleteCascade();
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
        Schema::dropIfExists('reminder_lines');
    }
}
