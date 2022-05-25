<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => Str::random(10),
            'image'       => "https://picsum.photos/200",
            'responsible' => $this->faker->name(),
            'start'       => Carbon::now()->format('Y-m-d H:i:s'),
            'end'         => Carbon::now()->format('Y-m-d H:i:s'),
            'description' => Str::random(200)
        ];
    }
}
