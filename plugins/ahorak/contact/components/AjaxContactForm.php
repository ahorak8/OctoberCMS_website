<?php namespace Ahorak\Contact\Components;

use Cms\Classes\ComponentBase;

use Input; // Needed to get input values

use Mail; // Needed to be able to send emails

use Validator; // Needed to validate the form

use Redirect; // Needed to redirect page after validation

use ValidationException; // Used for new Ajax Validation method

class AjaxContactForm extends ComponentBase {

    // Define component details

    public function componentDetails() {
        return [
            'name' => 'Contact Form (Ajax)',
            'description' => 'Simple contact form (ajax validation)'
        ];
    }

    public function onSend() { // This will be bound to our contact form

        $data = post(); // grab all data coming from the contact form

        $rules = 
            [
                'name' => 'required',
                'email' => 'required|email'
            ];

        $validator = Validator::make($data, $rules);
        
        if($validator->fails()) {
            // Don't send email. Send error

            throw new ValidationException($validator);
            
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