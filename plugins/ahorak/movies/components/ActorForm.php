<?php namespace Ahorak\Movies\Components;

use Cms\Classes\ComponentBase;

use Input; // Needed to get input values

use Validator; // Needed to validate the form

use Redirect; // Needed to redirect page after validation

use Ahorak\Movies\Models\Actor; // using actor model

use Flash; // used to give confirmation message on actor saved

class ActorForm extends ComponentBase {

    // Define component details
    public function componentDetails() {
        return [
            'name' => 'Actor Form',
            'description' => 'Enter actors'
        ];
    }

    public function onSave() { // This will be bound to the form
        // Save actor to database. Laravel method:

        $actor = new Actor(); //instantiated Actor class

        $actor->name = Input::get('name'); //set name 
        $actor->lastname = Input::get('lastname'); //set last name
        $actor->actorimage = Input::file('actorimage'); // Set actor image 

        $actor->save(); // save actor

        Flash::success('Actor added'); // On success, show message

        return Redirect::back(); // Return back to that page
    }

}

