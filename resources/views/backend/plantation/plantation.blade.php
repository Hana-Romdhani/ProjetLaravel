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
                    <!-- Search and Sort Form -->
                    <form id="searchForm" class="d-flex align-items-center col-12 col-md-12 col-lg-12">
                        <span class="position-absolute ps-3 search-icon"><i class="fe fe-search"></i></span>
                        <input type="search" name="search" class="form-control ps-6" placeholder="Search Plantation" value="{{ request('search') }}" />
                        <select name="sort" class="form-select ms-2">
                            <option value="date_plantation" {{ request('sort') == 'date_plantation' ? 'selected' : '' }}>Sort by Date</option>
                            <option value="nom" {{ request('sort') == 'nom' ? 'selected' : '' }}>Sort by Name</option>
                        </select>
                        <select name="order" class="form-select ms-2">
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                    </form>
                </div>

                <div>
                    <!-- Table -->
                    <div class="tab-content" id="tabContent">
                        <!-- Tab pane -->
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
                                    <tbody id="plantationTableBody">
                                        @foreach ($plantations as $plantation)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    <h4 class="mb-0 text-primary-hover">{{ $plantation->nom }}</h4>
                                                    <span>Added on {{ $plantation->created_at->format('d M, Y') }}</span>
                                                </div>
                                            </td>

                                            <td>{{ $plantation->user->nameUser ?? 'N/A' }}</td>
                                            <td>{{ $plantation->jardin->name ?? 'N/A' }}</td>
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
            @if ($plantations->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link mx-1 rounded" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link mx-1 rounded" href="{{ $plantations->previousPageUrl() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                        </svg>
                    </a>
                </li>
            @endif

            @for ($i = 1; $i <= $plantations->lastPage(); $i++)
                <li class="page-item">
                    <a class="page-link mx-1 rounded" href="{{ $plantations->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($plantations->hasMorePages())
                <li class="page-item">
                    <a class="page-link mx-1 rounded" href="{{ $plantations->nextPageUrl() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link mx-1 rounded" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>

            </div>
        </div>
    </div>
</section>

<script>
    // JavaScript for real-time search
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        let searchParams = new URLSearchParams(formData);

        fetch('{{ route("backend.plantation.plantation") }}?' + searchParams.toString())
            .then(response => response.text())
            .then(html => {
                // Update the plantation table body
                document.getElementById('plantationTableBody').innerHTML = new DOMParser().parseFromString(html, 'text/html').getElementById('plantationTableBody').innerHTML;
                // Update pagination links
                document.getElementById('paginationLinks').innerHTML = new DOMParser().parseFromString(html, 'text/html').getElementById('paginationLinks').innerHTML;
            })
            .catch(error => console.error('Error:', error));
    });
</script>

@endsection
