<?php

namespace Database\Seeders;

use App\Models\Bulim;
use App\Models\Category;
use App\Models\Hodim;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);
        Bulim::create([
            'name' => 'admin',    
        ]);
        //img_uploaded/2024-12-13_1734096238.jpg
        Hodim::create([
            'user_id'=>2,
            'bulim_id'=>1,
            'img'=>"img_uploaded/2024-12-11_1733921823.jpg",
            'oylik_type'=>'fixed',
            'oylik_miqdor'=>'15000000',
            'start_time'=>'09:00:00',
            'end_time'=>'20:00:00',
            'kunlik_time'=>'11',
            'oylik_time'=>'220'
        ]);
    }
}
