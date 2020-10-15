<nav class="mainmenu mobile-menu  {{  __('animate__animated animate__fadeInDown') }} ">
    <ul>
        <li> <a class="navbar-brand" href="{{ route('home') }}"><img class='logo-site' src="{{ asset('img/logo.png') }}"></a></li>
        <li>
            <a href="{{ route('courses.index') }}">
                <i class="fas fa-ellipsis-v"></i>
                Suivre un cours
            </a>
            <ul class="dropdown px-2 py-3">
                @foreach(\App\Category::all() as $category)
                <li>
                    <a href="{{ route('courses.category', [
                        'slug' => $category->slug 
                    ]) }}">
                     {!! $category->icon !!} 
                     {{ $category->name }} 
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
        </li>
        <li>
            <a href="{{ route('instructor.index') }}">
                <i class="fas fa-chalkboard-teacher"></i>
                Formateur
            </a>
        </li>
        <li>
            <a href="{{ route('participant.index') }}">
                <i class="fas fa-book"></i>
                Mes cours
            </a>
            <ul class="dropdown">
                @foreach (Auth::user()->paidCourses as $paidCourse)
                <li>
                    <div class="d-flex  ml-2 my-3">
                        <img class="avatar border-rounded"
                            src="{{ asset('storage/courses/'.$paidCourse->user_id.'/'.$paidCourse->image) }}" />
                        <div class="user-infos">
                            <a href="{{ route('participant.course.show', [
                                'category' => $paidCourse->category->slug,
                                'slug' => $paidCourse->slug
                            ]) }}"><small>{{ $paidCourse->title }}</small></a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="{{ route('cart.index') }}">
                <i class="fas fa-shopping-cart"></i>
                @if (count(Cart::session(Auth::user()->id)->getContent())>0)
                <span
                    class="badge badge-pill badge-danger">{{ count(Cart::session(Auth::user()->id)->getContent()) }}</span>
                @endif
            </a>
            <ul class="dropdown px-2 py-2">
                @if (count(Cart::session(Auth::user()->id)->getContent())>0)
                @foreach (Cart::getContent() as $item)
                    <li>
                        <div class="d-flex">
                            <img class="avatar border-rounded"
                                src="{{ asset('storage/courses/' . $item->model->user_id . '/' . $item->model->image . '') }}" />
                            <div class="user-infos ml-3">
                                <small>{{ $item->name }}</small>
                                <p class="text-danger">{{ $item->price }} €</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <li>
                    <div class="d-flex">
                        <div class="empty-cart m-2 text-center">
                            <p>Votre panier est vide</p>
                            <a class="btn btn-link" href="{{ route('courses.index') }}">Continuez vos achats</a>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-heart"></i>
                @if (count(Cart::session(Auth::user()->id.'_wishlist')->getContent())>0)
                <span
                    class="badge badge-pill badge-danger">{{ count(Cart::session(Auth::user()->id . '_wishlist')->getContent()) }}</span>
                @endif
            </a>
            <ul class="dropdown px-2 py-2">
                @if (count(Cart::session(Auth::user()->id.'_wishlist')->getContent())>0)
                @foreach (Cart::getContent() as $item)
                    <li>
                        <div class="d-flex">
                            <img class="avatar border-rounded"
                                src="{{ asset('storage/courses/' . $item->model->user_id . '/' . $item->model->image . '') }}" />
                            <div class="user-infos ml-3">
                                <small>{{ $item->name }}</small>
                                <p class="text-danger">{{ $item->price }} €</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <li>
                    <div class="d-flex">
                        <div class="empty-cart m-2 text-center">
                            <p>Votre liste de souhaits est vide.</p>
                            <a class="btn btn-link" href="{{ route('courses.index') }}">Continuez vos achats</a>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
        </li>
        <li>
            <a class="nav-link" href="#">
                <img class="avatar-profile border-rounded rounded-circle" style="width:40%"
                    src="{{ asset('img/profile.png') }}" />
            </a>
            <ul class="dropdown">
                <li>
                    <div class="d-flex justify-content-between py-3 px-3">
                        <div class="user-infos">
                            <p>{{ Auth::user()->name }}</p>
                            <small> {{ Auth::user()->email }} </small>
                        </div>
                    </div>
                </li>
                <div class="dropdown-divider"></div>
                <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </li>
    </ul>
</nav>
