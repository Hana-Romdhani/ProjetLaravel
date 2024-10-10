@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<style>
    .img-overlay {
        position: relative;
        width: 100%; /* Conteneur prend toute la largeur */
        height: 250px; /* Hauteur fixe pour toutes les images */
        overflow: hidden; /* Cache les parties débordantes */
    }

    .img-overlay img {
        width: 200%; /* Ajustez cette valeur pour augmenter la longueur, par exemple 150% */
        height: auto; /* Permet à la hauteur de s'ajuster automatiquement pour conserver le ratio */
        max-height: 400%; /* Limite la hauteur à celle du conteneur */
        object-fit: cover; /* Remplit le conteneur tout en conservant le ratio */
    }

    .caption {
        position: absolute;
        bottom: 10px;
        left: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.8); /* Fond semi-transparent */
        padding: 10px;
        text-align: center;
    }
    .event-details {
        text-align: center; /* Centre le texte des détails de l'événement */
        margin-top: 10px; /* Espace au-dessus des détails */
    }
</style>

<section class="py-lg-8 py-7">
    <div class="container my-lg-8">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-12">
                <div class="mb-8">
                    <h1 class="display-3 fw-semibold mb-4 text-center" style="color: blue;">Liste Des Evénements </h1>
                </div>
            </div>
        </div>
        
        <!-- Display list of events -->
        <div class="row g-6">
            @if($evenements->isEmpty())
                <p class="text-center">No Events</p>
            @else
                @foreach($evenements as $evenement)
                <div class="col-md-6 mb-6">
                    <div class="img-overlay">
                        <div class="img-color">
                            <!-- Display jardin image -->
                            @if($evenement->image)
                                <img src="{{ asset('storage/' . $evenement->image) }}" alt="" class="img-fluid" />
                            @else
                                <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-fluid" />
                            @endif
                            <!-- Caption -->
                            <!-- <div class="caption">
                                <a href="#" class="btn btn-white">View Details</a>
                            </div> -->
                        </div>
                    </div>

                    <div class="mt-4">
                        <!-- Display event details -->
                        <div class="event-details">
                            <h3 class="fw-semibold mb-1">{{ $evenement->title }}</h3>
                            <span>{{ $evenement->location }}</span>
                            <p>{{ $evenement->description }}</p>
                            <span>{{ $evenement->date }}</span>
                            </div>
                        
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection
