@extends('backend.layouts.layoutdashbored')
@section('contentadmin')

<section class="container-fluid p-4">
    <div class="col-lg-12 col-md-12 col-12">
        <!-- Page Header -->
        <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
            <div class="d-flex flex-column gap-1">
                <h1 class="mb-0 h2 fw-bold"> Conseil </h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Conseils</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('conseil.create') }}" class="btn btn-primary">Add New Conseil</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                @if ($message = Session::get('success') ?? request()->query('success'))
                <div class="alert alert-success" id="success-alert">
                    <p>{{ $message }}</p>
                </div>
                @endif
                @if ($message = Session::get('error')?? request()->query('error'))
                <div class="alert alert-danger" id="error-alert">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <!-- Card -->
                <div class="card-body d-flex flex-column gap-4">
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex align-items-center">
                            <img src="/assets/images/conseil/3D.jpg" alt="Image de la carte" class="img-fluid w-15 me-4">
                            <p class="mb-0">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, alias. Nihil vero ut voluptates aliquam in necessitatibus aspernatur rerum porro animi ipsum tenetur saepe blanditiis, consequuntur aliquid nostrum sapiente debitis..<br>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias delectus blanditiis ullam consequuntur eaque eveniet ea accusamus, enim esse excepturi eligendi modi magnam explicabo labore harum dignissimos odit inventore praesentium!<br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque quia error et voluptate dolor ipsa deserunt ipsam! Ipsam nihil esse, quo illo dolorum id magnam magni dolor, ab repellat quam.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card rounded-3">
                    <!-- Card header -->
                    <div class="card-header p-0">
                        <div>
                            <!-- Nav -->
                            <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="courses-tab" data-bs-toggle="pill" href="#courses" role="tab" aria-controls="courses" aria-selected="true">All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-4 row">
                        <form class="d-flex align-items-center col-12 col-md-12 col-lg-12" action="{{ route('conseil.index') }}" method="GET" onsubmit="return checkSearchInput()">
                            <span class="position-absolute ps-3 search-icon"><i class="fe fe-search"></i></span>
                            <input type="search" name="name" id="searchInput" class="form-control ps-6" placeholder="Search category by name" value="{{ request('search') }}" />
                        </form>
                    </div>
                    <div class="p-1 row">
                        <div class="d-flex justify-content-center">
                            <nav>
                                {{ $conseils->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>

                    <div>
                        @if ($conseils->isEmpty())
                        <div class="alert alert-warning">
                            <p>No Advice found.</p>
                        </div>
                        @else
                        <!-- Table -->
                        <div class="tab-content" id="tabContent">
                            <!--Tab pane -->
                            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                <div class="table-responsive border-0 overflow-y-hidden">
                                    <table class="table mb-0 text-nowrap table-centered table-hover" id="categoryTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>titre</th>
                                                <th>Catégorie</th>
                                                <th>Date de création</th>
                                                <th>poster par </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($conseils as $conseil)
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <p>{{ $conseil->titre }}</p>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <p>{{ $conseil->category->name ?? 'N/A' }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <p>{{ $conseil->created_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="me-2">
                                                            <img src="../../assets/images/avatar/images.png"
                                                                alt="avatar"
                                                                class="rounded-circle"
                                                                width="40"
                                                                height="40" />
                                                        </div>
                                                        <span class="badge bg-success-soft">{{ $conseil->user->nameUser  ?? 'Utilisateur inconnu' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('conseil.show',$conseil->id) }}" class="btn btn-outline-success btn-sm d-inline-block me-2">details</a>
                                                    <!-- <form action="{{ route('conseil.destroy', $conseil->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                                    </form> -->
                                                    <form action="{{ route('conseil.destroy', $conseil->id) }}" method="POST" class="d-inline-block" onsubmit="return confirmDelete(event)">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                                    </form>

                                                    <a href="{{ route('conseil.edit', parameters: $conseil->id) }}" class="btn btn-outline-secondary btn-sm ms-2">Edit</a>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif <!-- Move the closing endif here -->
                    </div>
                    <!-- Card Footer -->
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('categoryTable');
            const rows = table.getElementsByTagName('tr');
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 2000);
            }
            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toLowerCase();
                for (let i = 1; i < rows.length; i++) {
                    const td = rows[i].getElementsByTagName('td')[0];
                    if (td) {
                        const textValue = td.textContent || td.innerText;
                        if (textValue.toLowerCase().indexOf(filter) > -1) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }
            });
        });

        function checkSearchInput() {
            var searchInput = document.getElementById('searchInput').value;
            if (searchInput.trim() === "") {
                // Redirect to the category URL without search query
                window.location.href = "{{ route('conseil-categorie.index') }}";
                return false; // Prevent form submission
            }
            return true; // Allow form submission if input is not empty
        }

        function confirmDelete(event) {
            event.preventDefault(); // Prevent form submission
            const form = event.target; // Get the form element

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le !'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if confirmed
                }
            });
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</section>
@endsection
