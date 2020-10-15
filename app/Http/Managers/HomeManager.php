<?php

namespace App\Http\Managers;

use App\User;
use App\Course;
use App\Payment;
use App\Category;
use App\Http\Clients\UdemyClient;


class HomeManager
{
    /**
     * After instanciation : 
     * get udemy client
     */
    public function __construct(UdemyClient $udemyClient)
    {
        $this->udemyClient = $udemyClient;

    }

    /**
     * return home page with udemy data
     */
    public function getHome()
    {
        $payments = Payment::select('course_id')->distinct()->get();
        $users_id = Course::select('user_id')->distinct()->find($payments);
        $instructors = User::limit(5)->find($users_id);
        $category = Category::where('id', 2)->firstOrFail();
        $udemy =  $this->udemyClient->getUdemyCourses();
        //dd($udemy);
        return view('main.home', [
            'instructors' => $instructors,
            'courses' => $udemy['results']
        ]);
    }
}
