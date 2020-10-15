<?php

namespace App\Http\Controllers;


use App\Course;
use App\Section;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Managers\VideoManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CurriculumController extends Controller
{
    /**
     * After instanciation : 
     * add a video manager for managing the uploaded file (img only for this version)
     */
    public function __construct(VideoManager $videoManager)
    {
        $this->videoManager = $videoManager;
    }

    /**
     * return the section page of the created course
     */
    public function index($id)
    {
        $course = Course::find($id);
        return view('instructor.curriculum.index', [
            'course' => $course
        ]);
    }

    /**
     * Show the form for creating a new section
     */
    public function create($id)
    {
        $course = Course::find($id);
        return view('instructor.curriculum.create', [
            'course' => $course
        ]);
    }

    /**
     * Store a new section of the current course
     */
    public function store(Request $request, $id)
    {
        $course = Course::find($id);
        $section = new Section();
        $slugify = new Slugify();
        if ($request->input('section_name') && $request->file('section_video') && $request->input('section_text')):
            $section->name = $request->input('section_name');
            $section->text = $request->input('section_text');
            $section->slug = $slugify->slugify($section->name);
            $video = $this->videoManager->videoStorage($request->file('section_video'));
            $section->video = $video;
            $section->course_id = $id;
            /* 
             ** We do not get the video duration cause the youtube api is not set yet
             ** $playtime = $this->videoManager->getVideoDuration($video);
             ** a default value of 5 min will be added
              */
            $section->playtime_seconds = '5:00';
            $section->course_id = $course->id;
            $section->save();

            return redirect()->route('instructor.curriculum.create', $course->id)->with('success', 'Votre chapitre pour le cours "' . $course->title . '" a été ajouté avec succès.');
        else:
            return redirect()->route('instructor.curriculum.create', $course->id)->with('danger', 'Votre section doit comporter un titre, un vidéo (image) et un contenu pour être validée.');
        endif;
    }

    /**
     * show the form for updating the current section of the course
     */
    public function edit($id, $sectionId)
    {
        $course = Course::find($id);
        $section = Section::find($sectionId);

        return view('instructor.curriculum.edit', [
            'course' => $course,
            'section' => $section
        ]);
    }

    /**
     * update the section with the new infos added
     */
    public function update(Request $request, $id, $sectionId)
    {
        $course = Course::find($id);
        $section = Section::find($sectionId);
        $slugify = new Slugify();

        if ($request->input('section_name')) :
            // update of section name
            $section->name = $request->input('section_name');
            $section->slug = $slugify->slugify($section->name);
        endif;

        if ($request->input('section_text')) :
            $section->text = $request->input('section_text');
        endif;

        if ($request->file('section_video')) :
            // update of section video
            $video = $this->videoManager->videoStorage($request->file('section_video'));
            $section->video = $video;
            /* 
             ** We do not get the video duration cause the youtube api is not set yet
             ** $playtime = $this->videoManager->getVideoDuration($video);
             ** a default value of 5 min will be added
              */
            $section->playtime_seconds = '5:00';
        endif;

        $section->save();
        return redirect()->route('instructor.curriculum.index',  $course->id)->with('success', 'Le chapitre a été mis à jour avec succès.');
    }

    /**
     * destroy the section 
     */
    public function destroy($id, $sectionId)
    {
        $course = Course::find($id);
        $section = Section::find($sectionId);
        $fileToDelete = 'public/courses_sections/' . Auth::user()->id . '/' . $section->video;
        if (Storage::exists($fileToDelete)) :
            Storage::delete($fileToDelete);
        endif;
        $section->delete();
        return redirect()->route('instructor.curriculum.index',  $course->id)->with('success', 'Le chapitre "' . $section->name . '" a été supprimé avec succès.');
    }
}
