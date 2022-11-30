<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Password controller
 */
class Password extends \Core\Controller
{
    /**
     * Show the forgotten password page
     *
     * @return void
     */
    public function forgotAction()
    {
        View::renderTemplate('Password/forgot.html');
    }

        /**
     * Send the password reset link to the supplied email
     *
     * @return void
     */
    public function requestResetAction()
    {
        User::sendPasswordReset($_POST['email']);

        View::renderTemplate('Password/reset_requested.html');
    }

       /**
     * Show the reset password form
     *
     * @return void
     */
    public function resetAction()
    {
        $token = $this->route_params['token'];  //token value from url

       /*  echo $token; */

       $user = User::findByPasswordReset($token);  //call method from user class and passing token from url

       if($user){
          
        View::renderTemplate('Password/reset.html');

       } else {
        
            echo "password reset token invalid";
       }
    }
}