<?php namespace Ahorak\Movies\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAhorakMovies3 extends Migration
{
    public function up()
    {
        Schema::table('ahorak_movies_', function($table)
        {
            $table->dropColumn('actors');
        });
    }
    
    public function down()
    {
        Schema::table('ahorak_movies_', function($table)
        {
            $table->text('actors')->nullable();
        });
    }
}
