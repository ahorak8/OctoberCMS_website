<?php namespace Ahorak\Profile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddNewFields extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            //variable->type('name')->options 
            $table->string('facebook')->nullable();
            $table->text('bio')->nullable();
        });
    }

    public function down() //Used when you want to refresh and start database anew. Or revert to previous version
    {
        // Schema::dropIfExists('users'); // Will delete user table
        
        $table->dropDown( [ // An array of which fields to remove
            'facebook', // Will delete 'facebook' field
            'bio' // Will delete 'bio' field
        ]);
    }

}
