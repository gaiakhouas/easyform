<?php 

Namespace App\Http\Managers;
use App\Course;
use Illuminate\Support\Carbon;


class TitleManager{
   
   /**
    * check if slug already exists in course model 
    */
   public function validSlug($slug){
        $course = Course::where('slug', $slug)->first();
        if($course):
         return false;
        else:
         return true;
        endif;   
   }
}
