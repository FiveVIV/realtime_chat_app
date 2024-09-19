<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assign all users to the "General Chat"
        DB::table('chat_user')->insert([
            [
                'user_id' => 1,
                'chat_id' => 1
            ],
            [
                'user_id' => 2,
                'chat_id' => 1
            ],
            [
                'user_id' => 3,
                'chat_id' => 1
            ],
            [
                'user_id' => 4,
                'chat_id' => 1
            ],
            [
                'user_id' => 1,
                'chat_id' => 2
            ],
            [
                'user_id' => 3,
                'chat_id' => 2
            ],
            [
                'user_id' => 4,
                'chat_id' => 2
            ],
            [
                'user_id' => 1,
                'chat_id' => 3
            ],
            [
                'user_id' => 2,
                'chat_id' => 3
            ],
            [
                'user_id' => 1,
                'chat_id' => 4
            ],
            [
                'user_id' => 2,
                'chat_id' => 4
            ],
        ]);
    }
}
