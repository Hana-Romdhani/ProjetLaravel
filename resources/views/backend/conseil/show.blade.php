@extends('backend.layouts.layoutdashbored')

@section('contentadmin')



<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">
                        Nombre de conseils
                        <span class="fs-5">({{ $conseils->total() }})</span>
                    </h1>
                    <nav aria-label="breadcrumb" class="d-flex align-items-center">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="/admin">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Conseil Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $categorie_conseil->name }}</li>

                        </ol>

                    </nav>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">

            <!-- Search Form -->
            <form method="GET" action="{{ route('conseil.categoryShow', $categorie_conseil->id) }}" onsubmit="return checkSearchInput()">
                <div class="mb-4">
                    <input type="search" name="search" id="searchInput" class="form-control" placeholder="Search Advice by title" value="{{ request('search') }}" />
                </div>
            </form>
            <a href="{{ route(name: 'conseil-categorie.index') }}" class="btn btn-secondary float-end">back</a>

            <div class="row gy-4" id="adviceList">
                <div class="row gy-4" id="adviceList">
                    @forelse($conseils as $advice)
                    <div class="col-xl-3 col-lg-6 col-md-6 col-12 advice-item">
                        <div class="card">
                            <div class="card-body d-flex flex-column gap-4">
                                <div class="text-center d-flex flex-column align-items-center gap-3">
                                    <div>
                                        <h4 class="mb-0">{{ $advice->titre }}</h4>
                                        <p class="mb-0">Auteur : {{ $advice->user->nameUser  ?? 'Utilisateur inconnu' }} </p>
                                        <p class="mb-0">Total des évaluations : <span class="font-weight-bold">{{ $advice->rating_count }}</span></p>
                                        <p class="mb-0">Total des points : <span class="font-weight-bold">{{ $advice->total_rating }}</span></p>
                                        <p class="mb-0">Note :
                                            <span class="font-weight-bold">
                                                {{ $advice->rating_count > 0 ? number_format($advice->total_rating / $advice->rating_count, 2) : 'Pas encore d\'évaluation' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>


                                @if($advice->video_url)
                                <?php
                                $videoId = null;
                                // Vérifiez si l'URL est au format standard
                                if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/', $advice->video_url, $matches)) {
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


                                <div>
                                    <a href="{{ route('conseil.show', $advice->id) }}" class="btn btn-primary">View Conseil</a>

                                </div>

                            </div>
                        </div>
                    </div>
                    @empty
                    <p>No conseils found for your search.</p>
                    @endforelse
                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-12">
                <!-- Pagination Links with Search Query Appended and Bootstrap 4 Design -->
                <div class="d-flex justify-content-center">
                    <nav>
                        {{ $conseils->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function checkSearchInput() {
        var searchInput = document.getElementById('searchInput').value;
        if (searchInput.trim() === "") {
            // Redirect to the category URL without search query
            window.location.href = "{{ route('conseil.categoryShow', $categorie_conseil->id) }}";
            return false; // Prevent form submission
        }
        return true; // Allow form submission if input is not empty
    }
</script>




@endsection
