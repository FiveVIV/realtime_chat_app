<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'user_id' => 1,
                'chat_id' => 1,
                'message' => 1,
                "created_at" => Carbon::now()->setTime(0, 01),
            ],
            [
                'user_id' => 2,
                'chat_id' => 1,
                'message' => 2,
                "created_at" => Carbon::now()->setTime(0, 02),
            ],
            [
                'user_id' => 3,
                'chat_id' => 1,
                'message' => 3,
                "created_at" => Carbon::now()->setTime(0, 03),
            ],
            [
                'user_id' => 4,
                'chat_id' => 1,
                'message' => 4,
                "created_at" => Carbon::now()->setTime(0, 04),
            ],
            [
                'user_id' => 1,
                'chat_id' => 2,
                'message' => 5,
                "created_at" => Carbon::now()->setTime(0, 05),
            ],
            [
                'user_id' => 3,
                'chat_id' => 2,
                'message' => 6,
                "created_at" => Carbon::now()->setTime(0, 06),
            ],
            [
                'user_id' => 4,
                'chat_id' => 2,
                'message' => 7,
                "created_at" => Carbon::now()->setTime(0, 07),
            ],
            [
                'user_id' => 1,
                'chat_id' => 3,
                'message' => 8,
                "created_at" => Carbon::now()->setTime(0, 10),
            ],
            [
                'user_id' => 2,
                'chat_id' => 3,
                'message' => 9,
                "created_at" => Carbon::now()->setTime(0, 11),
            ],
            [
                'user_id' => 1,
                'chat_id' => 4,
                'message' => 10,
                "created_at" => Carbon::now()->setTime(0, 12),
            ],
            [
                'user_id' => 2,
                'chat_id' => 4,
                'message' => 11,
                "created_at" => Carbon::now()->setTime(0, 13),
            ],
        ]);
    }
}
