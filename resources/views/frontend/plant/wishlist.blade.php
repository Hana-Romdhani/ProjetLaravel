@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')

<main>
    <section class="py-7">
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="text-center mb-5">My Wishlist</h1>
                <div id="wishlistItems" class="col-12 row">
                    <!-- Wishlist items will be loaded here -->
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const wishlistContainer = document.getElementById('wishlistItems');
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

        if (wishlist.length === 0) {
            wishlistContainer.innerHTML = `<p class="text-center text-muted">Your wishlist is empty.</p>`;
        } else {
            wishlist.forEach(item => {
                const itemHtml = `
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="${item.image}" alt="${item.name}" class="card-img-top img-fluid" />
                            <div class="card-body">
                                <h5 class="card-title">${item.name}</h5>
                                <button class="btn btn-danger btn-sm" onclick="removeFromWishlist(${item.id})">Remove</button>
                            </div>
                        </div>
                    </div>
                `;
                wishlistContainer.insertAdjacentHTML('beforeend', itemHtml);
            });
        }
    });

    // Function to remove an item from the wishlist
    function removeFromWishlist(id) {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlist = wishlist.filter(item => item.id !== id);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        location.reload();
    }
</script>


@endsection
