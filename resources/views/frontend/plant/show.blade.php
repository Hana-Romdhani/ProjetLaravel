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
                            <li class="breadcrumb-item"><a href="/plants">Plantes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $plant->nom }}</li>
                        </ol>
                    </nav>

                    <div class="position-relative">
                        <!-- Plant Image with Overlay Wishlist Icon -->
                        <img src="{{ $plant->image_url ? asset('assets/images/course/' . $plant->image_url) : asset('assets/images/inconnu.png') }}"
                             alt="{{ $plant->nom }}"
                             class="img-fluid w-100 rounded-3 shadow-sm" />
                        <button id="toggleWishlistIcon" class="btn btn-outline-light position-absolute top-0 end-0 m-3"
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
                        <button id="toggleWishlistBtn" class="btn btn-danger btn-lg w-75">
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
        const toggleWishlistBtn = document.getElementById('toggleWishlistBtn');
        const toggleWishlistIcon = document.getElementById('toggleWishlistIcon');

        // Data for the plant
        const plantData = {
            id: {{ $plant->id }},
            name: "{{ $plant->nom }}",
            image: "{{ $plant->image_url ? asset('assets/images/course/' . $plant->image_url) : asset('assets/images/inconnu.png') }}"
        };

        // Add or remove plant from wishlist in local storage
        function toggleWishlist(item) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const plantIndex = wishlist.findIndex(plant => plant.id === item.id);

            if (plantIndex === -1) {
                // Plant is not in wishlist; add it
                wishlist.push(item);
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                displayAddedState();
                alert(`${item.name} has been added to your wishlist!`);
            } else {
                // Plant is already in wishlist; remove it
                wishlist.splice(plantIndex, 1);
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                displayRemovedState();
                alert(`${item.name} has been removed from your wishlist.`);
            }
        }

        // Check if the plant is already in the wishlist on page load
        function checkWishlistState() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const isInWishlist = wishlist.some(plant => plant.id === plantData.id);
            if (isInWishlist) {
                displayAddedState();
            } else {
                displayRemovedState();
            }
        }

        // Display "Added to Wishlist" state
        function displayAddedState() {
            toggleWishlistBtn.classList.replace('btn-danger', 'btn-secondary');
            toggleWishlistBtn.innerHTML = `<i class="bi bi-heart-fill me-2"></i> Remove from Wishlist`;
            toggleWishlistIcon.classList.replace('btn-outline-light', 'btn-outline-secondary');
            toggleWishlistIcon.innerHTML = `<i class="bi bi-heart-fill fs-4"></i>`;
        }

        // Display "Add to Wishlist" state
        function displayRemovedState() {
            toggleWishlistBtn.classList.replace('btn-secondary', 'btn-danger');
            toggleWishlistBtn.innerHTML = `<i class="bi bi-heart me-2"></i> Add to Wishlist`;
            toggleWishlistIcon.classList.replace('btn-outline-secondary', 'btn-outline-light');
            toggleWishlistIcon.innerHTML = `<i class="bi bi-heart fs-4"></i>`;
        }

        // Attach event listeners to both wishlist buttons
        toggleWishlistBtn.addEventListener('click', function () {
            toggleWishlist(plantData);
        });

        toggleWishlistIcon.addEventListener('click', function () {
            toggleWishlist(plantData);
        });

        // Check wishlist state on page load
        checkWishlistState();
    });
</script>

@endsection
