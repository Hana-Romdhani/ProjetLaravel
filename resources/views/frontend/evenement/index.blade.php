@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<section class="py-lg-8 py-7">
    <div class="container my-lg-8">
              <!-- Titre et formulaire de filtrage sur la même ligne -->
              <div class="row mb-4 align-items-center">
            <!-- Titre centré -->
            <div class="col-md-8 text-md-start text-center">
                <h1 class="display-3 fw-semibold mb-4" style="color: blue;">Liste Des Événements</h1>
            </div>
            <!-- Formulaire de filtrage à droite -->
            <div class="col-md-4 text-md-end text-center">
                <form method="GET" action="{{ route('frontend.evenement.index') }}" class="d-inline-flex">
                    <select name="classification_id" class="form-select me-2" style="max-width: 250px;" onchange="this.form.submit()">
                        <option value="">Filtrer Par</option>
                        @foreach($classifications as $classification)
                            <option value="{{ $classification->id }}" {{ request('classification_id') == $classification->id ? 'selected' : '' }}>
                                {{ $classification->name }}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('frontend.evenement.index') }}" class="btn btn-secondary">Afficher Tout</a>
                </form>
            </div>
        </div>
        <!-- Display list of jardins -->
        <div class="row g-6">
            @if($evenements->isEmpty())
                <p class="text-center">No Events.</p>
            @else
                @foreach($evenements as $evenement)
                <div class="col-md-6 mb-6">
                    <div class="img-overlay">
                        <div class="img-color">
                            <!-- Display jardin image -->
                                                      @if($evenement->image)
                                                        <img src="{{ asset('storage/' . $evenement->image) }}" alt="" class="img-fluid w-100" />
                                                        @else
                                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-fluid w-100"/>
                                                        @endif
                            <!-- Caption -->
                            <div class="caption">
                                <a href="#" class="btn btn-white">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text">
                        <!-- Display jardin details -->
                        <div class="text-center">
                            <h3 class="fw-semibold mb-1">{{ $evenement->title }}</h3>
                            <div class="d-flex justify-content-center">
                                <div class="text-start" style="min-width: 120px;">
                                    <p><strong>Location:</strong></p>
                                    <p><strong>Description:</strong></p>
                                    <p><strong>Date:</strong></p>
                                    <p><strong>Classification:</strong></p>
                                </div>
                                <div class="text-start">
                                    <p>{{ $evenement->location }}</p>
                                    <p>{{ $evenement->description }}</p>
                                    <p>{{ $evenement->date }}</p>
                                    <p>{{ $evenement->classification->name }}</p>
                                </div>
                            </div>
                            
                            </div>
                        
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


@endsection
