<header class="header-section">
    <div class="container-fluid" >
        <div class="nav-menu">
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li>
                        <a href="{{ route('main.home') }}">
                            <i class="fas fa-home"></i>
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('courses.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i>
                            Participant
                        </a>
                    </li>
                    <li>
                    <li>
                        <a class="nav-link" href="#">
                        <img class="border-rounded rounded-circle" src="{{ asset('img/profile.png') }}" style="width:10%" >
                         </a>
                             <ul class="dropdown">
                                 <li>
                                     <div class="d-flex justify-content-between py-3 px-3">
                                         <div class="user-infos">
                                            <p>{{ Auth::user()->name }}</p>
                                            <small>{{ Auth::user()->email }}</small>
                                         </div>
                                     </div>
                                 </li>
                                 <div class="dropdown-divider"></div>
                                 <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                             </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</header>