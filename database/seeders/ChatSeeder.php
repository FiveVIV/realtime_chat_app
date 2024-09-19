<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("chats")->insert([
            [
                "title" => "Group chat 1"
            ],
            [
                "title" => "Group chat 2"
            ],
            [
                "title" => "Group chat 3"
            ],
            [
                "title" => null
            ]
        ]);
    }
}
