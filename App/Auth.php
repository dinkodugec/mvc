<?php

namespace App;

use \App\Models\User;
use App\Models\RememberedLogin;

/**
 * Authentication
 */
class Auth
{
    /**
     * Login the user
     *
     * @param User $user The user model
     *
     * @return void
     */
    public static function login($user, $remember_me)
    {
        session_regenerate_id(true); //Update the current session id with a newly generated one

        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
         $_SESSION['user_email'] = $user->email; 

        if($remember_me){

             if($user->rememberLogin()){
                setcookie('remember_me', $user->remember_token, $user->expiry_timestamp, '/');
                // first argument in setcookie() is name of argument, second argument is value
                // remember me is name of cookiem,  $user->remember_token is value, $user->expiry_timestamp is time for expired and '/' is path
              }
        }
    }

    /**
     * Logout the user
     *
     * @return void
     */
    public static function logout()
    {
      // Unset all of the session variables
      $_SESSION = [];

      // Delete the session cookie
      if (ini_get('session.use_cookies')) {
          $params = session_get_cookie_params();

          setcookie(
              session_name(),
              '',
              time() - 42000,
              $params['path'],
              $params['domain'],
              $params['secure'],
              $params['httponly']
          );
      }

      // Finally destroy the session
      session_destroy();

      static::forgetLogin();
    }

    /**
     * Return indicator of whether a user is logged in or not
     *
     * @return boolean
     */
    public static function isLoggedIn()  //check is user_id is set in $_SESSION
    {
        return isset($_SESSION['user_id']);
    }    

    public static function nameUser()
    {
        return isset($_SESSION['user_name']);
    }


       /**
     * Return indicator of whether a user is admin in or not
     *
     * @return boolean
     */

    public static  function isAdmin()
    {
        
      
          $admin = User::admin();

                if($admin['email'] === ($_SESSION['user_email'])){
          
                        return true;

                    } else {

                    return false;
                    
                    }

    }

   

     /**
     * Remember the originally-requested page in the session
     *
     * @return void
     */
    public static function rememberRequestedPage()
    {
        $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    }

    /**
     * Get the originally-requested page to return to after requiring login, or default to the homepage
     *
     * @return void
     */
    public static function getReturnToPage()   //if this value does not exits in $_SESSION we return to homepage
    {
        return $_SESSION['return_to'] ?? '/';
    }

        /**
     * Get the current logged-in user, from the session or the remember-me cookie
     *
     * @return mixed The user model or null if not logged in
     */
    public static function getUser()
    {
        if (isset($_SESSION['user_id'])) {
            return User::findByID($_SESSION['user_id']);
        }
    }

       /**
     * Login the user from a remembered login cookie
     *
     * @return mixed The user model if login cookie found; null otherwise
     */
    protected static function loginFromRememberCookie()
    {
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie) {

            $remembered_login = RememberedLogin::findByToken($cookie);

            if ($remembered_login && ! $remembered_login->hasExpired()) {

                $user = $remembered_login->getUser();

                static::login($user, false);

                return $user;
            }
        }
    }

      /**
     * Forget the remembered login, if present
     *
     * @return void
     */
    protected static function forgetLogin()
    {
        $cookie = $_COOKIE['remember_me'] ?? false;

        if ($cookie) {

            $remembered_login = RememberedLogin::findByToken($cookie);

            if ($remembered_login) {

                $remembered_login->delete();

            }

            setcookie('remember_me', '', time() - 3600);  // set to expire in the past
        }
    }

    
}