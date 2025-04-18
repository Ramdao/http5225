<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cat;
use App\Models\Breed;
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

        $breeds = collect([
            Breed::factory()->create(['name' => 'Siamese']),
            Breed::factory()->create(['name' => 'Maine Coon']),
            Breed::factory()->create(['name' => 'Persian']),
            Breed::factory()->create(['name' => 'Bengal']),
            Breed::factory()->create(['name' => 'Ragdoll']),
        ]);

       
        $cats = Cat::factory(20)->create(); 

        // Attach a random breed to each cat
        foreach ($cats as $cat) {
            $randomBreed = $breeds->random();
            $cat->breeds()->attach($randomBreed->id);
        }
    }
}
