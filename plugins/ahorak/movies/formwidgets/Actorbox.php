<?php namespace Ahorak\Movies\FormWidgets;

use Backend\Classes\FormWidgetBase;

use Ahorak\Movies\Models\Actor;

/**
 * Actorbox Form Widget
 */
class Actorbox extends FormWidgetBase
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'ahorak_movies_actorbox';


    public function widgetDetails()
    {
        return [
            'name' => 'Actorbox',
            'description' => 'Field for adding actors'
        ];
    }

    /**
     * @inheritDoc
     */
    public function init()
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        // dump($this->vars['variable']); //To check all the variables on the form
        return $this->makePartial('actorbox');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['id'] = $this->model->id; // Add property of model->id to the vars object, saved as id
        $this->vars['actors'] = Actor::all()->lists('full_name', 'id');

        // Name variable for the widget and its array. '[]' indicates we are passing an array of values
        $this->vars['name'] = $this->formField->getName().'[]'; 

        // Create a variable for the selected values in the model
        // and an if statement in the case the array is empty
       if(!empty($this->getLoadValue())){
        $this->vars['selectedValues'] = $this->getLoadValue(); 
       } else {
           $this->vars['selectedValues'] = []; //pass an empty array
       }   
    }
        // $this->vars['value'] = $this->getLoadValue();
        // $this->vars['model'] = $this->model;

        // Check what values we are currently getting:
     public function getSaveValue($actors) {
        
        $newArray = [];
        
        foreach($actors as $actorID) {
            if(!is_numeric($actorID)) {
                // this will be new values inputted via form widget
                // Because it is not in the DB table already, we must save it to the DB first
                // This will add it and assign it an id

                $newActor = new Actor; // Create new actor
                $nameLastname = explode(' ', $actorID); // This will save to an array, separated by a space

                $newActor->name = $nameLastname[0]; // Fetches first thing from the array
                $newActor->lastname = $nameLastname[1]; // Fetches 2nd thing from array, which comes after the space

                $newActor->save(); // Save new actor

                $newArray[] = $newActor->id; // Now that it has an id, we can save it to the newArray

            } else {
                $newArray[] = $actorID; // Saving numeric values (id) to the new array
            }
        }

        // dd($newArray);

        return $newArray;
    }
    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->addCss('css/actorbox.css', 'ahorak.movies');
        $this->addJs('js/actorbox.js', 'ahorak.movies');
    }

    /**
     * @inheritDoc
     */
    // public function getSaveValue($value)
    // {
    //     return $value;
    // }
}
