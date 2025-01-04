<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 5; $i++) { 
            Avatar::create([
                'name' => 'Avatar '.$i,
                'price' => rand(1, 400),
                'path' => 'assets/images/default-avatar.png'
            ]);
        }
    }
}
