<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apps = [
            [
                'uuid' => Str::uuid(),
                'domain' => 'example.com',
                'email' => 'test1@example.com',
                'phone' => '123456789',
                'name' => 'App 1',
                'key' => 'some-key-1',
                'exp_date' => '2023-06-30 00:00:00',
                'ban' => 0,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'domain' => 'example.org',
                'email' => 'test2@example.com',
                'phone' => '987654321',
                'name' => 'App 2',
                'key' => 'some-key-2',
                'exp_date' => '2023-07-15 12:00:00',
                'ban' => 0,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('apps')->insert($apps);
    }
}
