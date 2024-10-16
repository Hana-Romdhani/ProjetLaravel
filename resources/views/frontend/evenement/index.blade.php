@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<section class="py-lg-8 py-7">
    <div class="container my-lg-8">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-12">
                <div class="mb-8">
                <h1 class="display-3 fw-semibold mb-4 text-center" style="color: blue;">Liste Des Evénements </h1>
                </div>
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
                            <span>{{ $evenement->location }}</span>
                            <p>{{ $evenement->description }}</p>
                            <span>{{ $evenement->date }}</span>
                            <p>{{ $evenement->classification->name }}</p>
                            
                            </div>
                        
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


@endsection
