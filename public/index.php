<?php



/**
 * Front controller
 */


ini_set('session.cookie_lifetime', '864000');   ///ten days in seconds...when set this, cookies expires after 10days 

// echo 'Requested URL = "' . $_SERVER['QUERY_STRING'] . '"';

// Require the controller class
/* require '../App/Controllers/Posts.php'; */

require_once dirname(__DIR__) . '/vendor/Autoload.php'; //this load all third party packages 




/* Composer  */

/* require '../vendor/autoload.php'; */

/**
 * Autoloader
 */
/* spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});   remove spl_autoload_register after autoloader via composer*/


/* 
Sessions
*/
session_start();

/* $_SESSION['pageCounter'] = $_SESSION['pageCounter'] +1;

echo $_SESSION['pageCounter']; */ // just to see how much people start session in our web site








/**
 * Routing
 */
/* require '../Core/Router.php'; */

$router = new Core\Router();

//echo get_class($router);  
/* The get_class() function gets the name of the class of an object. It returns FALSE if object is not an object. If object is excluded when inside a class,
 the name of that class is returned */

 
/* $router->add('', ['controller' => 'Home', 'action' => 'index']);  
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']); */ 


// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}'); //this route here for Signup Controller and method(action) Signup controller
/* $router->add('admin/{action}/{controller}');  */
$router->add('login', ['controller'=>'Login', 'action'=>'new']);  //add route for login, it will be like public/index.php?login
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']); //namespace like option 
$router->add('post/delete/{id}',  ['namespace' => 'Admin', 'controller' => 'Posts',  'action' => 'deletePost']); 
$router->add('comment/delete/{id}',  ['namespace' => 'Admin', 'controller' => 'Comments',  'action' => ' deleteComment']); 
$router->add('post', ['controller' => 'Posts', 'action' => 'showPost']);
/* $router->add('admin', ['namespace' => 'Admin','controller' => 'Dashboard', 'action' => 'index']); */
$router->add('getalldata', ['controller' => 'AjaxController', 'action' => 'allDAta']);
$router->add('password/reset/{token:[\da-f]+}', ['controller' => 'Password', 'action' => 'reset']);  //token is hexadecimal value which contains letters from a-f and numbers

    
/* // Display the routing table */
/* echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>'; */


// Match the requested route
/* $url = $_SERVER['QUERY_STRING'];
if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
} */

$router->dispatch($_SERVER['QUERY_STRING']);



/* $token = new \App\Token;
echo $token->getValue(); 
 create instance of Token class and call getValue() to se hash_mac()
 
 also we can create a new object of existing token
/* $token2 = new \App\Token('adb123);
echo $token2->getValue(); 


 
 */
/* 
echo password_hash("ron",PASSWORD_DEFAULT); */
?>