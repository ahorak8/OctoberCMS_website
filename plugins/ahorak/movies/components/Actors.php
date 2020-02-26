<?php namespace Ahorak\Movies\Components; //namespace

use CMS\Classes\ComponentBase; // use the ComponentBase class

use Ahorak\Movies\Models\Actor; // Will be displaying actors so we must use the actor model

class Actors extends ComponentBase {

    public function componentDetails() {                // Set the details for this component
        return [
            'name' => 'Actors list',
            'description' => 'List of actors'
        ];
    }

    public function defineProperties() {

        return [ // return an array with some arrays in it. Every array will be an option for the component
            'results' => [ // first array = option: results
                'title' => 'Number of actors', //title of option
                'description' => 'How many do you want to display? (0=all)', //description of option
                'default' => 0, // default value of option. (0 = displays all)
                'validationPattern' => '^[0-9]+$', // regex validation pattern for numbers
                'validatonMessage' => 'Enter only numbers' // define validation messahe
            ]
        ];
    }

    public function onRun() { // What to do onRun of the component
        $this->actors = $this->loadActors(); // Load the actors and assign them to a variable
    }

    protected function loadActors() {          // Setting the data for the component
        
        $query = Actor::all(); 

        if($this->property('results') > 0) { // Checking if the property named results if greater than 0

            $query = $query->take($this->property('results')); // taking the amount given by property results
        }

        return $query;
        
        // return Actor::all();                   // Laravel method for returning all actors
        // return Actor::all()->take(3);           // Method to return a set amount of actors  
    }

    public $actors; // Define the variable
}