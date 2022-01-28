<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'initials' => 'A',
            'rol'=> 1,
            'email_verified_at' => now(),
            'password' => 'adminadmin', // password
            'remember_token' => 'adminadmin',
        ];
    }

}
