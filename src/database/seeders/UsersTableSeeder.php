<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $param = [
            'id' => 1,
            'name' => 'tony',
            'email' => 'coachtech@oo.jp',
            'password' => Hash::make('coachtech111'),
            'created_at' => $now,
            'updated_at' => $now
        ];
        DB::table('users')->insert($param);
    }
}
