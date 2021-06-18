<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketBallTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_ball_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('home_team');
            $table->string('away_team');
            $table->string("country");
            $table->date("fixture_date");
            $table->time("fixture_time");
            $table->string("competition");
            $table->decimal("ticket_price","10","2");
            $table->integer("expected_profit");
            $table->integer("tickets_available");
            $table->integer("time_left");
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
        Schema::dropIfExists('basket_ball_tickets');
    }
}
