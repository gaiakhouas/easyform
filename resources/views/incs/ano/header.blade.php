<nav class="navbar navbar-expand-lg navbar-light  {{  __('animate__animated animate__fadeInDown') }}  ">
    <a class="navbar-brand" href="{{ route('home') }}"><img class='logo-site' src="{{ asset('img/logo.png') }}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item mx-5 ">
                <a class="nav-link" href="{{ route('courses.index') }}">
                    <i class="fas fa-ellipsis-v"></i>
                    Suivre un cours
                </a>
            </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item mx-5 ">
                <a class="nav-link" href="{{ route('instructor.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    Formateur
                </a>
            </li>
            <li class="nav-item" >    
                <a class="nav-link" href="{{ route('login') }}" class="nav-link"><i class="fas fa-user"></i> Connexion</a>
            </li>
        </ul>
    </div>
</nav>