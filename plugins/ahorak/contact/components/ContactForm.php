<?php namespace Ahorak\Contact\Components;

use Cms\Classes\ComponentBase;

use Input; // Needed to get input values

use Mail; // Needed to be able to send emails

use Validator; // Needed to validate the form

use Redirect; // Needed to redirect page after validation

class ContactForm extends ComponentBase {

    // Define component details

    public function componentDetails() {
        return [
            'name' => 'Contact Form',
            'description' => 'Simple contact form'
        ];
    }

    public function onSend() { // This will be bound to our contact form

        $validator = Validator::make(
            [
                'name' => Input::get('name'),
                'email' => Input::get('email')
            ],
            [
                'name' => 'required',
                'email' => 'required|email'
            ]
        );
        
        if($validator->fails()) {
            // Don't send email. Send error

            return Redirect::back()->withErrors($validator); // Return to the page you're currently on, with errors
            
        } else {
            // Send email

            $vars = ['name' => Input::get('name'), 
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

}