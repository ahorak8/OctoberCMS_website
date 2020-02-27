<?php namespace Ahorak\Contact;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Ahorak\Contact\Components\ContactForm' => 'contactform',
            'Ahorak\Contact\Components\AjaxContactForm' => 'ajaxcontactform',
        ];
    }

    public function registerSettings()
    {
    }
}
