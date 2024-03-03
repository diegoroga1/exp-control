<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => config('drgcode.username'),
                'email' => 'admin@expcontrol.com',
                'password' => Hash::make('secret'),
                'admin' => 1
            ]
        ];

        foreach ($data as $item) {
            $user = User::updateOrCreate(['email' => $item['email']], [
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => $item['password'],
                'admin' => $item['admin']
            ]);
            $this->createToken($user,$item);
        }
    }

    private function createToken(User $user, array $item){
        if (!$user->tokens()->where('name', 'auth')->exists())
            $user->createToken('auth');
    }
}
