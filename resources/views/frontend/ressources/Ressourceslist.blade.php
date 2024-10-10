@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<section class="py-lg-8 py-7">
    <div class="container my-lg-8">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-12">
                <div class="mb-8">
                    <h1 class="display-3 fw-semibold mb-4">Découvrez nos ressources !</h1>
                </div>
            </div>
        </div>
        
        <!-- Display list of jardins -->
        <div class="row g-6">
            @if($ressources->isEmpty())
                <p class="text-center">No ressources available at the moment.</p>
            @else
                @foreach($ressources as $ressource)
                

                    <div class="col-md-6 mb-6">
                    <div class="img-overlay">
                        <div class="img-color">
                            <!-- Display jardin image -->
                            @if($ressource->image)
                            <img src="{{ asset('storage/' . $ressource->image) }}" alt="" class="img-fluid w-100" />
                                                        @else
                                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-fluid w-100"/>
                                                        @endif
                            <!-- Caption -->
                            <div class="caption">
                                <a href="#" class="btn btn-white">View Details</a>
                            </div>
                        </div>
                    </div>




                    <div class="mt-4">
                        <!-- Display jardin details -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-semibold mb-1">Nom: {{ $ressource->nom }}</h3>
                            <span>Quantité: {{ $ressource->quantite }}</span>
                        </div>
                        <p>Libelle: {{ $ressource->libelle }}</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection