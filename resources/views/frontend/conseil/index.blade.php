@extends('frontend.layouts.layoutfrontend')
@section('contentlandinpage')
<section class="py-7 py-lg-8">
    <div class="container mb-4">
        <div class="row justify-content-center">
            <h1>Découvrez davantage de réponses en explorant d'autres questions. Sélectionnez une catégorie pour affiner votre recherche !</h1>
        </div>
    </div>





    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center">

                <div class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center w-75">

                    <form method="GET" action="{{ route('frontend.conseil.index') }}">
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
                        <p class="mb-0">{!! $firstAdvice->contenus !!}</p>
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
                                {{ $firstAdvice->user->nameUser ?? 'Utilisateur inconnu' }}
                                    <small>(Owner)</small>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <!-- card body  -->
                    <div class="card-body py-3">
                        @if($firstAdvice)
                        <h4 class="mb-0">Vidéo selon la question : {{ $firstAdvice->question }} </h4>


                        @if($firstAdvice->video_url)
                        @php
                        $videoId = null;

                        // Vérifiez si l'URL est au format standard
                        if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/', $firstAdvice->video_url, $matches)) {
                        $videoId = $matches[1];
                        }

                        $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
                        @endphp

                        @if($embedUrl)
                        <iframe width="100%" height="400" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                        @else
                        <p>URL de vidéo non valide.</p>
                        @endif
                        @else
                        <p>Aucune vidéo disponible.</p>
                        @endif

                        @else
                        <p>Aucune donnée disponible pour cette question.</p>
                        @endif


                    </div>
                </div>
                <div class="card">
                    <div class="row">




                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 px-2">
                            <div class="my-8 text-center">
                                <h2>Autre conseil liee aux catégorie choisie</h2>
                            </div>
                        </div>
                        <!-- Search Section -->
                        <div class="col-12 mb-5">
                            <form id="searchForm" class="mt-3 mt-lg-0 ms-lg-3 d-flex align-items-center w-75">
                                <div class="position-relative w-100">
                                    <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-secondary">
                                        <i class="fe fe-search"></i>
                                    </span>
                                    <label for="search" class="visually-hidden">Search</label>
                                    <input type="search"
                                        id="searchInput"
                                        name="search"
                                        class="form-control form-control-lg ps-5 rounded-3 border-secondary-subtle shadow-sm"
                                        placeholder="Search by Question" />
                                </div>
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
                                        <div class="card h-100 shadow-lg hover-lift-up">
                                            <!-- Image Container -->
                                            <div class="card-img-top position-relative" style="height: 200px;">
                                                <img src="{{ asset($advice->image_url ?? 'path_to_default_image') }}"
                                                    class="img-fluid w-100 h-100 object-fit-cover"
                                                    alt="{{ $advice->titre }}" />
                                            </div>

                                            <!-- Card Content -->
                                            <div class="card-body d-flex flex-column">
                                                <!-- Category -->
                                                <a href="#" class="badge bg-light-primary text-primary mb-2">
                                                    {{ $firstCategory->name }}
                                                </a>

                                                <!-- Title -->
                                                <a href="#" class="text-decoration-none">
                                                    <h3 class="card-title h5 text-dark mb-3">{{ $advice->question }}</h3>
                                                </a>

                                                <!-- Author Info -->
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="me-2">
                                                        <img src="../assets/images/avatar/avatar-1.jpg"
                                                            alt="avatar"
                                                            class="rounded-circle"
                                                            width="40"
                                                            height="40" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">
                                                                               {{ $advice->user->nameUser ?? 'Utilisateur inconnu' }}
                                                        </h6>
                                                        <small class="text-muted">{{ $advice->created_at->format('F d, Y') }}</small>
                                                    </div>
                                                </div>

                                                <!-- Button -->
                                                <div class="mt-auto text-center">
                                                    <a href="{{ route('frontend.conseil.details', ['id' => $advice->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        Voir plus
                                                    </a>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const carouselItems = document.querySelectorAll('.carousel-item');
        const carouselInner = document.querySelector('.carousel-inner');
        const prevButton = document.querySelector('.carousel-control-prev');
        const nextButton = document.querySelector('.carousel-control-next');

        const initialActiveIndex = Array.from(carouselItems).findIndex(item => item.classList.contains('active'));

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();

            if (query === '') {
                carouselItems.forEach((item, index) => {
                    item.style.display = 'block';
                    item.classList.remove('active');
                    if (index === initialActiveIndex) {
                        item.classList.add('active');
                    }
                });
            } else {
                let anyVisible = false;

                carouselItems.forEach(item => {
                    const question = item.querySelector('h3').innerText.toLowerCase();

                    if (question.includes(query)) {
                        item.style.display = 'block';
                        anyVisible = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                const visibleItems = Array.from(carouselItems).filter(item => item.style.display !== 'none');

                carouselItems.forEach(item => item.classList.remove('active'));
                if (visibleItems.length > 0) {
                    visibleItems[0].classList.add('active');
                }

                if (!anyVisible) {
                    prevButton.style.display = 'none';
                    nextButton.style.display = 'none';
                } else {
                    prevButton.style.display = 'block';
                    nextButton.style.display = 'block';
                }
            }
        });
    });
</script>

@endsection
