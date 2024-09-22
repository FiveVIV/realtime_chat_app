<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('friendships')->insert([
            [
                "sender_id" => 2,
                "friend_id" => 1,
                "accepted" => false,
                "created_at" => now(),
            ],
            [
                "sender_id" => 3,
                "friend_id" => 1,
                "accepted" => false,
                "created_at" => now(),
            ],
            [
                "sender_id" => 4,
                "friend_id" => 1,
                "accepted" => false,
                "created_at" => now(),
            ],
        ]);
    }
}
