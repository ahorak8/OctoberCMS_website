<?php namespace Ahorak\Movies\Models;

use Model;

/**
 * Model
 */
class Actor extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ahorak_movies_actors';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    // Relations

    public $belongsToMany =[
        'movies' => [
            'Ahorak\Movies\Models\Movie', //the link for October to look at. Make sure to use BACKWARD slashes
            'table' => 'ahorak_movies_actors_movies', //the name of the table to look up at the above link, aka the pivot table
            'order' => 'name' //the order to be displayed by
        ]
    ];

    // Accessor
    public function getFullNameAttribute() { 
        // attribute will be called as full_name
        return $this->name . " " . $this->lastname; 
        // Returns both values concatenated with a space between
    }
}
