<?php namespace Ahorak\Profile;

use System\Classes\PluginBase;

use Rainlab\User\Controllers\Users as UsersController; 
use Rainlab\User\Models\User as UsersModel; 

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot(){
        
        UsersModel::extend(function($model){
            $model->addFillable([ //add Fillable fields
                'facebook',
                'bio'
            ]);
        });

        UsersController::extendFormFields(function($form, $model, $context){
            
            $form->addTabFields([
                'facebook' => [
                    'label' => 'Facebook',
                    'type' => 'text',
                    'tab' => 'Profile' //appear in a different tab
                ],
                'bio' => [
                    'label' => 'Bio',
                    'type' => 'textarea', // more space than text
                    'tab' => 'Profile' //appear in a different tab
                ]
            ]);
        });
    }
}
