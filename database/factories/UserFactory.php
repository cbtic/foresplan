<?php

namespace Database\Factories;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => '$2y$10$RcwmYrJXEarB.eoO0HNEy.KBxdPwX/UU9W46VBHh7Qko5nvIdBu4i',
            'email_verified_at' => '2024-03-07 16:18:37.000',
            'active' => 1
        ];
    }
}
