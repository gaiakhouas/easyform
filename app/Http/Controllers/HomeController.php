<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Managers\HomeManager;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeManager $homeManager)
    {
        $this->homeManager = $homeManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->homeManager->getHome();
    }
}
