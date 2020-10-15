@extends('layouts.app')

@section('content')

<section class="hero-section set-bg" data-setbg="{{ asset('img/hero.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero-text">
                    <h2>Formez-vous à votre passion !</h2>
                    <p class="strenghts"><i class="fa fa-check" aria-hidden="true"></i> Une formation complète</p>
                    <p class="strenghts"><i class="fa fa-check" aria-hidden="true"></i> Des enseignants de qualité</p>
                    <p class="strenghts"><i class="fa fa-check" aria-hidden="true"></i> Un support continu 24h/24 et 7j/7</p>
                    <a href="{{ route('courses.index') }}" class="primary-btn my-5">Faire un essai</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-about-section spad animate__animated animate__fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="ha-pic mt-5">
                    <img src="{{ asset('img/e-learning.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ha-text">
                    <h2>Le E-learning avec Easyform</h2>
                    <p>Formez-vous à votre rythme aux différents métier de l'informatique avec : </p>
                    <ul>
                        <li><i class="fas fa-check"></i> Une grande diversité de formations offerts</li>
                        <li><i class="fas fa-check"></i> Des formateurs et professionnels du métier à votre écoute</li>
                        <li><i class="fas fa-check"></i> L'opportunité de créer votre propre formation et toucher une rémunération !</li>
                    </ul>
                    <a href="{{ route('courses.index') }}" class="ha-btn">Voir les cours</a>
                </div>
            </div>
        </div>
    </div>
</section>
@if(count($instructors)>0)
<section class="team-member-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Nos formateurs</h2>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    @foreach ($instructors as $instructor)
    <div class="member-item set-bg" data-setbg="{{ asset('img/teacher-01.jpg') }}">
        <div class="mi-social" >
            <div class="mi-social-inner bg-gradient">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
        <div class="mi-text text-center">
            <h5>{{ $instructor->name }}</h5>
            <span>Formateur</span>
        </div>
    </div>
    @endforeach 
</section>
@endif;
<section class="latest-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Ces cours pourraient vous intéresser</h2>
                    <p>Vous recherchez une formation en particulier ? Notre partenariat avec Udemy nous donne accès à un large pannel de cours à distance : </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($courses as $course)
            <div class="col-lg-6">
                <div class="latest-item set-bg" data-setbg="{{ $course['image_480x270'] }}">
                    <div class="li-tag">{{ $course['price'] }}</div>
                    <div class="li-text">
                        <h5><a target="_blank" href="https://www.udemy.com{{ $course['url'] }}">{{ $course['title'] }}</a></h5>
                        <span><i class="fa fas-user"></i> Par <b>{{ $course['visible_instructors'][0]['display_name'] }}</b></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection