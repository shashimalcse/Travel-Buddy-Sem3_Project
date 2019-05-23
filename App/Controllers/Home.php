<?php

namespace App\Controllers;

use \Core\View;
use App\Auth;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
//\App\Mail::send('shashimalsenarathz97@gmail.com','Test','This is a test');

        View::renderTemplate('Home/index.html');
    }
}
