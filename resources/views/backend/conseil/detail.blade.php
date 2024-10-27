@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="d-flex flex-column flex-lg-row gap-2 align-items-lg-center justify-content-between mb-2">
                <div>
                    <h1 class="mb-0 h2 fw-bold">Détails du Conseil</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <!-- nav  -->
            <ul class="nav nav-lb-tab">
                <li class="nav-item mx-3">
                    <a class="nav-link active" href="project-summary.html">Tous</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row gy-4">
        <div class="col-xl-6 col-12">
            <!-- card  -->
            <div class="card">
                <!-- card body  -->
                <div class="card-body d-flex flex-column gap-4">

                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Catégorie</h4>
                        <p class="mb-0">{{ $conseil->category ? $conseil->category->name : 'Pas de catégorie' }}</p>
                    </div>


                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0 center">Titre</h4>
                        <p class="mb-0">{{ $conseil->titre }}</p>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Question</h4>
                        <p>{{ $conseil->question }}</p>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Image</h4>
                        @if($conseil->image_url)
                        <img src="{{ asset($conseil->image_url) }}" alt="Image du conseil" class="img-fluid">
                        @else
                        <p>Aucune image disponible.</p>
                        @endif
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <h4 class="mb-0">Contenu</h4>
                        <p class="mb-0">{!! $conseil->contenus !!}</p>
                    </div>


                    <div class="d-flex flex-column gap-2">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12">
            <div class="d-flex flex-column gap-4">
                <!-- card  -->
                <div class="card">
                    <!-- card body  -->
                    <div class="card-body py-3">
                        <h4 class="card-title">Assigné à</h4>
                        <div class="d-flex align-items-center flex-row gap-3">
                            <img  src="../../assets/images/avatar/images.png" alt="" class="avatar-md avatar rounded-circle" />
                            <div class="">
                                <h4 class="mb-0">
                                    {{ $conseil->user->nameUser ?? 'Utilisateur inconnu' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <!-- card body  -->
                    <div class="card-body py-3">
                        <h4 class="mb-0">Vidéo</h4>
                        @if($conseil->video_url)
                        <?php
                        $videoId = null;
                        // Vérifiez si l'URL est au format standard
                        if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/', $conseil->video_url, $matches)) {
                            $videoId = $matches[1];
                        }

                        $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
                        ?>

                        @if($embedUrl)
                        <iframe width="100%" height="400" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                        @else
                        <p>URL de vidéo non valide.</p>
                        @endif
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
                                    <h5 class="mb-0 text-body">Naviguer vers les conseils par catégorie </h5>
                                </div>
                            </div>
                            <div>
                                <div>

                                    @if($conseil->category)
                                    <a href="{{ route('conseil.categoryShow', ['id' => $conseil->category->id]) }}" class="btn btn-secondary">Aller</a>
                                    @else
                                    <span class="text-muted">Pas de catégorie</span>
                                    @endif

                                    <a href="{{ route('conseil.index') }}" class="btn btn-secondary">back</a>

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
