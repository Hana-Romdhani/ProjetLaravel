<!doctype html>
<html lang="en">

<!-- Mirrored from geeksui.codescandy.com/geeks/pages/landings/landing-abroad.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Sep 2024 10:11:27 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Codescandy" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/brand/logo/icons8-protea-flower-64.png" />
    <!-- darkmode js -->
    <script src="../../assets/js/vendors/darkMode.js"></script>

    <!-- Libs CSS -->
    <link href="../../assets/fonts/feather/feather.css" rel="stylesheet" />
    <link href="../../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="../../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="../../assets/css/theme.min.css">

    <link rel="canonical" href="home-academy.html" />
    <link href="../../assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/libs/glightbox/dist/css/glightbox.min.css" />
    <title>Home</title>
</head>

<body class="bg-white">

<nav class="navbar navbar-expand-lg">
        <div class="container px-0">
            <a class="navbar-brand" href="/admin">
                <div class="d-flex align-items-center mb-0">
                    <img src="../assets/images/brand/logo/icons8-protea-flower-64.png" class="d-inline" alt="logo-icon" />
                    <div class="ms-2">
                        <h1 class="mb-0 fw-bold d-inline">
                            <span class="mb-0 text-secondary">Green</span>
                            <span class="mb-0 text-success">
                                <span>Link</span>
                            </span>
                        </h1>
                        <small class="fst-italic text-muted d-block">
                            <i class="bi bi-hash text-success"></i>For a Green Life
                        </small>
                    </div>
                </div>
            </a>
            <!-- Mobile view nav wrap -->
            <div class="ms-auto d-flex align-items-center order-lg-3">
                <div class="order-lg-3">

                    <div class="d-flex gap-2 align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button"
                                    aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                                    <i class="bi theme-icon-active"></i>
                                    <span class="visually-hidden bs-theme-text">Toggle theme</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center"
                                            data-bs-theme-value="light" aria-pressed="false">
                                            <i class="bi theme-icon bi-sun-fill"></i>
                                            <span class="ms-2">Light</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center"
                                            data-bs-theme-value="dark" aria-pressed="false">
                                            <i class="bi theme-icon bi-moon-stars-fill"></i>
                                            <span class="ms-2">Dark</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center active"
                                            data-bs-theme-value="auto" aria-pressed="true">
                                            <i class="bi theme-icon bi-circle-half"></i>
                                            <span class="ms-2">Auto</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                         <!-- Conditional User Profile and Buttons -->
                        <!-- Icône de profil pour les utilisateurs connectés -->
                        @auth
                            <a href="/ressourceUser" id="profileIcon" class="text-inherit me-2 rounded-circle border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M8 9a5 5 0 0 0-5 5v1h10v-1a5 5 0 0 0-5-5z"/>
                                </svg>
                            </a>
                        <!-- Formulaire de déconnexion caché -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <!-- Bouton de déconnexion -->
                        <a href="#" id="logoutBtn" class="btn btn-outline-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        @endauth

                        <!-- Boutons pour les visiteurs non connectés -->
                        @guest
                            <a href="auth/signin" id="loginBtn" class="btn btn-outline-dark">Login</a>
                            <a href="auth/register" id="joinNowBtn" class="btn btn-dark d-none d-md-block">Join Now</a>
                        @endguest

                    </div>
                </div>
                 <div>
                    <button class="navbar-toggler collapsed ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon-bar top-bar mt-0"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </button>

                </div>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbar-default">
                <ul class="navbar-nav mt-3 mt-lg-0 mx-xxl-auto">
                <!-- Module de Gestion des Jardins Urbains -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarJardinUrbain" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jardins</a>
                    <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarJardinUrbain">
                        <li><a class="dropdown-item" href={{ route('frontend.jardin.jardin') }}>>Jardin</a></li>
                    </ul>
                </li>


                <!-- Module de Gestion des Ressources -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarRessources" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ressources</a>
                    <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarRessources">
                    <li><a class="dropdown-item" href={{ route('frontend.ressources.RessourcesList')}}>Liste des Ressources</a></li>
                        <li><a class="dropdown-item" href={{ route('frontend.ressources.Ressources')}}>Mes Ressource</a></li>
                        <li><a class="dropdown-item" href={{ route('frontend.ressources.RessourcesPartage')}}>Mes Demandes de Ressource</a></li>

                    </ul>
                </li>

                <!-- Module de Conseils -->
                <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.conseil.index') }}" id="navbarConseils">Conseils</a>
                </li>

                <!-- Module de Gestion des Événements -->
                <li class="nav-item dropdown">
                    <li><a class="dropdown-item" href="{{ route('frontend.evenement.index') }}" id="navbarEvenements" aria-haspopup="true" aria-expanded="false">Evénements</a></li>
                    <!-- <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarEvenements">
                        <li><a class="dropdown-item" href="{{ route('frontend.evenement.index') }}">Events</a></li>
                        <li><a class="dropdown-item" href="#">Classification</a></li>
                    </ul> -->
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/plants" id="navbarCataloguePlantes" >Catalogue des Plantes</a>
                </li>

            </ul>

                </div>
            </div>
    </nav>




    <main>
        <section class="pt-5 pb-5">
            <div class="container">
                <!-- User info -->
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <!-- Bg -->
                        <div class="rounded-top"
                            style="background: url(../assets/images/background/profile-bg.jpg) no-repeat; background-size: cover; height: 100px">
                        </div>
                        <div class="card px-4 pt-2 pb-4 shadow-sm rounded-top-0 rounded-bottom-0 rounded-bottom-md-2">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                                        <img src="../../assets/images/avatar/images.png"
                                            class="avatar-xl rounded-circle border border-4 border-white" alt="avatar" />
                                    </div>
                                    <div class="lh-1">
                                        <h2 class="mb-0">
                                            {{ auth()->user()->nameUser }}
                                        </h2>
                                        <p class="mb-0 d-block">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content -->
                <div class="row mt-0 mt-md-4">
                    <div class="col-lg-3 col-md-4 col-12">
                        <!-- Side navbar -->
                        <nav class="navbar navbar-expand-md shadow-sm mb-4 mb-lg-0 sidenav">
                            <!-- Menu -->
                            <a class="d-xl-none d-lg-none d-md-none text-inherit fw-bold" href="#">Menu</a>
                            <!-- Button -->
                            <button class="navbar-toggler d-md-none icon-shape icon-sm rounded bg-primary text-light" type="button"
                                data-bs-toggle="collapse" data-bs-target="#sidenav" aria-controls="sidenav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="fe fe-menu"></span>
                            </button>
                            <!-- Collapse navbar -->
                            <div class="collapse navbar-collapse" id="sidenav">
                                <div class="navbar-nav flex-column">
                                    <span class="navbar-header">Urban Agriculture Platform</span>
                                    <!-- List -->
                                    <ul class="list-unstyled ms-n2 mb-4">
                                        <!-- Donia (Urban Garden Management) -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="fe fe-map-pin nav-icon"></i> My Gardens
                                            </a>
                                        </li>

                                        <!-- Kinza (Resource Management) -->
                                        <li class="nav-item {{ request()->routeIs('frontend.ressources.Ressources') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('frontend.ressources.Ressources') }}">
                                                <i class="fe fe-box nav-icon"></i> Mes Ressources
                                            </a>
                                        </li>
                                        <!-- Kinza (Resource Management) -->
                                        <li class="nav-item {{ request()->routeIs('frontend.ressources.RessourcesPartage') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('frontend.ressources.RessourcesPartage') }}">
                                                <i class="fe fe-file nav-icon"></i> Mes demandes de Ressources
                                            </a>
                                        </li>


                                        <!-- Hana (Advice Module) -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('frontend.conseil.profiljardinier')}}">
                                                <i class="fe fe-star nav-icon text-danger font-weight-bold"></i>
                                                évaluation par publications
                                            </a>
                                        </li>

                                        <!-- Manar (Event Management) -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="fe fe-calendar nav-icon"></i> Events
                                            </a>
                                        </li>

                                        <!-- Bilel (Plant Catalog) -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="">
                                                <i class="fe fe-feather nav-icon"></i> Plant Catalog
                                            </a>
                                        </li>

                                        <span class="navbar-header">Account Settings</span>
                                        <!-- List -->
                                        <ul class="list-unstyled ms-n2 mb-0">
                                            <li class="nav-item ">
                                                <a class="nav-link" href="profile-edit.html">
                                                    <i class="fe fe-settings nav-icon"></i> Edit Profile
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="security.html">
                                                    <i class="fe fe-user nav-icon"></i> Security
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="notifications.html">
                                                    <i class="fe fe-bell nav-icon"></i> Notifications
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../index.html">
                                                    <i class="fe fe-power nav-icon"></i> Sign Out
                                                </a>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        </nav>

                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <!-- Card -->
                        <div class="card">

                            @yield(section: 'contentlandinpage')

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>




    <!-- section -->









    <!-- Scroll top -->
    <div class="btn-scroll-top">
        <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
            <path d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z" />
        </svg>
    </div>

    <!-- Scripts -->
     <!-- JavaScript for Conditional Display -->
     <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Simulation du statut de connexion (à remplacer par une variable réelle du backend)
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

        // Obtenez les éléments HTML
        const loginBtn = document.querySelector('a[href="auth/signin"]');
        const joinNowBtn = document.getElementById('joinNowBtn'); // Utiliser l'ID ici
        const profileIcon = document.getElementById('profileIcon');
        const logoutBtn = document.getElementById('logoutBtn');

        // Affiche/masque les éléments en fonction de la connexion
        if (isLoggedIn) {
            loginBtn.style.display = "none";
            joinNowBtn.style.display = "none";
            profileIcon.classList.remove("d-none");
            logoutBtn.classList.remove("d-none");
        } else {
            loginBtn.style.display = "block";
            joinNowBtn.style.display = "block";
            profileIcon.classList.add("d-none");
            logoutBtn.classList.add("d-none");
        }
    });
</script>
    <!-- Libs JS -->
    <script src="../../assets/libs/%40popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="../../assets/js/theme.min.js"></script>

    <script src="../../assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
    <script src="../../assets/js/vendors/tnsSlider.js"></script>
    <script src="../../assets/libs/glightbox/dist/js/glightbox.min.js"></script>
    <script src="../../assets/js/vendors/glight.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

<!-- Mirrored from geeksui.codescandy.com/geeks/pages/landings/landing-abroad.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Sep 2024 10:11:31 GMT -->

</html>
