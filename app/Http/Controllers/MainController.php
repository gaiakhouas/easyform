<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Payment;
use App\Category;
use App\Http\Clients\UdemyClient;
use Illuminate\Http\Request;
use App\Http\Managers\HomeManager;

class MainController extends Controller
{
    /**
     * After instanciation : 
     * add a manager for redirecting the user to the home page with udemy data
     */
    public function __construct(HomeManager $homeManager)
    {
        $this->homeManager = $homeManager;
    }

    /**
     * redirect the user to the home page with udemy courses
     */
    public function home()
    {
        return $this->homeManager->getHome();
    }
}
