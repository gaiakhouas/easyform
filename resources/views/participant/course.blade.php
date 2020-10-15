@extends('layouts.app')

@section('content')

    <section class="latest-blog container-fluid px-5 spad">
        <h2 class="text-center my-3">{{ $course->title }} : {{ $courseSection->slug }}</h2>
        <br>
        <div class="row">
            <div class="col-md-8">
                <div class="embed-responsive embed-responsive-21by9">
                    <iframe class="embed-responsive-item" style="border:0"
                        src="{{ asset('storage/courses_sections/' . $course->user_id . '/' . $courseSection->video . '') }}">
                    </iframe>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-group list-group-flush mt-5 pt-2">
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($sections as $section)
                        <li class="list-group-item bg-light">
                            <a href="{{ route('participant.course.section', [
                                    'category' => $course->category->slug,
                                    'slug' => $course->slug,
                                    'section' => $section->slug,
                                ]) }}" class="btn">
                                <i class="fas fa-book"></i>
                                Chapitre {{ $i }} : {{ $section->name }}
                            </a>
                        </li>
                        @php
                        $i++
                        @endphp
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12 mt-4 pt-4">
                <h3 class="text-center">Contenu du cours</h3>
                <hr>
                <div class="d-flex align-content-end flex-wrap pt-4">
                    <p>{{ $courseSection->text }}</p>
                </div>
            </div>
        </div>
    </section>

@stop
