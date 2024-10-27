@extends('frontend.layouts.layoutfrontend')
@section('contentlandinpage')
<!-- Content -->
<section class="py-7 py-lg-8">
    <div class="container mb-4">
        <div class="row justify-content-center">
            <h1>Accéder au conseil et le noter  </h1>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        <strong>Succès!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($message = Session::get('error') ?? request()->query('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        <strong>Erreur!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <div class="row gy-4  px-2 w-80 mx-auto ">
    <div class="card">
            <div class="card-body py-3">
                <h4 class="mb-0">Évaluer ce conseil</h4>
                <form action="{{ route('conseils.rate', $conseil->id) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <select name="rating" class="form-select">
                            <option value="" disabled selected>Sélectionnez une note</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Soumettre la note</button>
                </form>


            </div>
        </div>
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
                        <p class="mb-0">{!! $conseil->contenus !!}</p>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        @if($conseil->rating_count > 0)

                        <div>
                            @php
                            $rating = number_format($conseil->total_rating / $conseil->rating_count, 2);
                            $fullStars = floor($rating); // Nombre d'étoiles pleines
                            $halfStar = ($rating - $fullStars) >= 0.5 ? true : false; // Vérifie si une étoile est à moitié pleine
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); // Nombre d'étoiles vides
                            @endphp

                            @for($i = 0; $i < $fullStars; $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                                @endfor

                                @if($halfStar)
                                <i class="bi bi-star-half text-warning"></i>
                                @endif

                                @for($i = 0; $i < $emptyStars; $i++)
                                    <i class="bi bi-star text-warning"></i>
                                    @endfor
                        </div>
                        @else
                        <p>Pas encore d'évaluation.</p>
                        @endif
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
                        <h4 class="mb-0">Vidéo selon le question : {{ $conseil->question }} </h4>


                        @if($conseil)
                        @php
                        $videoId = null;

                        // Vérifiez si l'URL est au format standard
                        if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/', $conseil->video_url, $matches)) {
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

                    </div>
                </div>
            </div>
        </div>




    </div>
    <script>
    // Automatically dismiss success alerts after 5 seconds
    setTimeout(function() {
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.classList.remove('show');
            successAlert.classList.add('fade');
        }
    }, 2000); // Change 5000 to the desired duration in milliseconds

    // Automatically dismiss error alerts after 5 seconds
    setTimeout(function() {
        var errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.classList.remove('show');
            errorAlert.classList.add('fade');
        }
    }, 2000); // Change 5000 to the desired duration in milliseconds
</script>

</section>
@endsection
