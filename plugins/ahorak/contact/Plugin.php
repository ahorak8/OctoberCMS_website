<?php namespace Ahorak\Contact;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Ahorak\Contact\Components\ContactForm' => 'contactform',
            'Ahorak\Contact\Components\OldAjaxContactForm' => 'oldajaxcontactform', // Old method
            'Ahorak\Contact\Components\AjaxContactForm' => 'ajaxcontactform', // Easy new method
        ];
    }

    public function registerSettings()
    {
    }
}
