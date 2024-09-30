@extends('frontend.layouts.layoutUserWorkspace')
@section('contentlandinpage')


    <div>
        <a href="{{ route('frontend.ressources.RessourcesForm.create') }}" class="btn btn-primary">Ajouter Ressource</a>
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
                <div>
                    <!-- Table -->
                    <div class="tab-content" id="tabContent">
                        <!--Tab pane -->
                        <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                            <div class="table-responsive border-0 overflow-y-hidden">
                                <table class="table mb-0 text-nowrap table-centered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nom Ressource </th>
                                            <th>Libelle</th>
                                            <th>Quantite</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ressources as $ressource)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div>

                                                        <!-- If you have an image field -->
                                                        @if($ressource->image)
                                                        <img src="{{ asset('storage/' . $ressource->image) }}" alt="" class="img-4by3-lg rounded" />
                                                        @else
                                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-4by3-lg rounded" />
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="d-flex flex-column gap-1">
                                                        <h4 class="mb-0 text-primary-hover">{{ $ressource->nom }}</h4>
                                                        <span>Added on {{ $ressource->created_at->format('d M, Y') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressource->libelle }}</p> <!-- Displaying the description here -->
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <p>{{ $ressource->quantite }}</p> <!-- Displaying the description here -->
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('frontend.ressources.RessourcesForm.edit', $ressource->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                            </td>
                                            <td>
                                                <span class="dropdown dropstart">
                                                    <a
                                                        class="btn-icon btn btn-ghost btn-sm rounded-circle"
                                                        href="#"
                                                        role="button"
                                                        id="jardinDropdown{{ $ressource->id }}"
                                                        data-bs-toggle="dropdown"
                                                        data-bs-offset="-20,20"
                                                        aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <span class="dropdown-menu" aria-labelledby="jardinDropdown{{ $ressource->id }}">
                                                        <span class="dropdown-header">Settings</span>
                                                        <form action="{{ route('Ressources.destroy', $ressource->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Ressource?');">
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
    </div>

@endsection
