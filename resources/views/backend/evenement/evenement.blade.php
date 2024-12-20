@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Events</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="admin-dashboard.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Evenements</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All</li>
                        </ol>
                    </nav>
                </div>
                <!-- Sort and Add Event Button -->
                <div class="d-flex gap-3 align-items-center">
                    <form method="GET" action="{{ route('backend.evenement.index') }}" class="d-flex align-items-center gap-2">
                        <select name="sort_by" class="form-select form-select-sm" style="width: auto;">
                            <option value="location" {{ request('sort_by') == 'location' ? 'selected' : '' }}>Location</option>
                            <option value="date" {{ request('sort_by') == 'date' ? 'selected' : '' }}>Date</option>
                        </select>
                        <select name="sort_direction" class="form-select form-select-sm" style="width: auto;">
                            <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                        <button type="submit" class="btn btn-secondary btn-sm">Sort</button>
                    </form>
                    <!-- Export Button -->
                    <form action="{{ route('backend.evenement.export') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-success">CSV</button>
                    </form>
                    <a href="{{ route('backend.evenement.create') }}" class="btn btn-primary">Add New Event</a>
                </div>
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
                                <a class="nav-link active" id="courses-tab" data-bs-toggle="pill" href="#courses" role="tab" aria-controls="courses" aria-selected="true">All</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="p-4 row">
                    <!-- Form -->
                    <!-- Form for Searching Events -->
                    <form class="d-flex align-items-center col-12 col-md-12 col-lg-12" method="GET" action="{{ route('backend.evenement.index') }}">
                        <span class="position-absolute ps-3 search-icon"><i class="fe fe-search"></i></span>
                        <input type="search" name="search" class="form-control ps-6" placeholder="Search Event" value="{{ request()->get('search') }}" />
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
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
                                            <th>Title</th>
                                            <th>User Name</th>
                                            <th>Location</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Type</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($evenements as $evenement)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div>
                                                        <!-- Si vous avez un champ d'image -->
                                                        @if($evenement->image)
                                                        <img src="{{ asset('storage/' . $evenement->image) }}" alt="" class="img-4by3-lg rounded" />
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column gap-1">
                                                        <h4 class="mb-0 text-primary-hover">{{ $evenement->title }}</h4>
                                                        <span>Added on {{ $evenement->created_at->format('d M, Y') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $evenement->adminUser->nameUser }}</p> <!-- Displaying the description here -->
                                                </div>
                                            </td>
                                            <td>

                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $evenement->location }}</p> <!-- Displaying the description here -->
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $evenement->description }}</p> <!-- Displaying the description here -->
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $evenement->date }}</p> <!-- Displaying the description here -->
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $evenement->classification->name }}</p>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $evenement->id }}">
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $evenement->id }}">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                            <!-- Modal pour le formulaire d'édition -->
                                            <div class="modal fade @if ($errors->any()) show @endif" id="editEventModal{{ $evenement->id }}" tabindex="-1" aria-labelledby="editEventModalLabel{{ $evenement->id }}" aria-hidden="true" style="@if($errors->any()) display: block; @endif">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editEventModalLabel{{ $evenement->id }}">Edit Event</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('backend.evenement.update', $evenement->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Event Title Field -->
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Title</label>
                                                                    <input type="text" class="form-control" name="title" value="{{ old('title', $evenement->title) }}">
                                                                    @error('title')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Event Location Field -->
                                                                <div class="mb-3">
                                                                    <label for="location" class="form-label">Location</label>
                                                                    <input type="text" class="form-control" name="location" value="{{ old('location', $evenement->location) }}">
                                                                    @error('location')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Event Description Field -->
                                                                <div class="mb-3">
                                                                    <label for="description" class="form-label">Description</label>
                                                                    <textarea class="form-control" name="description" rows="3">{{ old('description', $evenement->description) }}</textarea>
                                                                    @error('description')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Event Date Field -->
                                                                <div class="mb-3">
                                                                    <label for="date" class="form-label">Date</label>
                                                                    <input type="date" class="form-control" name="date" value="{{ old('date', $evenement->date) }}">
                                                                    @error('date')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Event Classification Field -->
                                                                <div class="mb-3">
                                                                    <label for="classification_id">Classification</label>
                                                                    <select name="classification_id" id="classification_id" class="form-control">
                                                                        @foreach($classifications as $classification)
                                                                        <option value="{{ $classification->id }}" {{ old('classification_id', $evenement->classification_id) == $classification->id ? 'selected' : '' }}>
                                                                            {{ $classification->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('classification_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Event Image Field -->
                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label">Image</label>
                                                                    <input type="file" class="form-control" name="image" accept="image/*">
                                                                    <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
                                                                    @error('image')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Submit Button -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <td>


                                                <div class="modal fade" id="confirmDeleteModal{{ $evenement->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this event?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('backend.evenement.destroy', $evenement->id) }}" method="POST" class="d-inline">
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
                            <!-- Previous Button -->
                            @if ($evenements->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link mx-1 rounded" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg>
                                </a>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link mx-1 rounded" href="{{ $evenements->previousPageUrl() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg>
                                </a>
                            </li>
                            @endif

                            <!-- Page Numbers -->
                            @for ($i = 1; $i <= $evenements->lastPage(); $i++)
                                @if ($i == $evenements->currentPage())
                                <li class="page-item active">
                                    <a class="page-link mx-1 rounded" href="#">{{ $i }}</a>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="{{ $evenements->url($i) }}">{{ $i }}</a>
                                </li>
                                @endif
                                @endfor

                                <!-- Next Button -->
                                @if ($evenements->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link mx-1 rounded" href="{{ $evenements->nextPageUrl() }}">
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
                                <!-- <a href="{{ route('backend.evenement.export') }}">Exporter les événements</a> -->
                                @endif
                        </ul>

                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Include SweetAlert script at the bottom -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showAlert() {
        Swal.fire({
            title: 'Success!',
            text: 'Your event has been saved.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    @if(session('success'))
    showAlert(); // Display SweetAlert if the session contains 'success'
    @endif

    @if($errors -> any())
    // Ensure the modal remains open if there are validation errors
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById('editEventModal{{ $evenement->id }}'));
        modal.show();
    });
    @endif
</script>
@endsection
