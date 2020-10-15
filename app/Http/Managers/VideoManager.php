<?php 

Namespace App\Http\Managers;
use Illuminate\Support\Facades\Auth;

class VideoManager{

    public function VideoStorage($video){
        $fileFullname = $video->getClientOriginalName();
        $fileName = pathinfo($fileFullname, PATHINFO_FILENAME);
        $extention =  $video->getClientOriginalExtension();
        $file = time() . '_' . $fileName . '.' . $extention;
        $video->storeAs('public/courses_sections/' . Auth::user()->id, $file);
        return $file;
    }

    public function getVideoDuration($video){
        $getID3 = new \getID3();
       
        $pathVideo = 'storage/courses_sections/' . Auth::user()->id . '/' . $video;
        $fileAnalyse = $getID3->analyze($pathVideo);
        $playtime_seconds = $fileAnalyse['playtime_string'];
        return $playtime_seconds;
    }
    
}