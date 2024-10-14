@extends('frontend.layouts.layoutfrontend')
@section('contentlandinpage')
<!-- Content -->
<section class="py-7 py-lg-8">
    <div class="container mb-4">
        <div class="row justify-content-center">
            <h1>Vous pouvez partager vos commentaires ici. </h1>
        </div>
    </div>

    <div class="row gy-4  px-2 w-80 mx-auto ">
        <div class="col-xl-6 col-8">
            <!-- card  -->
            <div class="card ">
                <!-- card body  -->
                <div class="card-body d-flex flex-column gap-4">
                    @if($conseil)

                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Catégorie: {{$conseil->category ? $conseil->category->name : 'Pas de catégorie'}}</h4>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0"> Titre: {{ $conseil->titre }}</h4>

                        <div class="mb-0 center d-flex align-items-center">
                            @if($conseil->image_url)
                            <img src="{{ asset($conseil->image_url) }}" alt="Image du conseil" class="me-2 mw-40 mh-40">
                            @else
                            <p>Aucune image disponible.</p>
                            @endif
                        </div>
                    </div>


                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Question: {{ $conseil->question }}</h4>
                        <p></p>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <p class="mb-0">{{ $conseil->contenus }}</p>
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

                        @if($conseil)
                        <iframe width="100%" height="400" src="{{ $conseil->video_url ? 'https://www.youtube.com/embed/' . explode('v=', $conseil->video_url)[1] : '' }}" frameborder="0" allowfullscreen></iframe>
                        @else
                        <p>Aucune vidéo disponible.</p>
                        @endif


                    </div>
                </div>
                <!-- card  -->
                <div class="card">
                    <!-- card body  -->
                    <div class="card-body border-top py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center flex-row gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                                    <path d="M8 16a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm3.5-9.5a.5.5 0 0 1 0 1h-6a.5.5 0 0 1 0-1h6zM8 11a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1H8z" />
                                </svg>
                                <div class="">
                                    <h5 class="mb-0 text-body">Commenter</h5>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <button class="btn btn-outline-success btn-sm d-inline-block me-2">Commenter</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

</section>
@endsection
