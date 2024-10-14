@extends('frontend.layouts.layoutfrontend')
@section('contentlandinpage')
<!-- Content -->
<section class="py-7 py-lg-8">
    <div class="container mb-4">
        <div class="row justify-content-center">
            <h1>Dévoilez encore plus de réponses en recherchant d'autres questions et en filtrant par catégorie !</h1>
        </div>
    </div>





    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center">

                <div class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center w-75">

                    <form method="GET" action="{{ route('frontend.conseil.index') }}"> <!-- Update with your route -->
                        <label for="category" class="visually-hidden"></label>
                        <select id="category" name="category" class="form-control ms-3" onchange="this.form.submit()">
                            <option value="" selected disabled>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id  }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="row gy-4  px-2 w-80 mx-auto ">
        <div class="col-xl-6 col-8">
            <!-- card  -->
            <div class="card ">
                <!-- card body  -->
                <div class="card-body d-flex flex-column gap-4">
                    @if($firstAdvice)

                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Catégorie: {{ $firstCategory->name }}</h4>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0"> Titre: {{ $firstAdvice->titre }}</h4>

                        <div class="mb-0 center d-flex align-items-center">
                            @if($firstAdvice->image_url)
                            <img src="{{ asset($firstAdvice->image_url) }}" alt="Image du conseil" class="me-2 mw-40 mh-40">
                            @else
                            <p>Aucune image disponible.</p>
                            @endif
                        </div>
                    </div>


                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Question: {{ $firstAdvice->question }}</h4>
                        <p></p>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <p class="mb-0">{{ $firstAdvice->contenus }}</p>
                    </div>


                    @else
                    <p>No advice available.</p>
                    @endif
                </div>

            </div>
        </div>

        <div class="col-xl-6 col-12">
            <div class="d-flex flex-column gap-4">
                <!-- card  -->
                <div class="card">
                    <!-- card body  -->
                    <div class="card-body py-3">
                        <h4 class="card-title">Poster Par </h4>
                        <div class="d-flex align-items-center flex-row gap-3">
                            <img src="../../assets/images/avatar/avatar-1.jpg" alt="" class="avatar-md avatar rounded-circle" />
                            <div class="">
                                <h4 class="mb-0">
                                    Marvin McKinney
                                    <small>(Owner)</small>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <!-- card body  -->
                    <div class="card-body py-3">
                        <h4 class="mb-0">Vidéo</h4>

                        @if($firstAdvice)
                        <iframe width="100%" height="400" src="{{ $firstAdvice->video_url ? 'https://www.youtube.com/embed/' . explode('v=', $firstAdvice->video_url)[1] : '' }}" frameborder="0" allowfullscreen></iframe>
                        @else
                        <p>Aucune vidéo disponible.</p>
                        @endif


                    </div>
                </div>
                <div class="card">
                    <div class="row">




                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 px-2">
                            <div class="my-8 text-center">
                                <h2>Autre conseil selon le categorie choisie</h2>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 px-2">

                            <form class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center w-75 gap-4" method="GET" action="{{ route('frontend.conseil.index') }}">
                                <span class="position-absolute ps-3 search-icon">
                                    <i class="fe fe-search"></i>
                                </span>
                                <label for="search" class="visually-hidden"></label>
                                <input type="search" id="search" name="search" class="form-control ps-6" placeholder="Search by Question" />
                            </form>
                        </div>

                        <div id="relatedPostCarousel" class="carousel slide  gap-4" data-bs-ride="carousel">
                            <!-- Flèches de navigation -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#relatedPostCarousel" data-bs-slide="prev" style="filter: invert(100%);">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#relatedPostCarousel" data-bs-slide="next" style="filter: invert(100%);">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                            <div class="carousel-inner">
                                @if(collect($adviceList)->isNotEmpty())

                                @foreach($adviceList as $index => $advice)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 mx-auto">
                                        <div class="card mb-4 shadow-lg card-lift">
                                            <a>
                                                <img src="{{ asset($advice->image_url ?? 'path_to_default_image') }}" class="card-img-top" alt="{{ $advice->titre }}" />
                                            </a>
                                            <div class="card-body">
                                                <a href="#" class="fs-5 fw-semibold d-block mb-3 text-primary">{{ $firstCategory->name }}</a>
                                                <a>
                                                    <h3>{{ $advice->question }}</h3>
                                                </a>
                                                <div class="row align-items-center g-0 mt-4">
                                                    <div class="col-auto">
                                                        <img src="../assets/images/avatar/avatar-1.jpg" alt="avatar" class="rounded-circle avatar-sm me-2" />
                                                    </div>
                                                    <div class="col lh-1">
                                                        <h5 class="mb-1">{{ $advice->auteur }}</h5>
                                                        <p class="fs-6 mb-0">{{ $advice->created_at->format('F d, Y') }}</p>
                                                    </div>
                                                </div>
                                                <!-- Bouton "Voir plus de conseils" à l'intérieur de la boucle -->
                                                <div class="text-center mt-4">
                                                    <a href="{{ route('frontend.conseil.details', ['id' => $advice->id]) }}" class="btn btn-primary">Voir plus de conseils</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @else
                                <p>Aucun conseil disponible pour cette catégorie.</p>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>




            </div>
        </div>
    </div>

</section>
@endsection
