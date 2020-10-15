<?php

namespace App\Http\Controllers;

use App\Course;
use App\Payment;
use App\Section;
use App\Category;
use App\Http\Managers\FormatManager;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Managers\TitleManager;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('instructor.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $slugify = new Slugify();
        $course = new Course();
        $titleManager = new TitleManager();

        $course->title = $request->input('title');
        $course->subtitle = $request->input('subtitle');
        $course->slug = $slugify->slugify($course->title);
        $course->description = $request->input('description');
        $course->category_id = $request->input('category');
        $course->user_id = Auth::user()->id;

        //Upload management of the image
        $image = $request->file('image');
        $imageFullname = $image->getClientOriginalName();
        $imageName = pathinfo($imageFullname, PATHINFO_FILENAME);
        $extention =  $image->getClientOriginalExtension();
        $file = time() . '_' . $imageName . '.' . $extention;

        //Storage of the image
        $image->storeAs('public/courses/' . Auth::user()->id, $file);
        $course->image = $file;
        // checking the title field 
        if ($titleManager->validSlug($course->slug)) :
            $course->save();
            return redirect()->route('instructor.index')->with('success', 'Votre cours "' . $course->title . '" a été enregistré avec succès !');
        else :
            return redirect()->route('instructor.create')->with('danger', 'Oups ce titre de cours est déjà pris. Choisissez-en un autre.');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $categories = Category::all();

        return  view('instructor.edit', [
            'course' => $course,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slugify = new Slugify();
        $course = Course::find($id);
        $categories = Category::all();
        $titleManager = new TitleManager();

        $course->title = $request->input('title');
        $course->subtitle = $request->input('subtitle');
        $course->slug = $slugify->slugify($course->title);
        $course->description = $request->input('description');
        $course->category_id = $request->input('category');

        if ($request->file('image')) :
            //Upload management of the image
            $image = $request->file('image');
            $imageFullname = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullname, PATHINFO_FILENAME);
            $extention =  $image->getClientOriginalExtension();
            $file = time() . '_' . $imageName . '.' . $extention;

            //Storage of the image
            $image->storeAs('public/courses/' . Auth::user()->id, $file);
            $course->image = $file;
        endif;
        if ($titleManager->validSlug($course->slug)) :
            $course->save();
            return redirect()->route('instructor.index')->with('success', 'Vos modifications ont été sauvegardées avec succès !');
        else :
            return redirect()->back()->with('danger', 'Oups ce titre de cours est déjà pris. Choisissez-en un autre.');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('instructor.index')->with('success', 'Votre cours a été supprimé avec succès !');
    }

    public function publish($id)
    {
        $course = Course::find($id);
        if ($course->price && count($course->sections) > 0) :
            $course->is_published = true;
            $course->save();
            return redirect()->back()->with('success', 'Votre cours a été publié avec succès !');
        else :
            return redirect()->back()->with('danger', 'Votre cours doit avoir un tarif ainsi qu\'au moins une section.');
        endif;
    }

    public function participants($id)
    {
        $course = Course::find($id);
        $participants = Payment::where([
            'course_id' => $course->id,
            ['email', '!=',  Auth::user()->email],
        ])->get();

        $formatManager = new FormatManager();

        return view('instructor.participants', [
            'course' => $course,
            'participants' => $participants,
            'formatManager' => $formatManager
        ]);
    }
}
