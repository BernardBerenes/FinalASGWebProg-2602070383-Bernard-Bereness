<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Bernard Bereness',
            'email' => 'bernardbereness78@gmail.com',
            'password' => 'Bernard123!',
            'gender' => 'Male',
            'fields_of_interest' => json_encode(explode(',', 'Makan, Tidur, Main')),
            'linkedin_username' => 'WWWW',
            'phone_number' => '081369251040'
        ]);
        for ($i=0; $i < 5; $i++) { 
            User::create([
                'name' => 'User '.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => 'user123',
                'gender' => rand(0, 2) == 0 ? 'Female' : 'Male',
                'fields_of_interest' => json_encode(explode(',', 'Makan, Tidur, Main')),
                'linkedin_username' => 'WWWW',
                'phone_number' => '081369251040'
            ]);
        }
    }
}
