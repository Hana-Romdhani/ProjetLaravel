@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    <div class="col-lg-12 col-md-12 col-12">
        <!-- Page Header -->
        <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
            <div class="d-flex flex-column gap-1">
                <h1 class="mb-0 h2 fw-bold">Plantations</h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Plantations</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('admin.plantation.create') }}" class="btn btn-primary">Add New Plantation</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
                <!-- Card header -->
                <div class="card-header p-0">
                    <div>
                        <!-- Nav -->
                        <ul class="nav nav-lb-tab border-bottom-0" id="tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="plantations-tab" data-bs-toggle="pill" href="#plantations" role="tab" aria-controls="plantations" aria-selected="true">All</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="p-4 row">
                    <!-- Form -->
                    <form class="d-flex align-items-center col-12 col-md-12 col-lg-12">
                        <span class="position-absolute ps-3 search-icon"><i class="fe fe-search"></i></span>
                        <input type="search" class="form-control ps-6" placeholder="Search Plantation" />
                    </form>
                </div>

                <div>
                    <!-- Table -->
                    <div class="tab-content" id="tabContent">
                        <!--Tab pane -->
                        <div class="tab-pane fade show active" id="plantations" role="tabpanel" aria-labelledby="plantations-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap table-centered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Plantation Name</th>
                                            <th>Gardener</th>
                                            <th>Garden</th>
                                            <th>Plants</th>
                                            <th>Date of Plantation</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($plantations as $plantation)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    <h4 class="mb-0 text-primary-hover">{{ $plantation->nom }}</h4>
                                                    <span>Added on {{ $plantation->created_at->format('d M, Y') }}</span>
                                                </div>
                                            </td>

                                            <td>{{ $plantation->user->nameUser }}</td>
                                            <td>{{ $plantation->jardin->name }}</td>
                                            <td>
                                                @foreach ($plantation->plantes as $plante)
                                                    {{ $plante->nom }}{{ !$loop->last ? ',' : '' }}
                                                @endforeach
                                            </td>

                                            <td>{{ $plantation->date_plantation->format('d M, Y') }}</td>

                                            <!-- Edit button -->
                                            <td>
                                                <a href="{{ route('admin.plantation.edit', $plantation->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                            </td>

                                            <!-- Delete button with confirmation modal -->
                                            <td>
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $plantation->id }}">
                                                    Delete
                                                </button>

                                                <div class="modal fade" id="confirmDeleteModal{{ $plantation->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this plantation?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('plantation.destroy', $plantation->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                <div class="card-footer">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
