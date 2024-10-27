@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')

<main>
    <section class="py-7">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Plant Image Section -->
                <div class="col-md-6 col-12 mb-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="/plants">Plantes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $plant->nom }}</li>
                        </ol>
                    </nav>

                    <div class="position-relative">
                        <!-- Plant Image with Overlay Wishlist Icon -->
                        <img src="{{ $plant->image_url ? asset('assets/images/course/' . $plant->image_url) : asset('assets/images/inconnu.png') }}"
                             alt="{{ $plant->nom }}"
                             class="img-fluid w-100 rounded-3 shadow-sm" />
                        <button id="addToWishlistIcon" class="btn btn-outline-light position-absolute top-0 end-0 m-3"
                                data-bs-toggle="tooltip" title="Add to Wishlist">
                            <i class="bi bi-heart fs-4"></i>
                        </button>
                    </div>
                </div>

                <!-- Plant Details Section -->
                <div class="col-md-5 col-12">
                    <h1 class="display-5 fw-bold mb-4">{{ $plant->nom }}</h1>
                    <h3 class="h5 mb-3">Description</h3>
                    <p class="fs-6 mb-4">
                        {{ $plant->description ?? 'This plant is easy to care for and brings a touch of nature indoors or outdoors. Perfect for plant enthusiasts and beginners alike.' }}
                    </p>

                    <!-- Add to Wishlist Button (in text) -->
                    <div class="text-center mb-5">
                        <button id="addToWishlistBtn" class="btn btn-danger btn-lg w-75">
                            <i class="bi bi-heart me-2"></i> Add to Wishlist
                        </button>
                    </div>

                    <!-- Additional Details Section -->
                    <div class="mb-4">
                        <h4 class="h6 mb-3">More Details</h4>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-2">
                                <i class="bi bi-check-circle me-2 text-success"></i> Sun Exposure: {{ $plant->exposition ?? 'N/A' }}
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bi bi-check-circle me-2 text-success"></i> Watering Needs: {{ $plant->arrosage ?? 'N/A' }}
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="bi bi-check-circle me-2 text-success"></i> Soil Type: {{ $plant->type_sol ?? 'N/A' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- JavaScript for Wishlist functionality -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addToWishlistBtn = document.getElementById('addToWishlistBtn');
        const addToWishlistIcon = document.getElementById('addToWishlistIcon');

        // Data for the plant
        const plantData = {
            id: {{ $plant->id }},
            name: "{{ $plant->nom }}",
            image: "{{ $plant->image_url ? asset('assets/images/course/' . $plant->image_url) : asset('assets/images/inconnu.png') }}"
        };

        // Function to add item to wishlist in local storage
        function addToWishlist(item) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

            // Check if the item is already in the wishlist
            const exists = wishlist.some(plant => plant.id === item.id);
            if (!exists) {
                wishlist.push(item);
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                alert(`${item.name} has been added to your wishlist!`);
            } else {
                alert(`${item.name} is already in your wishlist.`);
            }
        }

        // Attach event listeners to the buttons
        addToWishlistBtn.addEventListener('click', function () {
            addToWishlist(plantData);
        });

        addToWishlistIcon.addEventListener('click', function () {
            addToWishlist(plantData);
        });
    });
</script>

@endsection
