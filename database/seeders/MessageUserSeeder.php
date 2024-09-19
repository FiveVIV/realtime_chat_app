<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MessageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table("message_user")->insert([
            // Message 1 Chat 1
            [
                "message_id" => 1,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 01),
            ],
            [
                "message_id" => 1,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 01),
            ],
            [
                "message_id" => 1,
                "user_id" => 3,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 01),
            ],
            [
                "message_id" => 1,
                "user_id" => 4,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 01),
            ],
            // Message 2 Chat 1
            [
                "message_id" => 2,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 02),
            ],
            [
                "message_id" => 2,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 02),
            ],
            [
                "message_id" => 2,
                "user_id" => 3,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 02),
            ],
            [
                "message_id" => 2,
                "user_id" => 4,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 02),
            ],
            // Message 3 Chat 1
            [
                "message_id" => 3,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 03),
            ],
            [
                "message_id" => 3,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 03),
            ],
            [
                "message_id" => 3,
                "user_id" => 3,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 03),
            ],
            [
                "message_id" => 3,
                "user_id" => 4,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 03),
            ],
            // Message 4 chat 1
            [
                "message_id" => 4,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 04),
            ],
            [
                "message_id" => 4,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 04),
            ],
            [
                "message_id" => 4,
                "user_id" => 3,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 04),
            ],
            [
                "message_id" => 4,
                "user_id" => 4,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 04),
            ],

            // Message 5 chat 2
            [
                "message_id" => 5,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 05),
            ],
            [
                "message_id" => 5,
                "user_id" => 3,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 05),
            ],
            [
                "message_id" => 5,
                "user_id" => 4,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 05),
            ],

            // Message 6 chat 2
            [
                "message_id" => 6,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 06),
            ],
            [
                "message_id" => 6,
                "user_id" => 3,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 06),
            ],
            [
                "message_id" => 6,
                "user_id" => 4,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 06),
            ],

            // Message 7 chat 2
            [
                "message_id" => 7,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 07),
            ],
            [
                "message_id" => 7,
                "user_id" => 3,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 07),
            ],
            [
                "message_id" => 7,
                "user_id" => 4,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 07),
            ],

            // Message 8 chat 3
            [
                "message_id" => 8,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 10),
            ],
            [
                "message_id" => 8,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 10),
            ],


            // Message 9 chat 3
            [
                "message_id" => 9,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 11),
            ],
            [
                "message_id" => 9,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 11),
            ],

            // Message 10 chat 4
            [
                "message_id" => 10,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 12),
            ],
            [
                "message_id" => 10,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 12),
            ],


            // Message 11 chat 4
            [
                "message_id" => 11,
                "user_id" => 1,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 13),
            ],
            [
                "message_id" => 11,
                "user_id" => 2,
                "read_at" => null,
                "created_at" => Carbon::now()->setTime(0, 13),
            ],
        ]);
    }
}
