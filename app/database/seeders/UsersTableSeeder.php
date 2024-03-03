<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Operario',
                'email' => 'operario@expcontrol.com',
                'password' => Hash::make('secret'),
                'team_name' => 'ExpControl',
                'role' => config('jetstream.roles.operator.name')
            ]
        ];

        foreach ($data as $item) {
            $user = User::updateOrCreate(['email' => $item['email']], [
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => $item['password']
            ]);

            self::createToken($user,$item);
        }
    }

    private function createToken(User $user, array $item){
        if (!$user->tokens()->where('name', 'auth')->exists())
            $user->createToken('auth');
    }
}
