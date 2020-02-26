<?php namespace Ahorak\Movies;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [       // Return an array of components that we have
            'Ahorak\Movies\Components\Actors' => 'actors' // Assign the component an alias
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Ahorak\Movies\FormWidgets\Actorbox' => [
                'label' => 'Actorbox field',
                'code' => 'actorbox'
                ]
            ];
    }

    public function registerSettings()
    {
    }
}
