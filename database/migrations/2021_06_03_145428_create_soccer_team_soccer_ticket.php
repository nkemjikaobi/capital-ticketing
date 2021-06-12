<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoccerTeamSoccerTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soccer_team_soccer_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("soccer_team_id");
            $table->unsignedBigInteger("soccer_ticket_id");
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
        Schema::dropIfExists('soccer_team_soccer_ticket');
    }
}
