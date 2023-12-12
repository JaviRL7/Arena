<!--Navbar-->
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <!--logo-->
        <a class="navbar-brand fs-4" href="#">Gunlim</a>

        <!--Button-->

        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--side bar-->

        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <!--side bar header-->
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Gunlim</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!--side bar body-->
            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center fs-5 flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('games.index') }}">Games</a>
                        <!--Deberia de ser Competitions?-->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#Rankings">Rankings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#Minigame">Who's the Player ?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#Calendar">Calendar</a>
                        <!--Deberia de wrapped y calendar en otro lado ?-->
                    </li>
                </ul>
                <!--Login-->
                <div class="d-flex justify-content-center align-items-center gap-3 flex-column flex-lg-row">
                    <a href="#login" class="text-black text-decoration-none">Login</a>
                    <a href="#Register" class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4">Register</a>
                </div>
            </div>
        </div>
    </div>
</nav>
