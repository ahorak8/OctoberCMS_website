<?php namespace Ahorak\Movies\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAhorakMovies extends Migration
{
    public function up()
    {
        Schema::table('ahorak_movies_', function($table)
        {
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('ahorak_movies_', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
