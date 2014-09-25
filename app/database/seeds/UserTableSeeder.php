<?php

use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    public function run()
    {
        $time = time();
        
        DB::table('users')->delete();

        DB::table('users')->insert(array(
                array('id' => 1, 'name' => 'User1', 'email' => 'user1@mail.com', 'password' => Hash::make('parol'), 'role' => User::ROLE_USER, 'created_at' => $time, 'updated_at' => $time),
                array('id' => 2, 'name' => 'User2', 'email' => 'user2@mail.com', 'password' => Hash::make('parol'), 'role' => User::ROLE_USER, 'created_at' => $time, 'updated_at' => $time),
                array('id' => 3, 'name' => 'User3', 'email' => 'user3@mail.com', 'password' => Hash::make('parol'), 'role' => User::ROLE_MODERATOR, 'created_at' => $time, 'updated_at' => $time),
                array('id' => 4, 'name' => 'User4', 'email' => 'user4@mail.com', 'password' => Hash::make('parol'), 'role' => User::ROLE_HR, 'created_at' => $time, 'updated_at' => $time),
                array('id' => 5, 'name' => 'User5', 'email' => 'user5@mail.com', 'password' => Hash::make('parol'), 'role' => User::ROLE_HR, 'created_at' => $time, 'updated_at' => $time)
            )
        );
    }
}