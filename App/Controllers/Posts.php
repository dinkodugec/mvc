<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Post;

/**
 * Posts controller
 */
class Posts extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $posts = Post::getAll();

     /*  echo 'Hello from the index action in the Posts controller!';
      echo '<p>Query string parameters: <pre>' .
           htmlspecialchars(print_r($_GET, true)) . '</pre></p>'; */
           View::renderTemplate('Posts/index.html',[
            'posts' => $posts
           ]);
    }

    /**
     * Show the add new page
     *
     * @return void
     */
    public function addNewAction()
    {
        $posts = new Post($_FILES);

        var_dump($_FILES);


        if($posts->addPost()){
            $this->redirect('/signup/success');
        } 
       


         /*  View::renderTemplate('Posts/addNew.html',[
              'posts' => $posts 
           ]);   */
    }

     /**
     * Show the edit page
     *
     * @return void
     */
    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';  //print all route parameters pass to object
    }
}