<?php namespace Ahorak\Movies\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAhorakMoviesActors extends Migration
{
    public function up()
    {
        Schema::create('ahorak_movies_actors', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ahorak_movies_actors');
    }
}
