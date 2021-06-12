<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoccerPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soccer_pays', function (Blueprint $table) {
            $table->id();
            $table->string('home_team');
            $table->string('away_team');
            $table->string("country");
            $table->integer("purchase_number");
            $table->decimal('final_pay',10,2)->default(0);
            $table->date("fixture_date");
            $table->time("fixture_time");
            $table->string("competition");
            $table->decimal("ticket_price","10","2");
            $table->integer("expected_profit");
            $table->integer("tickets_available");
            $table->integer("time_left");
            $table->boolean("transaction_status")->default(false);
            $table->string("email");
            $table->decimal("roi",10,2)->default(0);
            $table->boolean("isSold")->default(0);
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
        Schema::dropIfExists('soccer_pays');
    }
}
