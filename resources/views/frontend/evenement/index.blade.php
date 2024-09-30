@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<section class="py-lg-8 py-7">
    <div class="container my-lg-8">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-12">
                <div class="mb-8">
                <h1 class="display-3 fw-semibold mb-4 text-center" style="color: blue;">List Of Events</h1>
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
                   
                    <div class="mt-4">
                        <!-- Display event details -->
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-semibold mb-1">{{ $evenement->title }}</h3>
                        </div>
                        <span>{{ $evenement->location }}</span>
                        <p>{{ $evenement->description }}</p>
                        <span>{{ $evenement->date }}</span>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

@endsection