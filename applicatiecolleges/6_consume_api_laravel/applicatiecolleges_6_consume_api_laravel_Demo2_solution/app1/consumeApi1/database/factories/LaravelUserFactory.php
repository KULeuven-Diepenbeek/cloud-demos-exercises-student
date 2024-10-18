<?php

namespace Database\Factories;

use App\Models\LaravelUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaravelUserFactory extends Factory
{
    protected $model = LaravelUser::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,  // Use unique name for other users
            'email' => $this->faker->unique()->safeEmail, // Use unique email for other users
        ];
    }
}