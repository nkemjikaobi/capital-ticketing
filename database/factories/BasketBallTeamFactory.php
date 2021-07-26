<?php

namespace Database\Factories;

use App\Models\BasketBallTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasketBallTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BasketBallTeam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_name' => $this->faker->state(),
            'logo' => $this->faker->imageUrl($width = 25, $height = 25)
        ];
    }
}
