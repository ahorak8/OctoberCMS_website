<?php namespace Ahorak\Movies\Models;

use Model;

/**
 * Model
 */
class Movie extends Model
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
    public $table = 'ahorak_movies_';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    // protected $jsonable = ['actors']; 

    // Relations

    public $belongsToMany =[
        'genres' => [
            'Ahorak\Movies\Models\Genre', //the link for October to look at. Make sure to use BACKWARD slashes
            'table' => 'ahorak_movies_movies_genres', //the name of the table to look up at the above link, aka the pivot table
            'order' => 'genre_title' //the order to be displayed by
        ],
        'actors' => [
            'Ahorak\Movies\Models\Actor', //the link for October to look at. Make sure to use BACKWARD slashes
            'table' => 'ahorak_movies_actors_movies', //the name of the table to look up at the above link, aka the pivot table
            'order' => 'name' //the order to be displayed by
        ]
    ];


    public $attachOne = [
        'poster' => 'System\Models\File'
    ];

    public $attachMany = [
        'movie_gallery' => 'System\Models\File'
    ];

}
