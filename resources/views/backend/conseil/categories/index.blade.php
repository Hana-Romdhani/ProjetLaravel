@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">
    <div class="col-lg-12 col-md-12 col-12">
        <!-- Page Header -->
        <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
            <div class="d-flex flex-column gap-1">
                <h1 class="mb-0 h2 fw-bold">Conseil Categories </h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Categorie</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('categorie.create') }}" class="btn btn-primary">Add New Jardin</a>

            </div>
        </div>



        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                @if ($message = Session::get('success'))
                <div class="alert alert-success" id="success-alert">
                    <p>{{ $message }}</p>
                </div>
                @endif

                @if ($categorie_conseils->isEmpty())
                <div class="alert alert-warning">
                    <p>No categories found.</p>
                </div>
                @else
                <!-- Card -->
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
                        <!-- Form -->
                        <form class="d-flex align-items-center col-12 col-md-12 col-lg-12">
                            <span class="position-absolute ps-3 search-icon"><i class="fe fe-search"></i></span>
                            <input type="search" class="form-control ps-6" placeholder="Search Jardin" />
                        </form>
                    </div>
                    <div>
                        <!-- Table -->
                        <div class="tab-content" id="tabContent">
                            <!--Tab pane -->
                            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                <div class="table-responsive border-0 overflow-y-hidden">
                                    <table class="table mb-0 text-nowrap table-centered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Date de création</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categorie_conseils as $categorie_conseil)
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <p>{{ $categorie_conseil->name }}</p>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-2">
                                                        <p>{{ $categorie_conseil->created_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-outline-success btn-sm d-inline-block me-2">Conseil Details</a>
                                                    <form action="{{ route('categorie.destroy',$categorie_conseil->id) }}" method="Post" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                                    </form>
                                                    <a href="{{ route('categorie.edit',  parameters: $categorie_conseil->id) }}" class="btn btn-outline-secondary btn-sm ms-2">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Footer -->
                    <div class="d-flex justify-content-center">
                        <nav>
                            {{ $categorie_conseils->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>


                @endif
            </div>

        </div>
    </div>
    <script>
        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Get the success alert element
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                // Set a timeout to hide the success alert after 3 seconds (3000 milliseconds)
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</section>



@endsection
