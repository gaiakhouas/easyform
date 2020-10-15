<?php

use App\Category;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $slugify = new Slugify();
        $category->icon ='<i class="fas fa-code"></i>';
        $category->name = "Développement Web";
        $category->slug = $slugify->slugify( $category->name);
        $category->save();

        $category = new Category();
        $category->icon='<i class="fas fa-terminal"></i>';
        $category->name="Développement logiciel";
        $category->slug = $slugify->slugify( $category->name);
        $category->save();

        $category= new Category();
        $category->icon='<i class="fas fa-network-wired"></i>';
        $category->name="Infrastructure";
        $category->slug = $slugify->slugify( $category->name);
        $category->save();


    }
}
