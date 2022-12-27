<?php
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'id' => 1,
                'email' => 'user@gmail.com',
                'password' => Hash::make('admin@123#'),
                'name' => 'Avinesh Shakya',
                'address' => 'Patan',
                'phone' => 9874563210,
                'verify' => 1,
                'created_at' => Carbon\Carbon::now()
            ]
        ];

        foreach ($admins as $user) {
            \App\User::create($user);
        }



    }
}
