<!doctype html>
<html lang="en">

<!-- Mirrored from geeksui.codescandy.com/geeks/pages/dashboard/admin-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Sep 2024 10:12:37 GMT -->

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/assets/libs/flatpickr/dist/flatpickr.min.css" />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Codescandy" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/brand/icons8-protea-flower-64.jpg" />

    <!-- darkmode js -->
    <script src="/assets/js/vendors/darkMode.js"></script>

    <!-- Libs CSS -->
    <link href="/assets/fonts/feather/feather.css" rel="stylesheet" />
    <link href="/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="/assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />



    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/css/theme.min.css">

    <link rel="canonical" href="admin-dashboard.html" />
    <title>Dashboard</title>





</head>

<body>
    <!-- Wrapper -->
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        <nav class="navbar-vertical navbar">
            <div class="vh-100" data-simplebar>
                <!-- Brand logo -->
                <a class="navbar-brand" href="/">
                    <div class="col-xl-3 col-lg-8 col-md-6 col-6">
                        <div class="d-flex align-items-center mb-0">
                            <img src="/assets/images/brand/logo/icons8-protea-flower-64.png" class="d-inline" alt="logo-icon" />
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
                <!-- Navbar nav -->
                <!-- // add ul parte  -->
                <ul class="navbar-nav flex-column" id="sideNavbar">
                    <!-- Donia (Module de Gestion des Jardins Urbains) -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href={{ route('backend.jardin.jardin') }} data-bs-toggle="collapse" data-bs-target="#navDonia" aria-expanded="false" aria-controls="navDonia">
                            <i class="nav-icon fe fe-globe me-2"></i> Jardins&nbsp;Urbains
                        </a>
                        <div id="navDonia" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('backend.jardin.jardin') }}>Jardin</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('backend.plantation.plantation') }}>Plantation</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Bilel (Module de Gestion palntes) -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navBilel" aria-expanded="false" aria-controls="navBilel">
                            <i class="nav-icon fe fe-feather me-2"></i>
                            Plante

                        </a>
                        <div id="navBilel" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('backend.plant.index') }}>Plantes</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('backend.categoriePlante.index') }}>Catégorie&nbsp;Plante</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <!-- Kinza (Module de Gestion des Ressources) -->
                    <li class="nav-item">

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navKinza" aria-expanded="false" aria-controls="navKinza">
                            <i class="nav-icon fe fe-box me-2"></i>
                            Ressources
                        </a>
                        <div id="navKinza" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('backend.ressource.ressource') }}>Ressource</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('backend.ressource.ressourcesPartage') }}>Demande&nbsp;Ressource</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Hana (Module de Conseils) -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navHana" aria-expanded="false" aria-controls="navHana">
                            <i class="nav-icon fe fe-book-open me-2"></i>
                            Conseils
                        </a>
                        <div id="navHana" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">

                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('conseil-categorie.index') }}>Catégorie&nbsp;Conseil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href={{ route('conseil.index') }}>Conseil</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <!-- Manar (Module de Gestion des Événements) -->
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navManar" aria-expanded="false" aria-controls="navManar">
                            <i class="nav-icon fe fe-calendar me-2"></i>
                            Événements
                        </a>
                        <div id="navManar" class="collapse" data-bs-parent="#sideNavbar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('backend.evenement.index') }}">Événement</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('backend.classification.index') }}">Classification</a>
                                </li>


                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('backend.plantation.agenda') }}" >
                      <i class="nav-icon fe fe-calendar me-2"></i>
                      Agenda
                     </a>
                    </li>


                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <main id="page-content">
            <div class="header">
                <!-- navbar -->

                <nav class="navbar-default navbar navbar-expand-lg">
                    <a id="nav-toggle" href="#">
                        <i class="fe fe-menu"></i>
                    </a>
                   
                    <!--Navbar nav -->
                    <div class="ms-auto d-flex">
                        <div class="dropdown">
                            <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                                <i class="bi theme-icon-active"></i>
                                <span class="visually-hidden bs-theme-text">Toggle theme</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                                        <i class="bi theme-icon bi-sun-fill"></i>
                                        <span class="ms-2">Light</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                        <i class="bi theme-icon bi-moon-stars-fill"></i>
                                        <span class="ms-2">Dark</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                                        <i class="bi theme-icon bi-circle-half"></i>
                                        <span class="ms-2">Auto</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <ul class="navbar-nav navbar-right-wrap ms-2 d-flex nav-top-wrap">

                            <!-- List -->
                            <li class="dropdown ms-2">
                                <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md avatar-indicators avatar-online">
                                        <img alt="avatar" src="../../assets/images/avatar/images.png" class="rounded-circle" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                    <div class="dropdown-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-md avatar-indicators avatar-online">
                                                <img alt="avatar" src="../../assets/images/avatar/images.png" class="rounded-circle" />
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class="mb-1">{{ Auth::user()->nameUser }}</h5>
                                                <p class="mb-0">{{ Auth::user()->email }}</p>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="dropdown-divider"></div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fe fe-power me-2"></i>
                                                Sign Out
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <section class="container-fluid p-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-lg-row gap-3 justify-content-between align-items-lg-center">

                        </div>
                    </div>
                </div>
                @yield('contentadmin')

            </section>


        </main>
    </div>

    <!-- Script -->

    <!-- Libs JS -->
    <script src="/assets/libs/%40popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/libs/simplebar/dist/simplebar.min.js"></script>

    <!-- Theme JS -->
    <script src="/assets/js/theme.min.js"></script>

    <script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/vendors/chart.js"></script>
    <script src="/assets/libs/flatpickr/dist/flatpickr.min.js"></script>
    <script src="/assets/js/vendors/flatpickr.js"></script>

</body>

<!-- Mirrored from geeksui.codescandy.com/geeks/pages/dashboard/admin-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Sep 2024 10:12:50 GMT -->

</html>
