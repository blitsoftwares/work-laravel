<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Lucas',
            'email' => 'lucas@blitsoft.com.br',
            'password' => bcrypt('123456')
        ];

        User::firstOrCreate(
            [ 
                'email' => $data['email'] 
            ],
            $data
        );
    }
}
