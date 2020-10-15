<?php

namespace App\Http\Controllers;

use App\Course;
use App\Section;
use App\Category;
use App\Http\Managers\CourseManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Managers\FormatManager;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    /** 
     * After instanciation : 
     * redirect the user to the course page if he has paid for it or to the admin page if he has published it.
     */
    public function __construct(CourseManager $courseManager)
    {
        $this->courseManager = $courseManager;
    }

    /**
     * return all the published courses 
     */
    public function courses()
    {
        $courses = Course::where('is_published', true)->get();
        $categories = Category::all();
        return view('courses.index', [
            'courses' => $courses,
            'categories' => $categories
        ]);
    }

     /**
     * return : 
     * the course page of the partcipant if he has paid for it 
     * the course page of the instructor if the user is the publisher
     * the course page of the visitor
     */
    public function show($category, $slug)
    {

        $category =  Category::where([
            'slug' => $category
        ])->firstOrFail();

        $course = Course::where([
            'is_published' => true,
            'slug' => $slug
        ])->firstOrFail();

        $recommendations = Course::where([
            ['id', '!=', $course->id],
            'is_published' => true,
            'category_id' => $category->id
        ])->limit(3)->get();

        if (Auth::user() != null):
            if (Auth::user()->paidCourses->where('slug', $course->slug)->count() != 0 || Auth::user()->courses->where('user_id', $course->user_id)->count()) :
                return $this->courseManager->getCourseView($slug);
            endif;
        endif;
        $formatManager = new FormatManager();
        return view('courses.show', [
            'category' => $category,
            'course' => $course,
            'formatManager' => $formatManager,
            'recommendations' => $recommendations

        ]);   
    }

    /**
     * return the courses page matching the sluged category added to the url 
     */
    public function category($slug)
    {
        $categories = Category::all();
        $category =  Category::where('slug', $slug)->firstOrFail();
        $courses = Course::where([
            'is_published' => true,
            'category_id' => $category->id
        ])->get();
        return view('courses.category', [
            'categories' => $categories,
            'category' => $category,
            'courses' => $courses

        ]);
    }
}
