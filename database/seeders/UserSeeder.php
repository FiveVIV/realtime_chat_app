<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                "name" => "User One",
                "email" => "user1@gmail.com",
                "password" => Hash::make("password"),
            ],
            [
                "name" => "User Two",
                "email" => "user2@gmail.com",
                "password" => Hash::make("password"),
            ],
            [
                "name" => "User Three",
                "email" => "user3@gmail.com",
                "password" => Hash::make("password"),
            ],
            [
                "name" => "User Four",
                "email" => "user4@gmail.com",
                "password" => Hash::make("password"),
            ],
            [
                "name" => "User Five",
                "email" => "user5@gmail.com",
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => fake()->name(),
                "email" => fake()->unique()->safeEmail(),
                "password" => Hash::make("password"),
            ],
        ]);
    }
}
