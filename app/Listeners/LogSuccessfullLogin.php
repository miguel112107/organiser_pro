<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
     * LogSuccessfulLogin constructor.
     */
    public function __construct()
    {
        //
    }

    public function handle(Login $login)
    {
        // Store the date that the user last logged in.
        $user = $login->user;
        $user->setAttribute('last_login', Carbon::now())->save();
    }

}
