<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$9TXEn/tnO0wpMpFf7nw7ae99PHKOxla/ialaNb7UNYGKQhpMM6FY2',
            ]
        ]);

    }
}


