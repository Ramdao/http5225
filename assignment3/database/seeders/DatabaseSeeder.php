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
            Breed::factory()->create([
                'name' => 'Siamese',
                'image_url' => 'https://cdn.prod.website-files.com/659c0b0024c127bdbe890959/673afd25892be17ee3ea1c52_41.jpg',
            ]),
            Breed::factory()->create([
                'name' => 'Maine Coon',
                'image_url' => 'https://sustainablecats.com/wp-content/uploads/2024/05/MAine-Coon-Giant.jpg',
            ]),
            Breed::factory()->create([
                'name' => 'Persian',
                'image_url' => 'https://www.trupanion.com/images/trupanionwebsitelibraries/bg/persian-cat-1-.jpg?sfvrsn=bd481eb3_5',
            ]),
            Breed::factory()->create([
                'name' => 'Bengal',
                'image_url' => 'https://www.trupanion.com/images/trupanionwebsitelibraries/pet-blogs/bengal-cat-1-.jpg?sfvrsn=4f56903_6',
            ]),
            Breed::factory()->create([
                'name' => 'Ragdoll',
                'image_url' => 'https://www.trupanion.com/images/trupanionwebsitelibraries/pet-blogs/ragdoll-cat2-1-.jpg?sfvrsn=63cb9b08_6',
            ]),
        ]);
        

       
        $cats = Cat::factory(20)->create(); 

        // Attach a random breed to each cat
        foreach ($cats as $cat) {
            $randomBreed = $breeds->random();
            $cat->breeds()->attach($randomBreed->id);
        }
    }
}
