<?php namespace Ahorak\Contact\Components;

use Cms\Classes\ComponentBase;

use Input; // Needed to get input values

use Mail; // Needed to be able to send emails

class ContactForm extends ComponentBase {

    // Define component details

    public function componentDetails() {
        return [
            'name' => 'Contact Form',
            'description' => 'Simple contact form'
        ];
    }

    public function onSend() { // This will be bound to our contact form

        $vars = ['name' => Input::get('email'), 
                'email' => Input::get('email'),
                'content' => Input::get('content')
                ];
            // Input::get('var') is used to get the value from the form

        Mail::send('ahorak.contact::mail.message', $vars, function($message) {
            $message->to('admin@domain.tld', 'Admin Person');
            $message->subject('New message from contact form');
        });
    }

}