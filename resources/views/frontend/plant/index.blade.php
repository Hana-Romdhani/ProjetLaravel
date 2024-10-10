@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<!-- Hero section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Plantes</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0">Plantes</h1>
                    <p>Explore our diverse plant collection for better gardening.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of hero section -->

<!-- Plant listings with filter section -->
<section class="py-lg-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xxl-3 col-lg-4 col-12">
                <!-- Sidebar for filters -->
                <div class="card">
                    <div class="card-header">
                        <h5>Filter by Categories</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ url('plants/category/' . $category->slug) }}" class="d-block">{{ $category->nom }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9 col-lg-8 col-12">
                <!-- Displaying plants -->
                <div class="row gy-4">
                    @forelse($plants as $plant)
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card card-lift">
                            <a href="#!">
                                <!-- <img src="{{ $plant->image_url ? asset('storage/' . $plant->image_url) : asset('/assets/images/inconnu.png') }}" alt="{{ $plant->nom }}" class="card-img-top img-fluid w-100" /> -->
                                <!-- <img src="{{ $plant->image_url ? asset('storage/' . $plant->image_url) : asset('/assets/images/inconnu.png') }}" alt="{{ $plant->nom }}" class="card-img-top img-fluid w-100" /> -->
                                <img src="{{ $plant->image_url ? asset('assets/images/course/' . $plant->image_url) : asset('assets/images/inconnu.png') }}" alt="{{ $plant->nom }}" class="card-img-top img-fluid w-100">

                            </a>
                            <div class="card-body d-flex flex-column gap-4">
                                <div class="d-flex flex-column gap-2">
                                    <div>
                                        <span class="badge text-light-emphasis bg-light-subtle border border-light-subtle rounded-pill">Design</span>
                                    </div>
                                    <h3 class="mb-0 h4">
                                        <a href="#!" class="text-inherit">{{ $plant->nom }}</a>
                                    </h3>

                                    <small class="text-secondary">{{ $plant->category }}</small> <!-- Assuming each plant has a category attribute -->

                                </div>

                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p>No plants available.</p>
                    </div>
                    @endforelse
                </div>


                <!-- Pagination -->
                <div class="mt-4">
                    {{ $plants->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of filter section -->

@endsection
