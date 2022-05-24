<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'     => 'staff@gmail.com',
            'password'  => Hash::make('staff'),
            'role'      => 'staff'
        ]);

        $guest = User::create([
            'email'     => 'guest@gmail.com',
            'password'  => Hash::make('guest'),
            'role'      => 'guest'
        ]);

        DB::table('guests')->insert([
            'name'      => 'Joko Susilo',
            'reg_number'=> '20051204058',
            'user_id'   => $guest->id
        ]);
    }
}
