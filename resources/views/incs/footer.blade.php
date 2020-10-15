<!-- Footer -->
<footer class="page-footer font-small white pt-4 mt-0 set-bg" style='padding-bottom:0px;' data-setbg="{{ asset('img/ribbon.jpg') }}" >
    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-6 mt-md-0 mt-3">

                <!-- Content -->
                <h5 class="text-uppercase"><img src="{{ asset('img/logo.png') }}"></h5>
                <h5 class="slogan" >Formez-vous à votre passion !</h5>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none pb-3">

            <!-- Grid column -->
            <div class="col-md-2 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase footer-title">Formation</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('courses.index') }}" >Voir les cours</a>
                    </li>
                </ul>

            </div>
            <!-- Grid column -->

             <!-- Grid column -->
             <div class="col-md-2 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase footer-title">Compte</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('login') }}" >Se connecter</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">Créer un compte</a>
                    </li>
                </ul>

            </div>
            <!-- Grid column -->


            <!-- Grid column -->
            <div class="col-md-2 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase footer-title">Enseignement</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('instructor.index') }}">Créer un cours</a>
                    </li>

                    </li>
                </ul>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://mdbootstrap.com/"> Easyform</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
