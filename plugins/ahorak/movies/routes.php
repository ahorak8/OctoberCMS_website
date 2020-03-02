<?php
    
    use Ahorak\Movies\Models\Movie;
    use Ahorak\Movies\Models\Actor;
    use Ahorak\Movies\Models\Genre;

    Route::get('seed-actors', function () { // When someone access this page
        // execute everything in here:

        $faker = Faker\Factory::create();

        $number = 100; // This is how many fake sets will be created
        
        for($i=0; $i < $number; $i++) {
            
            Actor::create([ // Creating an actor
                // Pass it an array of the fields in Actors model
                'name' => $faker->firstName,
                'lastname' => $faker->lastName
            ]);
        }

        return "Actors created!";
    });

    Route::get('sitemap.xml', function(){ //Sitemap
        $movies = Movie::all();

        $genres = Genre::all();

        // view = template file
        return Response::view('ahorak.movies::sitemap', ['movies' => $movies, 'genres' => $genres])->header('Content-Type', 'text/xml');
    });