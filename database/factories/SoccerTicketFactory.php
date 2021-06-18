<?php

namespace Database\Factories;

use App\Models\SoccerTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoccerTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SoccerTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'home_team' => $this->faker->state(),
            'away_team' => $this->faker->state(),
            'country' => $this->faker->country(),
            'fixture_date' => $this->faker->date(),
            'fixture_time' => $this->faker->time(),
            'competition' => $this->faker->word(),
            'ticket_price' => $this->faker->numberBetween($min = 30, $max= 100),
            'expected_profit' => $this->faker->numberBetween($min = 10, $max= 50),
            'tickets_available' => $this->faker->numberBetween($min = 10, $max= 50),
            'time_left' => $this->faker->randomDigit(),
        ];
    }
}
