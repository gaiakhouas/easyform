<?php

use App\Course;
use App\Category;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slugify = new Slugify();
        $course= new Course();
        $course->title="Les bases de Symfony 4";
        $course->subtitle="Apprendre à créer un site avec Symfony 4";
        $course->slug=$slugify->slugify($course->title);
        $course->description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, ante nec rhoncus rhoncus, eros quam sagittis ligula, id rhoncus leo risus quis ante.";
        $course->price=19.99;
        $course->category_id=App\Category::all()->random(1)->first()->id;
        $course->user_id=App\User::all()->random(1)->first()->id;
        $course->image="";
        $course->save();

        $course= new Course();
        $course->title="Apprendre Wordpress";
        $course->subtitle="Construire un site ecommerce complet avec Wordpress";
        $course->slug=$slugify->slugify($course->title);
        $course->description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, ante nec rhoncus rhoncus, eros quam sagittis ligula, id rhoncus leo risus quis ante.";
        $course->price=14.99;
        $course->category_id=App\Category::all()->random(1)->first()->id;
        $course->user_id=App\User::all()->random(1)->first()->id;
        $course->image="";
        $course->save();

        $course= new Course();
        $course->title="Les bases de Laravel 7";
        $course->subtitle="Créer une plateforme d'enseignements avec Laravel 7";
        $course->slug=$slugify->slugify($course->title);
        $course->description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod, ante nec rhoncus rhoncus, eros quam sagittis ligula, id rhoncus leo risus quis ante.";
        $course->price=39.99;
        $course->category_id=App\Category::all()->random(1)->first()->id;
        $course->user_id=App\User::all()->random(1)->first()->id;
        $course->image="";
        $course->save();

    }
}
