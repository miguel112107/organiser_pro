<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Mail;
use App\Mail\Email;
use App\Mail\PasswordReset;
use App\Mail\ResetSuccess;

class MailController extends Controller
{
    /**
     * Primary email for tests
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from EventOrganizerPro.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('maflores1108@gmail.com')->send(new Email($mailData));

        dd("Email is sent successfully.");
    }

    /**
     * Function to send emails when password is reset. 
     *
     * @return response()
     */
    public function passwordResetRequest($url, $email)
    {
        $mailData = [
            'title' => 'Password Rest',
            'url' => $url,
        ];
        Mail::to($email)->send(new PasswordReset($mailData));
    }

    /**
     * Function to send emails when password is reset. 
     *
     * @return response()
     */
    public function passwordReset($pass, $email)
    {
        $mailData = [
            'title' => 'Password Rest',
            'body' => 'User password has been reset to: ' . $pass . " . Please log in and try new password"
        ];
        Mail::to($email)->send(new PasswordReset($mailData));
    }

    /**
     * Function to send emails when customer account is created
     *
     * @return response()
     */
    public function customerWelcomeEmail($userPass, $url_handle, $email)
    {
        $mailData = [
            'title' => 'Welcome to Event Organizer Pro',
            'body' => 'You user password is: ' . $userPass,
            'url_handle' => $url_handle
        ];
        Mail::to($email)->send(new PasswordReset($mailData));
    }

    /**
     * Function to send emails when customer account is created
     *
     * @return response()
     */
    public function resetSuccess($email)
    {
        $mailData = [
            'title' => 'Password Reset Success',
            'email' => $email,
            'body' => "Hello! You have successfully changed your Password at <strong>Event Organizer Pro</strong>. If this was not you please contact <a>Support</a> immediately.",
        ];
        //change email to an admin email address that will receive contact form emails

        Mail::to($email)->send(new ResetSuccess($mailData));
    }
}
