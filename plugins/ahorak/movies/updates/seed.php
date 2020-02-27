<?php namespace Ahorak\Movies\Updates;

use Ahorak\Movies\Models\Movie;

use October\Rain\Database\Updates\Seeder;

use Faker;

class SeedAllTables extends Seeder {

    public function run(){
        
        $faker = Faker\Factory::create();

        $number = 100; // This is how many fake sets will be created
        
        for($i=0; $i < $number; $i++) {

            $name = $faker->sentence($nbWords = 3, $variableNbWords = true);
            // create , with maximum of 3 words, and change those words up
            
            Movie::create([ // Creating a movie
                // Pass it an array of the fields in Movie model
                'name' => $name,
                'slug' => str_slug($name, '-'), // Using $name so that the slug will be the same as the name
                        // str_slug is a Laravel help. '-' = use dashes instead of spaces
                'description' => $faker->paragraph($nbSetences = 3, $variableNbSetences = true),
                        // create paragraph, with maximum of 3 sentences, and change those sentences up
                'year' => $faker->year($max = 'now')
            ]);
        }
    }   
}

