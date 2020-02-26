<?php namespace Ahorak\Movies\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAhorakMoviesGenres extends Migration
{
    public function up()
    {
        Schema::create('ahorak_movies_genres', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('genre_title');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ahorak_movies_genres');
    }
}
