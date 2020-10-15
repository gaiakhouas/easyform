<?php

namespace App\Http\Managers;

use App\Course;
use App\Section;
use Illuminate\Support\Facades\Auth;

class CourseManager
{
    /**
     * get the course page related to the current user connected
     */
    public function getCourseView($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $courseSection = Section::where('course_id', $course->id)->firstOrFail();
        $sections = Section::where('course_id', $course->id)->get();

        if (Auth::user()->paidCourses->where('slug', $course->slug)->count() != 0) :
            // client view
            return redirect()->route('participant.course.show', [
                'category' => $course->category->slug,
                'slug' => $course->slug
            ]);
        else :
            return  redirect()->route('instructor.edit', [
                'id' => $course->id
            ]);
        endif;
    }
}
