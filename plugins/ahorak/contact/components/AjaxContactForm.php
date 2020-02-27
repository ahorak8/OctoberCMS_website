<?php namespace Ahorak\Contact\Components;

use Cms\Classes\ComponentBase;

use Input; // Needed to get input values

use Mail; // Needed to be able to send emails

use Validator; // Needed to validate the form

use Redirect; // Needed to redirect page after validation

class AjaxContactForm extends ComponentBase {

    // Define component details

    public function componentDetails() {
        return [
            'name' => 'Contact Form (Ajax)',
            'description' => 'Simple contact form (ajax validation)'
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

            // Render a partial that doesn't need a page reload to work
            return ['#result' => $this->renderPartial('ajaxcontactform::messages', [
                'errorMsgs' => $validator->messages()->all(), // Display all below form
                'fieldMsgs' => $validator->messages() // To display under each field
            ])
            ];

            // Find the result div, render a partial in it, from messages.htm . Send data to the partial
            
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