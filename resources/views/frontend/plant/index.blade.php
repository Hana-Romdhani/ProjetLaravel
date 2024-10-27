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
                        <div class="card card-lift position-relative plant-card" data-id="{{ $plant->id }}" data-name="{{ $plant->nom }}" data-image="{{ $plant->image_url ? asset('assets/images/course/' . $plant->image_url) : asset('assets/images/inconnu.png') }}">
                            <a href="{{ url('plant/' . $plant->id) }}">
                                <img src="{{ $plant->image_url ? asset('assets/images/course/' . $plant->image_url) : asset('assets/images/inconnu.png') }}" alt="{{ $plant->nom }}" class="card-img-top img-fluid w-100">
                            </a>
                            <div class="card-body d-flex flex-column gap-4">
                                <div class="d-flex flex-column gap-2">
                                    <!-- <span class="badge text-light-emphasis bg-light-subtle border border-light-subtle rounded-pill">Design</span> -->
                                    <h3 class="mb-0 h4">
                                        <a href="{{ url('plant/' . $plant->id) }}" class="text-inherit">{{ $plant->nom }}</a>
                                    </h3>
                                    <small class="text-secondary">{{ $plant->category }}</small>
                                </div>
                            </div>
                            <!-- Wishlist Icon at Bottom Right -->
                            <button class="btn btn-light wishlist-icon position-absolute bottom-0 end-0 m-2" data-bs-toggle="tooltip" title="Add to Wishlist" id="wishlistIcon{{ $plant->id }}">
                                <i class="bi bi-heart fs-5"></i>
                            </button>

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

<!-- JavaScript for Wishlist functionality -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize tooltip for wishlist icons
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Function to check if a plant is in the wishlist
        function isPlantInWishlist(plantId) {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            return wishlist.some(plant => plant.id === plantId);
        }

        // Function to toggle wishlist state for a plant
        function toggleWishlist(plant) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const plantIndex = wishlist.findIndex(item => item.id === plant.id);

            if (plantIndex === -1) {
                wishlist.push(plant);
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                return true;
            } else {
                wishlist.splice(plantIndex, 1);
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                return false;
            }
        }

        // Set wishlist state for all items on page load
        document.querySelectorAll('.plant-card').forEach(card => {
            const plantId = parseInt(card.getAttribute('data-id'), 10);
            const icon = card.querySelector('.wishlist-icon i');
            const wishlistButton = card.querySelector('.wishlist-icon');

            // Check if the plant is already in the wishlist
            if (isPlantInWishlist(plantId)) {
                icon.classList.replace('bi-heart', 'bi-heart-fill');
                icon.style.color = 'red';
            }

            // Add hover event to manage tooltip visibility on the wishlist button
            wishlistButton.addEventListener('mouseenter', function() {
                bootstrap.Tooltip.getInstance(wishlistButton).show();
            });

            wishlistButton.addEventListener('mouseleave', function() {
                bootstrap.Tooltip.getInstance(wishlistButton).hide();
            });

            // Add click event to the wishlist icon
            wishlistButton.addEventListener('click', function(event) {
                event.preventDefault();
                const plant = {
                    id: plantId,
                    name: card.getAttribute('data-name'),
                    image: card.getAttribute('data-image')
                };

                // Toggle wishlist and update icon
                if (toggleWishlist(plant)) {
                    icon.classList.replace('bi-heart', 'bi-heart-fill');
                    icon.style.color = 'red';
                } else {
                    icon.classList.replace('bi-heart-fill', 'bi-heart');
                    icon.style.color = '';
                }
            });
        });
    });
</script>


@endsection
