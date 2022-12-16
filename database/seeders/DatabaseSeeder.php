<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Robert Ochieng',
            'email' => 'robert@gmail.com'
        ]);
        
        listing::factory(10)->create([
            'user_id' => $user->id
        ]);
        
    }
}
