@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<section class="py-lg-8 py-7">
    <div class="container my-lg-8">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-12">
                <div class="mb-8">
                    <h1 class="display-3 fw-semibold mb-4">Check out some of the jardins we feature.</h1>
                </div>
            </div>
        </div>
        
        <!-- Display list of jardins -->
        <div class="row g-6">
            @if($jardins->isEmpty())
                <p class="text-center">No jardins available at the moment.</p>
            @else
                @foreach($jardins as $jardin)
                <div class="col-md-6 mb-6">
                    <div class="img-overlay">
                        <div class="img-color">
                            <!-- Display jardin image -->
                            <img src="../assets/images/portfolio/portfolio-square-3.jpg" alt="portfolio" class="img-fluid w-100">
                            <!-- Caption -->
                            <div class="caption">
                                <a href="#" class="btn btn-white">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- Display jardin details -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-semibold mb-1">{{ $jardin->name }}</h3>
                        </div>
                        <span>{{ $jardin->location }}</span>
                        <p>{{ $jardin->description }}</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection
