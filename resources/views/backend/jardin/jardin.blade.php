@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                    <h1 class="mb-0 h2 fw-bold">Jardins</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="admin-dashboard.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Jardins</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('admin.jardin.create') }}" class="btn btn-primary">Add New Jardin</a>

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
                                            <th>Jardin Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jardins as $jardin)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div>
                                                        <!-- If you have an image field -->
                                                        @if($jardin->image)
                                                        <img src="{{ asset('storage/' . $jardin->image) }}" alt="" class="img-4by3-lg rounded" />
                                                        @else
                                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-4by3-lg rounded" />
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column gap-1">
                                                        <h4 class="mb-0 text-primary-hover">{{ $jardin->name }}</h4>
                                                        <span>Added on {{ $jardin->created_at->format('d M, Y') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $jardin->description }}</p> <!-- Displaying the description here -->
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge-dot bg-warning me-1 d-inline-block align-middle"></span>
                                                {{ $jardin->status ?? 'Pending' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.jardin.edit', $jardin->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                            </td>
                                            <td>
                                                <span class="dropdown dropstart">
                                                    <a
                                                        class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                        href="#"
                                                        role="button"
                                                        id="jardinDropdown{{ $jardin->id }}"
                                                        data-bs-toggle="dropdown"
                                                        data-bs-offset="-20,20"
                                                        aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <span class="dropdown-menu" aria-labelledby="jardinDropdown{{ $jardin->id }}">
                                                        <span class="dropdown-header">Settings</span>
                                                        <form action="{{ route('jardin.destroy', $jardin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this jardin?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="fe fe-x-circle dropdown-item-icon"></i>
                                                                Delete
                                                            </button>
                                                        </form>

                                                    </span>
                                                </span>
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
                            <li class="page-item disabled">
                                <a class="page-link mx-1 rounded" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link mx-1 rounded" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link mx-1 rounded" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link mx-1 rounded" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link mx-1 rounded" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
</section>
@endsection
