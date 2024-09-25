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
                "sender_id" => 1,
                "friend_id" => 2,
                "accepted" => false,
                "created_at" => now(),
            ],
            [
                "sender_id" => 1,
                "friend_id" => 3,
                "accepted" => false,
                "created_at" => now(),
            ],
            [
                "sender_id" => 1,
                "friend_id" => 4,
                "accepted" => false,
                "created_at" => now(),
            ],
        ]);
    }
}
