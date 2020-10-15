<?php

namespace App\Http\Controllers;

use App\Course;
use App\Payment;
use App\Section;
use App\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    /**
     * After instanciation : 
     * redirect the user to the login page if he not connected
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * return the courses paid form the current user
     */
    public function index()
    {
        $coursesUser = CourseUser::where('user_id', Auth::user()->id)->get();
        return view('participant.courses', [
            'coursesUser' =>  $coursesUser
        ]);
    }

    /**
     * show the course content 
     */
    public function show($category, $slug)
    {

        $course = Course::where('slug', $slug)->firstOrFail();
        $courseSection = Section::where('course_id', $course->id)->firstOrFail();
        $sections = Section::where('course_id', $course->id)->get();

        return view('participant.course', [
            'course' => $course,
            'courseSection' =>  $courseSection,
            'sections' =>  $sections
        ]);
    }

    /**
     * show the course content with the sluged section added in the url
    */
    public function section($category, $slug, $section)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $courseSection = Section::where('slug', $section)->firstOrFail();
        $sections = Section::where('course_id', $course->id)->get();

        return view('participant.course', [
            'course' => $course,
            'courseSection' =>  $courseSection,
            'sections' =>  $sections
        ]);
    }
}
